<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Manage Accounts');

define('TABLE_HEADING_ADMINISTRATORS', 'Manage Accounts');
define('TABLE_HEADING_HTPASSWD', 'Company Name');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_INSERT_INTRO', 'Please enter the new client and their point of contant');
define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this account?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'New Portal Account');
define('TEXT_INFO_USERNAME', 'Username:');
define('TEXT_INFO_COMPANY', 'Company:');
define('TEXT_INFO_FULLNAME', 'Full Name:');
define('TEXT_INFO_NEW_PASSWORD', 'New Password:');
define('TEXT_INFO_PASSWORD', 'Password:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Protect With htaccess/htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Error: Account already exists.');

define('HTPASSWD_INFO', '<strong>Additional Protection With htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is not additionally secured through htaccess/htpasswd means.</p><p>Enabling the htaccess/htpasswd security layer will automatically store administrator username and passwords in a htpasswd file when updating administrator password records.</p><p><strong>Please note</strong>, if this additional security layer is enabled and you can no longer access the Administration Tool, please make the following changes and consult your hosting provider to enable htaccess/htpasswd protection:</p><p><u><strong>1. Edit this file:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Remove the following lines if they exist:</p><p><i>%s</i></p><p><u><strong>2. Delete this file:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>Additional Protection With htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is additionally secured through htaccess/htpasswd means.</p>');
define('HTPASSWD_PERMISSIONS', '<strong>Additional Protection With htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is not additionally secured through htaccess/htpasswd means.</p><p>The following files need to be writable by the web server to enable the htaccess/htpasswd security layer:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>Reload this page to confirm if the correct file permissions have been set.</p>');
?>
