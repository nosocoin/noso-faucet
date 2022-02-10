<?php

namespace NosoProject\Model;

final class ClaimModel {
    private $container;
    private $settings;

    public function __construct($container){
          $this->container = $container;
          $this->settings = $container->get('settings')['recaptcha'];
    }


  /**
	 * Array of settings for the view
	 */
	public function OptionArray(){
		return [
			'title' => 'Claim',
			'PublicKey' => $this->settings['PublicKey'],
      'ViewPayments' => false
		];}


}