<?php
require_once __DIR__ . '/amocrm.phar';

	$product_name = trim($_POST['product_name']);
	$product_price = trim($_POST['product_price']);
	$customer_name = trim($_POST['customer_name']);
	$customer_phone = trim($_POST['customer_phone']);
	$customer_message = trim($_POST['customer_message']);
	$mail_subject = "Покупатель интересуется товаром: ".iconv("UTF-8", "windows-1251", $product_name);

	if (isset($customer_name) && $customer_name!=="" && isset($customer_phone) && $customer_phone!=="") {
		$store_email = "info@stanok-chpu.ru";
		$fast_order_email = "info@stanok-chpu.ru";
		$product_name = iconv("UTF-8", "windows-1251", $product_name);
		$product_price = iconv("UTF-8", "windows-1251", $product_price);
		$subject   = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
		$customer_name = iconv("UTF-8", "windows-1251", $customer_name);
		$customer_phone = iconv("UTF-8", "windows-1251", $customer_phone);
		$customer_message = iconv("UTF-8", "windows-1251", $customer_message);
		$subject = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
		$headers = "From: <".$fast_order_email.">\r\n";
		$headers = $headers."Return-path: <".$fast_order_email.">\r\n";
		$headers = $headers."Content-type: text/plain; charset=\"windows-1251\"\r";
		mail($store_email,$mail_subject,"Запрос цены\n\nДата: ".date('d.m.Y H:i')."\nЗаказчик: ".$customer_name."\nТелефон: ".$customer_phone."\nКомментарий: ".$customer_message."\n\nТовар: ".$product_name."\nЦена от: ".$product_price,$headers);
		mail("svpuniyar@yandex.ru",$mail_subject,"Запрос цены\n\nДата: ".date('d.m.Y H:i')."\nЗаказчик: ".$customer_name."\nТелефон: ".$customer_phone."\nКомментарий: ".$customer_message."\n\nТовар: ".$product_name."\nЦена от: ".$product_price,$headers);
		mail("ewseew.alex@yandex.ru",$mail_subject,"Запрос цены\n\nДата: ".date('d.m.Y H:i')."\nЗаказчик: ".$customer_name."\nТелефон: ".$customer_phone."\nКомментарий: ".$customer_message."\n\nТовар: ".$product_name."\nЦена от: ".$product_price,$headers);
	} else {
		echo "empty";
	};
	


// ##### часть скрипта для amoCRM (скайп stas0skype) #####

$tags = 'stanok-chpu.ru'; // это передаваемые теги (если несколько, то через запятую)

if (isset($_POST['customer_phone'])) {

  try {
    
      // Создание клиента
      $subdomain = 'new5914783955127';    
      $login     = 'yar@stanok-chpu.ru';
      $apikey    = 'ca5068ea101928057168b37bc26db0fb';

      $amo = new \AmoCRM\Client($subdomain, $login, $apikey);

        // Вывести полученые из амо данные (служебное)
        // echo '<pre>';
        // print_r($amo->account->apiCurrent());
        // echo '</pre>';

        // создаем лида
        $lead = $amo->lead;
        $lead['name'] = $_POST['product_name'];
		$lead['tags'] = $tags;
        // $lead['responsible_user_id'] = 2462338; // ID ответсвенного 
        // $lead['pipeline_id'] = 1207249; // ID воронки

        $lead->addCustomField(229649, 'Заявка с сайта');
		$lead->addCustomField(229651, $_POST['customer_message']);
		
        $id = $lead->apiAdd();

      // Получение экземпляра модели для работы с контактами
      $contact = $amo->contact;

      // Заполнение полей модели
      $contact['name'] = isset($_POST['customer_name']) ? $_POST['customer_name'] : 'Не указано';
      $contact['linked_leads_id'] = [(int)$id];

		//        $contact->addCustomField(305117, [
		//            [$_POST['city']],
		//        ]);
        		
		$contact->addCustomField(95744, [
            [$_POST['customer_phone'], 'MOB'],
        ]);

		
      // Добавление нового контакта и получение его ID
      $id = $contact->apiAdd();

  } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
  }

}
// ##### конец части скрипта для amoCRM #####





?>