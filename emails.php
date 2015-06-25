<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="bootstrap-select/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/tryppp.css" />
<link rel="stylesheet" type="text/css" href="css/paginate.css" />
</head>
<body>

<div class="container">
<div class="text-center"><h3>TryPPP DATABASE</h3></div>
<table id="paginated">
<thead>
	<tr class='row email-header'>
		<th class='email-header'>No</th>
		<th class='email-header'>Registration Date</th>
		<th class='email-header'>Name</th>
		<th class='email-header'>NRIC</th>
		<th class='email-header'>Mobile Number</th>
		<th class='email-header'>Email</th>
		<th class='email-header'>Outlet</th>
		<th class='email-header'>Source</th>
		<th class='email-header'>Contact Status</th>
		<th class='email-header'>Treatment Status</th>
		<th class='email-header'>Conversion</th>
		<th class='email-header'>Conversion Date</th>
		<th class='email-header'>Remarks</th>
	</tr>
</thead>
<tbody>
<?php 
session_start();

if(!isset($_SESSION["token"]) || $_SESSION["token"] == ""||!isset($_GET["email"])  )
//if(false)
	header("Location: google/index.php");
else 
{
	echo "<div class='text-left'> You are currently logging in as <strong>".$_GET["email"]."</strong>";
	$current_login = $_GET["email"];
	if(strpos($current_login,"ppp.com.sg")===false) 
	//if(false)
		echo "<div><strong>You don't have permission to this site.</strong></div>
				<div><a class='logout' href='javascript:void(0);'>Log out</a></div>";
	else{
		echo "<div style='margin-top:20px;margin-bottom:20px'><a href='export.php'>Dowload CSV</a></div>";
		$db = new SQLite3('tryppp.db');
		$i = 0;
		$results = $db->query('SELECT * FROM tryppp');
		while ($row = $results->fetchArray()) {
			$i++;
			echo "<tr class='row row".($i%2)."'>"
					."<td class='col-xs-1'>".$i."</td>"
					."<td class='col-xs-1'>".date("Y-m-d",$row["date_register"])."</td>"
					."<td class='col-xs-1'>".$row["name"]."</td>"
					."<td class='col-xs-1'>".$row["nric"]."</td>"
					."<td class='col-xs-1'>".$row["mobile"]."</td>"
					."<td id='email".$i."' class='col-xs-2'>".$row["mail"]."</td>"
					."<td class='col-xs-1'>".$row["outlet"]."</td>"
					."<td class='col-xs-1'>".$row["hear"]."</td>"
					."<td class='col-xs-1'><select id='status".$i."' >
												<option ".(($row['status']=='Not Contacted')?'selected':'').">Not Contacted</option>
												<option ".(($row['status']=='Contacted')?'selected':'').">Contacted</option>
											</select></td>"
					."<td class='col-xs-1'><select id='treatment_status".$i."'>
												<option ".(($row['treatment_status']=='Not done')?'selected':'').">Not done</option>
												<option ".(($row['treatment_status']=='Done')?'selected':'').">Done</option>
											</select></td>"
					."<td class='col-xs-1'><select id='conversion".$i."'>
												<option ".(($row['conversion']=='Yes')?'selected':'').">Yes</option>
												<option ".(($row['conversion']=='No')?'selected':'').">No</option>
											</select></td>"
					."<td class='col-xs-1'><input class='dc' id='date_conversion".$i."' type='text' value='".$row["date_conversion"]."' /></td>"
					."<td class='col-xs-3'><textarea id='remarks".$i."'>".$row["remarks"]."</textarea></td>"
					."<td class='col-xs-1'><input class='update_button' id='update".$i."' onclick = 'update(".$i.");' type='button' value='UPDATE' /></td>"
					." </tr>"; 
			}
		}
}
?>
</tbody>
</table>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
   <script src="bootstrap-select/js/bootstrap-select.min.js"></script>
   <script type="text/javascript" src="google/js/oauthpopup.js"></script>
   <script type="text/javascript" src="js/paginate.js"></script>
   <script>
   $(".dc").datepicker();
   $('a.logout').googlelogout({
			redirect_url:'emails.php'
		});
   function update(i){
	   		$("#update"+i).val("UPDATING...");
			$("#update"+i).addClass("updating_button").removeClass("update_button");

      $.ajax({
		  method:"POST",
		  url:"updateDB.php",
		  data : {
			  email: $("#email" + i).html(),
			  status: $("#status"+i).val(),
			  treatment_status : $("#treatment_status"+i).val(),
			  conversion : $("#conversion"+i).val(),
			  remarks : $("#remarks"+i).val(),
			  date_conversion : $("#date_conversion"+i).val(),
		  },
		  success: function(msg){
			  $("#update"+i).val("UPDATED");
			  }
	  });
	}
   </script>
</body>
</html>