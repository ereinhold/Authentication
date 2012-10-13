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
	
    <!-- end .sidebar1 --></div><!-- #EndLibraryItem --><h2>Reports by Site</h2>
    <p>Please select one of your sites in the drop down below to see the last 40 work request tickets we have recieved for the site. 
	You can see which requests we have resolved and which ones we are still working on. After you run the report it will display the account number in the search field.
	For specific ticket information please search for the ticket number in <a href="portal-status.php">Ticket Status.</a></p>
    
<h2>View Site Tickets - Last 40</h2>

<?php $c = 0; 
// DEFINE VARIABLES
if( isset($_POST['term'])){
	$term = $_POST['term'];
} else { $term = " ";}

?>

<form id="Search" name="Search" method="post" action="">
  <label for="term">Account</label>
  <select name="term" id="term">
    <option selected="selected"><?php echo "$term"?></option>

<?php
// DATABASE CONNECTION FOR DROPDOWN FIELD
$serverName = "erpc\sqlexpress";
$connectionInfo = array( "Database"=>"sample", "UID"=>"sa", "PWD"=>"28June08");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }

// DROPDOWN QUERY
$sql = "SELECT AccountNumber, AccountName FROM tblAccounts";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {   die( print_r( sqlsrv_errors(), true) ); }
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
{ echo "<p><b>Subject:</b><option value='".$row['AccountNumber']."'>".$row['AccountName']."</option>"; 

}
?>

  </select>
 <input type="submit" name="search" value="Run Report" />
 </form><br>

 
 
<?php

// QUERY TITLE
$sql3 = "SELECT AccountName FROM tblAccounts WHERE AccountNumber LIKE '%$term%'";
$stmt = sqlsrv_query( $conn, $sql3 );
if( $stmt === false) { die( print_r( sqlsrv_errors(), true) ); }
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 

{ echo "<b>Name:  </b>".$row['AccountName']." </p>"; }

// QUERY 1 - Service Orders
$sql2 = "SELECT SONumber, BriefDescription, GeneralSymptoms, GeneralResolutions, TechAssigned, DateReceived, TimeReceived, AccountNumber, DateClosed, TimeClosed
FROM tblServiceOrders WHERE AccountNumber LIKE '%$term%'";
$stmt = sqlsrv_query( $conn, $sql2 );
if( $stmt === false) {   die( print_r( sqlsrv_errors(), true) ); }

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 

{ echo "<p><b>Ticket:</b> ".$row['SONumber']."<br /> <b>Subject:</b> ".$row['BriefDescription']."<br>"; 

// TIME STAMPS
echo "<b>Date Recieved:</b> ";
echo date_format($row['DateReceived'], 'Y-m-d');
echo "<br><b>Date Resolved:</b> ";
echo date_format($row['DateClosed'], 'Y-m-d');
}

sqlsrv_free_stmt( $stmt);
?>

</p><br /> <br>
    
  <!-- InstanceEndEditable -->
<!-- end .content --></div></div>
<div class="footer-wrap">
  <div class="footer">
    <p><a href="login.php?action=logoff">Logout</a></p>
  <!-- end .footer --></div><a href="includes/stylesheet.css"></a>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
