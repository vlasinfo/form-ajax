<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ($post = mso_check_post('field')) 
{
	$to = 'ваш@email'; // адрес получателя
	$subject = 'Тема письма'; // тема письма
	
	$email = $post['field']['email']; // поле email
	$name = trim($post['field']['name']); // поле имя
	$message = trim($post['field']['message']); // поле сообщения
	
	// проверка emil
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		echo 'Неверный email! Обновите страницу (F5) и укажите правильный адрес';
		exit;
	}
	
	if (!$name)
	{
		echo 'Не указано имя! Обновите страницу (F5) и укажите своё имя';
		exit;
	}
	
	if (!$message)
	{
		echo 'Не указан текст сообщения! Обновите страницу (F5) и введите текст';
		exit;
	}	
	
	// формируем headers для письма
	$headers = 'From: '. $email . "\r\n"; // от кого

	// формируем тело сообщения
	$message = 'Имя: ' . $name . NR . 'Email: ' . $email . NR . NR . NR . $message; 
	 
	// кодируем заголовок в UTF-8
	$subject = preg_replace("/(\r\n)|(\r)|(\n)/", "", $subject);
	$subject = preg_replace("/(\t)/", " ", $subject);
	$subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

	// отправка
	@mail($to, $subject, $message, $headers);

	echo 'Спасибо, ваше сообщение отправлено!';
}

?>