<?php 
$valid_ips = array(
'192.168.123.*',
'192.168.123.48',
'192.168.123.36'
);
if (!in_array($_SERVER['REMOTE_ADDR'],$valid_ips)) {
    echo "Your IP Address is not allowed to administer this site.";
    exit();
}  
?>