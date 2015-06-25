<?php
    $filename ="tryPPP-".date("Y-m-d").".csv";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
	
	echo "No,	Registration_Date,Name,NRIC,Mobile_Number,Email,Outlet,	Source,Contact_Status,Treatment_Status,Conversion,Conversion_Date,	Remarks \r\n";
		$db = new SQLite3('tryppp.db');
		$i = 0;
		$results = $db->query('SELECT * FROM tryppp');
		while ($row = $results->fetchArray()) {
			$i++;
			echo "".$i.",".date("Y-m-d",$row["date_register"]).",\"".$row["name"]."\",".$row["nric"].",".$row["mobile"].",".$row["mail"].",\"".$row["outlet"]."\",\"".$row["hear"]."\",\"".$row['status']."\",\"".$row['treatment_status']."\",".$row['conversion'].",".$row["date_conversion"].",\"".$row["remarks"] ." \" \r\n";
			}
exit;

?>