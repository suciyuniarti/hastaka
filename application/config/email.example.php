<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| EMAIL CONFIGURATION
| -------------------------------------------------------------------
| Salin file ini menjadi email.php dan isi dengan kredensial SMTP Anda.
| Jangan commit file email.php yang berisi kredensial asli ke repository.
|
| -------------------------------------------------------------------
*/

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'your_smtp_host';
$config['smtp_user'] = 'your_smtp_email@example.com';
$config['smtp_pass'] = 'your_smtp_password';
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['validation'] = TRUE;