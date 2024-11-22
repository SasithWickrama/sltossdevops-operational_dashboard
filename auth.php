<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
include 'dbcon.php';



if (!$CON) 
{
  die('Not connected : ' );
}




	$CON = OracleConnection();
	
	$sql = "select * from DASHBOARD_LOGIN  where USER1='".$_POST['serviceId']."' and PASSWORD='".$_POST['txtPassword']."'";
	//echo $sql;
	$userid = oci_parse($CON, $sql);
	oci_execute($userid);
	$row= oci_fetch_array($userid);

   	 if($row[3] == $_POST['serviceId'] )
	 {

	 $_SESSION['$user']= $row['USER1'];
	 $_SESSION['$username']= $row['USER_NAME'];
	 $_SESSION['$p_level']= $row['STATUS'];
	 $_SESSION['loggedin'] = true;

	 echo '<script type="text/javascript"> document.location = "menu.php";</script>';

		

        }else{
		echo "<script type='text/javascript'>alert('Invalid User Name or Password')</script>";
		echo '<script type="text/javascript"> document.location = "./index.html";</script>';
		}


?>

