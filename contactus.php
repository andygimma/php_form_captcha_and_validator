<!--
Andy Gimma
Copyright 2014

Instructions:

Set $my_email, #my_recipient.
create captcha_success.html and captcha_failure pages, and include them in the same directory

Description:
This uses realperson.js from this link http://keith-wood.name/realPerson.html.

On the server side, you have to catch the entered captca value $_POST['defaultReal'] and the hash associated with it on the front end
$_POST['defaultRealHash']. Then you have to use rpHash($value) on 'defaultReal', and compare hashes.

If the hashes are equal, you can send your email.
-->

<?php 
$my_email = "";
$my_recipient = "";

function rpHash($value) { 
    $hash = 5381; 
    $value = strtoupper($value); 
    for($i = 0; $i < strlen($value); $i++) { 
        $hash = (($hash << 5) + $hash) + ord(substr($value, $i)); 
    } 
    return $hash; 
}

if (rpHash($_POST['defaultReal']) == $_POST['defaultRealHash']) { 
  $fullname = $_POST['fullname'];
  $email = $my_email;
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $formcontent = "From: $fullname \n Message: $message";
  $recipient = $my_recipient;
  $mailheader = "From: $email \r\n";
  if ('127.0.0.1' == $_SERVER["REMOTE_ADDR"]) {
    header("Location: captcha_success.html");
    die();
  } else {
    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
//  echo "<center><br><br><br>Thank You! Click <a href=\"index.html\">here to return</a> to the Home Page"; 
    header("Location: captcha_success.html");
    die();
  }
} else {
//  echo "<center><br><br><br>Validation entered incorrectly"; 
    header("Location: captcha_failure.html");
    die();
}
?>
