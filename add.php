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