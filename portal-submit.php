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
  <div class="banner"><img src="images/switches.png" width="938" height="155" alt="switches" /> </div>
<!-- InstanceEndEditable -->
</div>

<div class="container">

<div class="main-content">

  <!-- InstanceBeginEditable name="EditRegion3" -->

<div class="content">
 
    <h2>Added Ticket</h2>

 <?php 
 
 //This is the directory where images will be saved 
 $target = "../x-resource-files/sermons/"; 
 $target = $target . basename( $_FILES['sermon']['name']); 
 
 // Connects to your Database 
include('../cgi-bin/functions.php'); 
$link = dbconn(); 

 //This gets all the other information from the form 
 $title=$_POST['title']; 
 $series=$_POST['series']; 
 $preacher=$_POST['preacher']; 
 $passage=$_POST['passage']; 
 $date=$_POST['date']; 
 $pic=($_FILES['sermon']['name']); 

 
 //Writes the information to the database 
 mysql_query("INSERT INTO `sermondata` VALUES ('$number', '$title', '$series', '$preacher', '$passage', '$date', '$pic')") ; 
 
 //Writes the photo to the server 
 if(move_uploaded_file($_FILES['sermon']['tmp_name'], $target)) 
 { 
 
 //Tells you if its all ok 
echo "The file ". basename( $_FILES['sermon']['name']). " has been uploaded, and your information has been added to the directory 
<br> <a href=upload.html>Upload Another</a> | <a href=staff-sermons.php>View Sermons</a>";
 } 
 else { 
 
 //Gives and error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 } 
 ?> 


  <!-- InstanceEndEditable -->
<!-- end .content --></div></div>
<div class="footer-wrap">
  <div class="footer">
    <p><a href="login.php?action=logoff">Logout</a></p>
  <!-- end .footer --></div><a href="includes/stylesheet.css"></a>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
