<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
require_once 'config.php';
require_once 'lib/Google_Client.php';
$client = new Google_Client();

unset($_SESSION['token']);
$client->revokeToken();
header("Location: http://www.tryppp.com/google/index.php");

?>


