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
   
    <!-- end .sidebar1 --></div><!-- #EndLibraryItem --><h2>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?> <?php echo $_SESSION['SESS_LAST_NAME'];?></h2>
    <p>Welcome to the intelliTECH client portal. Here you can submit tickets, check ticket status, and see some reports of the work intelliTECH has done at your different sites.</p>
    <h2>Submit a Ticket</h2>
    <p>Please fill out all the fields below and click submit to send a work order request to intelliTECH.    </p>
   <p> 
    
  <form id="form1" name="form1" method="post" action="z3ndmail.php"> 
   <input type="hidden" name="env_report" value="REMOTE_HOST,REMOTE_ADDR,HTTP_USER_AGENT,AUTH_TYPE,REMOTE_USER" />
   <input type="hidden" name="recipients" value="eric.reinhold@intellitechaz.com" />
   <input type="hidden" name="required" value="EmailAddr:Your email address,FullName:Your name" />
   <input type="hidden" name="subject" value="Ticket Submission from Website" />
   <input type="hidden" name="derive_fields" value="email=EmailAddr,realname=FullName" />
   <input type="hidden" name="mail_options" value="Exclude=email;realname" />
   
  <label for="Account">Account</label>
  <select name="Account" id="Account">
  <option selected="selected"><?php echo "$Account"?></option>

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
{ echo "<p><b>Subject:</b><option value='".$row['AccountName']." - #".$row['AccountNumber']."'>".$row['AccountName']."</option> "; }
?>
  </select>
<br>
      
      <br /><br />
    
      <label for="contactname">Name</label>
      <input type="text" name="FullName" id="FullName" />
	<br />
    <label for="contactemail">Eamil</label>
      <input type="text" name="EmailAddr" id="EmailAddr" /> 
      <br />
      <label for="Phone">Phone </label>
      <input type="text" name="Phone" id="Phone" />    
            <label for="Extension">Ext </label>
      <input type="text" size="8" name="Extension" id="Extension" />   
      <br />
   
      <br />Description of Problem<br />
      <textarea name="problem" cols="80" rows="5" id="problem"></textarea>
      <br />
      <input name="Send" type="Submit" value="Submit Request" />
      
    </form></p>
      <br />
      <br />
   
  <!-- InstanceEndEditable -->
<!-- end .content --></div></div>
<div class="footer-wrap">
  <div class="footer">
    <p><a href="login.php?action=logoff">Logout</a></p>
  <!-- end .footer --></div><a href="includes/stylesheet.css"></a>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
