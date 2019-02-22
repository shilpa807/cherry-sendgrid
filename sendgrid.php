<?php
require("sendgrid-php/sendgrid-php.php");
$fromEmail = "support@".$current_domain_name;
$htmlContent = $message;
$from = new SendGrid\Mail\From($fromEmail);
$to = new SendGrid\Mail\To($to);
$content = new SendGrid\Mail\Content("text/html", $htmlContent);
$email = new SendGrid\Mail\Mail($from, $to, $subject);
$email->addContent($content);

$sg = new SendGrid('MY_SENDGRID_ID');
try {
    $response = $sg->client->mail()->send()->post($email);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}        
if( isset($response) ){
    if($_SESSION['username']!='')
    {
        $sucess = "You are now logged in";
        header("location: checkout.php");
    }  
    else 
    {
        header('Refresh: 1; url=login_register.php?action=joined');
    }    
}

}
?>
