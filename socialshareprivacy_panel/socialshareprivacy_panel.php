<?php

/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) 2002 - 2012 Nick Jones
  | http://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Mod: socialshareprivacy Panel
  | Version: 1.00
  | Author: Philipp Horna (globeFrEak)
  +--------------------------------------------------------+
  | This program is released as free software under the
  | Affero GPL license. You can redistribute it and/or
  | modify it under the terms of this license which you
  | can read by viewing the included agpl.txt or online
  | at www.gnu.org/licenses/agpl.html. Removal of this
  | copyright header is strictly prohibited without
  | written permission from the original author(s).
  +-------------------------------------------------------- */
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

include INFUSIONS . "socialshareprivacy_panel/infusion_db.php";

add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min.js'></script>");
add_to_head('
<script type="text/javascript">
    if(jQuery().cookies) { } // test to see if the jQuery function is defined
    else document.write(\'<script type="text/javascript" src="' . INFUSIONS . 'socialshareprivacy_panel/scripts/jquery.cookies.js"><\/script>\');
</script>    
');
if (file_exists(INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js")) {
    add_to_head("<script type='text/javascript' src=' " . INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js'></script>");
}

$result = dbquery("SELECT * FROM " . DB_SSP . " WHERE id='1'");
$data = dbarray($result);

$result_service = dbquery("SELECT * FROM " . DB_SSP_SER . " WHERE service_id='" . $data['id'] . "'");
$services = array();
if (dbrows($result_service)) {
    while ($serdata = dbarray($result_service)) {
        $services[$serdata['service_key']] = $serdata['service_value'];
    }
}
function keystore($array) {
    foreach ($array as $key => $value) {
        $echo .= "$key:{".$value."},";
    }
    return $echo;
}

add_to_head("<script type=\"text/javascript\">
    $.fn.socialSharePrivacy.settings.order = ['facebook', 'gplus', 'twitter', 'tumblr'];
                $(document).ready(function () {
                    $('.socialshareprivacy').socialSharePrivacy(
                    {  
                    'path_prefix' : '" . INFUSIONS . "socialshareprivacy_panel/',
                    'css_path':    'scripts/jquery.socialshareprivacy.min.css',                    
                    'perma_option': " . $data['perma_option'] . ",
                    'info_link_target': '" . $data['info_link_target'] . "',
                    'layout' : '" . $data['layout'] . "',
                    services : {
                    " . keystore($services) . "                         
                        }                     
                    }                    
                    );
                });
                </script>");

openside("Social Test", NULL, "on");
echo "<div class='socialshareprivacy'></div>";
closeside();
?>
