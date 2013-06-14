<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright C 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: socialbuttons_panel.php
| Author: Philipp H. (globeFrEak)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
//if (!defined("IN_FUSION")) { die("Access Denied"); }
add_to_head("<script type='text/javascript' src='".INFUSIONS."socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min.js'></script>");

add_to_head("<script type=\"text/javascript\">
                $(document).ready(function () {
                    $('#socialshareprivacy').socialSharePrivacy();
                });
                </script>");
echo "<div id='socialshareprivacy' style='position:absolute;margin-top:-22px;margin-left:475px;'></div>";
?>