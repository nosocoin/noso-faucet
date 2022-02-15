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
     * Напиши мини руководство, по поводу ключец генерации
     * 1. Открываем страницу фаусет
     * 2. На этой странице проверяем можно ли подать пост кнопки на второй степ
     * 2.1 Если можно то мы генерируем в этом условии код, который передает в бд и по пост
     * 3. Переходим сверяем код, если вс ок то переведим на дркгкю стрпнцу если нет очисчаем код в бд и возвращаем на фаусет
     * 4. На заключном етапе переводим код, в процессс и после всех дел очищаем код из бд и даем награду!
     * 
     * 
     */



     


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