 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {$name = $_POST['name'];}
    if (isset($_POST['email'])) {$email = $_POST['email'];}
    if (isset($_POST['tel'])) {$tel = $_POST['tel'];}
    if (isset($_POST['mes'])) {$mes = $_POST['mes'];}
    if (isset($_POST['formData'])) {$formData = $_POST['formData'];}

    $to = "yanchenko.kiev@gmail.com"; /* sfera.help.auto@gmail.com Укажите адрес, га который должно приходить письмо  */
    
	$sendfrom   = "globaltraffic@gmail.com"; /*Укажите адрес, с которого будет приходить письмо, можно не настоящий, нужно для формирования заголовка письма*/
    $headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    //$headers .= "Reply-To: ". strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
    $subject = "Заявка с сайта 'globaltraffic.shop'";
    $message = "$formData <br>Клиент оставил следующие данные: <br> 
    <b>Имя :</b> $name <br>
     <b>Почта :</b> $email <br>
      <b>Телефон :</b> $tel <br>
       <b>Сообщение :</b> $mes <br>";
    $send = mail ($to, $subject, $message, $headers);
    if ($send == 'true')
    {
            header('Location: thanks.html');
            exit;

    }
    else 
    {
		echo '<center><p class="fail"><b>Error. Try again later! </b></p></center>';
    }
	
} else {
    
	http_response_code(403);
    echo "Попробуйте еще раз";
	
}
?>