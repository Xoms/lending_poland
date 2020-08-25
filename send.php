<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$recepient = "visa365poland@gmail.com";
	$sitename = "voditel365.online";
	$from_name  = "Форма voditel365.online";
	$from_email = "visa365poland@gmail.com";

	$email_headers = "Return-Path: <" . $from_email . ">\r\n";
	$email_headers .= "From: " . $from_name . " <" . $from_email . ">\r\n";
	$email_headers .= "Reply-To: " . $from_name . " <" . $from_email . ">\r\n";
	$email_headers .= "Content-type: text/html; charset=\"utf-8\"\r\n";
	$email_headers .= "Content-Transfer-Encoding: 8bit\r\n";

	$email_content = "Данные заявки: <br>";

	if(isset($_POST["subject"])){
		$email_content .= "<br>Тема: " . trim($_POST["subject"]) . "\r\n";
	}
	if(isset($_POST["name"])){
		$email_content .= "<br>Имя: " . trim($_POST["name"]) . "\r\n";
	}
	if(isset($_POST["phone"])){
		$email_content .= "<br>Телефон: " . trim($_POST["phone"]) . "\r\n";
	}
	if(isset($_POST["email"])){
		$email_content .= "<br>Email: " . trim($_POST["email"]) . "\r\n";
	}
	if(isset($_POST["text"])){
		$email_content .= "<br>Текст: " . trim($_POST["text"]) . "\r\n";
	}

	$subject = 'Заявка с сайта «' . $sitename .  "»";

	$response = mail($recepient, $subject, $email_content, $email_headers);

	if($response){
		// Set a 200 (okay) response code.
		
		//file_put_contents('leads/'.date('d-m-Y').'.txt', $_POST['name'].':'.$_POST['phone'].':'.$_POST['email']."\n", FILE_APPEND | LOCK_EX);
		
		//transferPost(); // передать пост в CRM
	  http_response_code(200);
	  echo json_encode("Thank You! Your message has been sent.");
	}
	else{
		// Set a 500 (internal server error) response code.
	  http_response_code(500);
	  echo json_encode("Oops! Something went wrong and we couldn't send your message.");
	}
}
else{
	// Not a POST request, set a 403 (forbidden) response code.
	http_response_code(403);
  echo json_encode("There was a problem with your submission, please try again.");
}

function transferPost()
{
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	    // CURLOPT_URL => "ultrahome.online/hook.php",
	    CURLOPT_URL => "betester.monster/to_crm.php",
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 0,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "POST",
	    CURLOPT_POSTFIELDS => $_POST,
	  ));
	  $response = curl_exec($curl);
	  curl_close($curl);
	}
}
?>
