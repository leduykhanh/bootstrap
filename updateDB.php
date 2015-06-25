<?php 
$db = new SQLite3('tryppp.db');
$email = $_POST["email"];
$status = $_POST["status"];
$treatment_status = $_POST["treatment_status"];
$conversion = $_POST["conversion"];
$remarks = $_POST["remarks"];
$date_conversion = $_POST["date_conversion"];
$query = "UPDATE tryppp 
		  SET status='$status',
			  treatment_status = '$treatment_status',
			  conversion = '$conversion',
			  remarks = '$remarks',
			  date_conversion = '$date_conversion'
		  WHERE mail='$email'";
$db->query($query);
echo 1;
?>