<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  
  <tr class="headerBar">
    <td class="headerBarContent" align="right"><?php echo (tep_session_is_registered('admin') ? 'Logged in as: ' . $admin['username']  . ' (<a href="' . tep_href_link(FILENAME_LOGIN, 'action=logoff') . '" class="headerLink">Logoff</a>)' : ''); ?>&nbsp;&nbsp;</td>
  </tr>
</table>