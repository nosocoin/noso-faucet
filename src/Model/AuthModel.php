<?php

namespace NosoProject\Model;

use NosoProject\Core\CoreFunctional;

class AuthModel
{
    private $DB;
    protected $inputWallet;
    protected $refer;
    protected $container;
    protected $ConnectId;

    public function __construct($container)
    {
        $this->inputWallet = !empty($_POST['walletAdress']) ?  htmlspecialchars($_POST['walletAdress'], ENT_QUOTES) : '';
        $this->DB = $container->get('db');
        $this->container = $container;
    }

    /**
     * Array of settings for the view
     */
    public function OptionArray($ErrorInvalidWallet)
    {
        return [
            'title' => 'Authorization',
            'Count_Users' => $this->getCountUsers(),
            'Count_Paid' => $this->GetCountPaidNoso(),
            'ErrorInvalidWallet' => $ErrorInvalidWallet,
            'ViewPayments' => false

        ];
    }


    /**
     * Method that returns an array of data to create cookies
     */
    public function CookiesArray()
    {
        return empty($this->ConnectId) ? false : array(
            'wallet' => $this->inputWallet,
            'id' => md5($this->ConnectId)
        );
    }




    /**
     * The method that determines the next steps! After receiving the wallet address.
     */
    public function routeAuth($ref)
    {
        $this->refer = !empty($ref) ? $ref : '';
        return $this->checkWallet() ? $this->authStart() : false;
    }

    /**
     * This class implements user authorization,
     * via the authorization form /auth
     */
    private function checkWallet()
    {

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://explorer.nosocoin.com/api/v1/address/']);
        $check = $client->request('GET', $this->inputWallet, [
            'headers' => ['Accept' => 'application/json']
        ]);
        $decode = json_decode($check->getBody(), true);
        if ($decode["code"] == 200 && $decode["message"] == "Ok") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Method that authorizes the user by wallet address
     * To begin with, we will check whether this address exists in the database
     * -- if the address exists, then we will create a cookie and redirect the user to the main page
     * ---- if the address does not exist, then we will create an entry in the database, and continue authorization
     */
    private function authStart()
    {
        //Let's make a request whether this user exists
        $connect = $this->DB->prepare("SELECT * FROM `users` WHERE `wallet` = :wallet");
        $connect->execute(array('wallet' => $this->inputWallet));

        if ($array = $connect->fetch(\PDO::FETCH_ASSOC)) {
            $this->ConnectId = $array['id'];
        } else {
            unset($array);
            //We also need to check if the ref exists
            //To do this, we make a request, and if there is, we put + to the inviter and write it to ourselves
            $ref = $this->DB->prepare("SELECT * FROM `users` WHERE `wallet` = :ref");
            $ref->execute(array('ref' => $this->refer));

            if ($array_Ref = $ref->fetch(\PDO::FETCH_ASSOC) and $this->inputWallet != $this->refer) {
                $update = $this->DB->prepare("UPDATE `users` SET `referrals` = :referrals WHERE `id` = :id");
                $update->execute(array('referrals' => $array_Ref['referrals'] + 1,  'id' => $array_Ref['id']));
                $referal = $array_Ref["wallet"];
            } else {
                $referal = "";
            }

            $Insert = $this->DB->prepare("INSERT INTO `users` SET `wallet` = :wallet, `ref` = :ref, `lastclaim` = :lastclaim");
            $Insert->execute(array('wallet' =>  $this->inputWallet, 'ref' => $referal, 'lastclaim' => time() - 3800));
            $this->ConnectId = $this->DB->lastInsertId();
        }

        return true;
    }



    /**
     * Get the number of users
     */
    public function GetCountUsers()
    {
        $inquiry = $this->DB->prepare("SELECT * FROM `users`");
        $inquiry->execute();
        return  CoreFunctional::FormatNumber($inquiry->rowCount());
    }

    /**
     * Get the number of Paid of NOSO
     */
    public function GetCountPaidNoso()
    {
        $inquiry = $this->DB->prepare("SELECT sum(paidOut) FROM `users` ");
        $inquiry->execute();
        return  CoreFunctional::FormatNumber($inquiry->fetchColumn());
    }
}
