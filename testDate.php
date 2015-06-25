<?php
$date_register = date("Y-m-d");
echo strtotime("2015-05-10");
$rd = strtotime($date_register);
var_dump(strtotime($date_register));
echo date("Y-m-d",$rd);
?>