<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
session_start();

$base_url= filter_var('', FILTER_SANITIZE_URL);

// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
define('CLIENT_ID','122986120465-kp4rm372on25eovkcgt8o5b0cof8v5b4.apps.googleusercontent.com');
define('CLIENT_SECRET','TaLgvcD9_dwCkraTro5MhhTX');
define('REDIRECT_URI','http://www.tryppp.com/google/index.php');
define('APPROVAL_PROMPT','auto');
define('ACCESS_TYPE','offline');
?>