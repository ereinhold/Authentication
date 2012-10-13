<?php
	//Start session
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
//	if ($_SESSION['admin_status'] == 'no ') {
//		header("location: index.php");
//		exit(); }
$var1 = (tep_session_is_registered('admin') ? ' ' . $admin['admin_status']  . ' ' : ''); 

	?>
<?php 

if (strpos($var1,'yes') !== false) {
    echo 'You are an admin';
}
		else { header("location: access-denied.html"); }

?> 



