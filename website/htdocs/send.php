<?php

$to = 'paulhappyhutchinson@gmail.com';
$sitename = 'AutoPlane';

error_reporting(E_ERROR);
require_once('./templates/email_address_validator.php');

$validator = new EmailAddressValidator;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$website = isset($_POST['website']) ? $_POST['website'] : '';

if(strlen($name) === 0) die('missing_name');
if(strlen($email) === 0) die('missing_email');
if(!$validator->check_email_address($email)) die('invalid_email');
if(strlen($message) < 5) die('missing_message');

$message = $message . "\r\n\r\nWebsite: " . $website;

$subject = '[' . $sitename . '] New contact message from ' . $name . ' ( ' . $email . ' )';
$headers = 'From: ' . $sitename . ' <' . $to . '>\r\nReply-To: ' . $email . '\r\n';

$s = mail($to , $subject , $message , $headers);
echo $s ? 'success' : 'failure';

?>
