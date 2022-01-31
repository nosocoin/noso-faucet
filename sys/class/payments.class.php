<?php



class payments {


    /**
     * Метод который возвращает последние 10 притензий
     */
    public static function search_last_20_claim($wallet){
        $connect = DB::connectSQL()->prepare("SELECT * FROM `claim` WHERE `wallet` = :wallet ORDER BY `date` DESC LIMIT 10");
        $connect-> execute(array('wallet' => $wallet));
        while($array = $connect->fetch(PDO::FETCH_ASSOC)){
           
            $value = $value. "<tr>
              <td> ".date("d.m.y, H:i:s", $array['date'])."</td>
                 <td><strong>$array[noso]</strong> NOSO</td></tr>";
            }
            return $value;
    }


}