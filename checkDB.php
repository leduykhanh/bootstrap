<?php 
$name = $_POST["name"];
$nric = $_POST["nric"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$outlet = $_POST["outlet"];
$hear = $_POST["hear"];

$db = new SQLite3('tryppp.db');

/*$results = $db->query('SELECT * FROM tryppp');
$query = "UPDATE tryppp
						SET name = $name,
							nric = $nric,
							email = $email,
							mobile=$mobile,
							outlet=$outlet,
							hear=$hear";
							*/
$date_register = strtotime(date("Y-m-d"));
$query = "INSERT INTO tryppp(mail,mobile,name,nric,outlet,hear,status,date_register) values('$email','$mobile','$name','$nric','$outlet','$hear','Not Contacted',$date_register)";
$results = $db->query($query);

require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "feedback@ppp.com.sg";
$mail->Password = "feedback123";
$mail->SetFrom("feedback@ppp.com.sg");
$mail->Subject = "Thanks for registering with PPP";
$mail->Body = "<h1> Thanks $name for joining us </h1>
				<div> Our staffs at $outlet will contact you shortly with in 72 hours. </div>
				<div>PPP team. </div>
			";
$mail->AddAddress($email);
$recipient = "duykhanh.le@ppp.com.sg";
$ccList = array("duykhanh.le@ppp.com.sg");
if($outlet=="AMK CENTRAL") $recipient = "amk@ppp.com.sg";
else if ($outlet=="ARC (Alexandra Retail Centre)") $recipient = "arc@ppp.com.sg";
else if ($outlet=="BEDOK") $recipient = "bdk@ppp.com.sg";
else if ($outlet=="BISHAN MRT") $recipient = "bsh@ppp.com.sg";
else if ($outlet=="DHOBY GHAUT") $recipient = "dbg@ppp.com.sg";
else if ($outlet=="GOLDEN SHOE") $recipient = "gds@ppp.com.sg";
else if ($outlet=="LUCKY PLAZA") $recipient = "lpl@ppp.com.sg";
else if ($outlet=="NEX") $recipient = "nex@ppp.com.sg";
else if ($outlet=="RAFFLES CITY") $recipient = "rfc@ppp.com.sg";
else if ($outlet=="WEST COAST") $recipient = "wcp@ppp.com.sg";
else if ($outlet=="YISHUN CENTRAL") $recipient = "ysh@ppp.com.sg";
			
 if(!$mail->Send())
    {
    echo 0;
    }
	else 
	{echo 1;
		$mail->ClearAllRecipients();
		$mail->AddAddress($recipient);
		foreach ($ccList as $cc){
			$mail->AddCC($cc);
		}
	
		//$mail->AddAddress("duykhanh.le@ppp.com.sg");
		//$mail->AddAddress("michelle.goh@ppp.com.sg");
		//$mail->AddAddress();
		//$mail->AddAddress("");
		//$mail->AddAddress("");
		//$mail->AddAddress();
		//$mail->AddAddress();
		//$mail->AddAddress("tim.lee@ppp.com.sg");
		$mail->Subject = "New Customer from TryPPP";
		$mail->Body = "<h1> Customer $name : </h1>
						<div> Name : $name</div>
						<div> Mobile : $mobile</div>
						<div> NRIC : $nric</div>
						<div> email : $email</div>
						<div> Outlet : $outlet</div>
						<div> Hear from : $hear</div>
						<div> Please refer to www.tryppp.com/emails.php for the emails list.</div>
					";
		$mail->Send();
	}
?>