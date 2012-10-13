<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/staff-security.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<link href="../x-resource-files/css/security.css" rel="stylesheet" type="text/css" />
<link href="../x-resource-files/css/html.css" rel="stylesheet" type="text/css" />
<link href="../x-resource-files/css/html.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body class="thrColAbsHdr">

<div id="container">
  <div id="mainContent"><br />
    <!-- InstanceBeginEditable name="MainContent" -->
    <?php

include('../cgi-bin/functions.php'); 
$link = dbconn();

	$number =$_POST['number'];
	$item2 =$_POST['item2'];
	$modify2 =$_POST['modify2'];	

$result= mysql_query("UPDATE sermondata SET $item2='$modify2' WHERE number = '$number'")
	or die(mysql_error());

echo "<br><br><br><br><b>The changes below have been made:</b>"; 

echo "<br>Row: ";
echo $number; 
echo "<br>Column: ";
echo $item2; 
echo "<br>Changed to: ";
echo $modify2; 
?> 

<br><br><a href='staff-sermons.php'>View Sermons Table</a> | 
<a href='upload.html'>Upload Sermon</a>


  <!-- end #mainContent --><!-- InstanceEndEditable --></div>
  <!-- end #container -->
</div>
</body>
<!-- InstanceEnd --></html>
