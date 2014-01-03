<?php 
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
  $email = "stiehls@stiehlsbodymod.c	om";
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $formcontent = "From: $fullname \n Message: $message";
  $recipient = "zachary.a.straub@gmail.com";
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
