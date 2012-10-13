<?php

  require('includes/application_top.php');

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Portal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>intelliTECH Portal</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<link href="css/portal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<!-- InstanceEndEditable -->
</head>

<body>

<div class="header-wrap">

<div class="header"><img src="images/ICG-logo-invisible.png" alt="logo" width="275" height="75" usemap="#Map" class="logo-link" border="0" />
  <map name="Map" id="Map">
    <area shape="rect" coords="5,5,270,71" href="http://erpc/" />
  </map>
</div>

<!-- InstanceBeginEditable name="EditRegion4" -->

 <div class="banner"><img src="images/switches.png" alt="switches" name="bimage" width="938" height="155" id="bimage" /> </div>
  <!-- InstanceEndEditable -->
</div>

<div class="container">

<div class="main-content">

  <!-- InstanceBeginEditable name="EditRegion3" --><!-- #BeginLibraryItem "/Library/Portal-Nav.lbi" -->

<div class="sidebar1">
    <ul class="nav">
      <li><a href="index.php">Submit Ticket</a></li>
      <li><a href="portal-status.php">Ticket Status</a></li>
      <li><a href="portal-reports.php">Reports</a></li>
      <li><a href="administrators.php">Admin</a></li>
    </ul>

   <p><b>Admin Contact</b><br />
   <?php echo (tep_session_is_registered('admin') ? ' ' . $admin['fullname']  . ' ' : ''); ?><br><br>
   <p><b>Company</b><br />
   <?php echo (tep_session_is_registered('admin') ? ' ' . $admin['company']  . ' ' : ''); ?><br><br>
   <p><b>Admin Status</b><br />
   <?php echo (tep_session_is_registered('admin') ? ' ' . $admin['admin_status']  . ' ' : ''); ?>
	
    <!-- end .sidebar1 --></div><!-- #EndLibraryItem --><h2>Check Ticket Status</h2>
    <p>Please type in your unique 5 digit ticket number and click &quot;Search&quot; to get an update on your current ticket status. 
	If you never recieved your ticket number you may look it up by the site address in the drop down menu on the <a href="portal-reports.php">reports page</a> 
	or you may call intelliTECH support to inquire. See contact information at the bottom of the page. If you ticket dosen't show up anywhere please resubmit
	the ticket under <a href="portal-ticket.php">Submit Ticket.</a></p><br />
    
    
   <!-- BEGIN PHP CODE FOR SEARCHING TICKET STATUS -->
  <?php $c = 0; ?>

<?php $c = 0; 
// DEFINE VARIABLES
if( isset($_POST['term'])){
	$term = $_POST['term'];
} else { $term = " ";}

if( isset($_POST['Tech'])){
	$term = $_POST['Tech'];
} else {$Tech = "ZZZZZZZ";	}

if( isset($_POST['Accnt'])){
	$term = $_POST['Accnt'];
} else { $Accnt = "ZZZZZZZ";	}
?>

<form name="search" class="searchSO" method="post" action="">
<span id="sprytextfield1"><b>Ticket Number</b><br />
<input type="text" name="term" />
<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">5 digit ticket number required. </span><span class="textfieldMaxCharsMsg">5 digit ticket number required. </span></span>
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form><br>

<?php
// DATABASE CONNECTION
$serverName = "erpc\sqlexpress";
$connectionInfo = array( "Database"=>"sample", "UID"=>"sa", "PWD"=>"28June08");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }

// QUERY 1
$sql = "SELECT SONumber, BriefDescription, GeneralSymptoms, GeneralResolutions, TechAssigned, DateReceived, TimeReceived, AccountNumber, DateClosed, TimeClosed
FROM tblServiceOrders WHERE SONumber LIKE '%$term%'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {   die( print_r( sqlsrv_errors(), true) ); }

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
{ echo "<p><b>Ticket:</b> ".$row['SONumber']."<br /> <b>Subject:</b> ".$row['BriefDescription']."<br /> 
	  <b>Work Requested:</b> ".$row['GeneralSymptoms']."<br /> <b>Work Done:</b> ".$row['GeneralResolutions']." ";
$Tech = $row['TechAssigned'];
$Accnt = $row['AccountNumber']; 

// TIME STAMPS
echo "<br><b>Time Recieved:</b> ";
echo date_format($row['DateReceived'], 'Y-m-d');
echo date_format($row['TimeReceived'], ' H:i:s');
echo "<br><b>Time Closed:</b> ";
echo date_format($row['DateClosed'], 'Y-m-d');
echo date_format($row['TimeClosed'], ' H:i:s');
}

// QUERY 2
$sql2 = "SELECT RepName FROM tblReps WHERE RepNumber LIKE '%$Tech%'";
$stmt = sqlsrv_query( $conn, $sql2 );
if( $stmt === false) { die( print_r( sqlsrv_errors(), true) ); }
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
{ echo " <br><b>Tech Assigned:</b> ".$row['RepName']." "; }

// QUERY 3
$sql3 = "SELECT AccountName FROM tblAccounts WHERE AccountNumber LIKE '%$Accnt%'";
$stmt = sqlsrv_query( $conn, $sql3 );
if( $stmt === false) { die( print_r( sqlsrv_errors(), true) ); }
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
{ echo " <br><b>Account Name:</b> ".$row['AccountName']." </p><br /><br>"; }

sqlsrv_free_stmt( $stmt);
?>

<br>  
 <!-- END PHP CODE FOR SEARCHING TICKET STATUS --> 
  
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:5, maxChars:5});
  </script>
  <!-- InstanceEndEditable -->
<!-- end .content --></div></div>
<div class="footer-wrap">
  <div class="footer">
    <p><a href="login.php?action=logoff">Logout</a></p>
  <!-- end .footer --></div><a href="includes/stylesheet.css"></a>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
