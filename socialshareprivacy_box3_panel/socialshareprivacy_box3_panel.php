<?php

/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) 2002 - 2012 Nick Jones
  | http://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Mod: socialshareprivacy_panels
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

include INFUSIONS . "socialshareprivacy/infusion_db.php";

add_to_head("<link rel='stylesheet' href='".INFUSIONS."socialshareprivacy_box3_panel/style.css' type='text/css'/>\n");
add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min.js'></script>");
add_to_head('
<script type="text/javascript">
    if(jQuery().cookies) { } // test to see if the jQuery function is defined
    else document.write(\'<script type="text/javascript" src="' . INFUSIONS . 'socialshareprivacy/scripts/jquery.cookies.js"><\/script>\');
</script>    
');
if (file_exists(INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js")) {
    add_to_head("<script type='text/javascript' src=' " . INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js'></script>");
}

$result = dbquery("SELECT json_options FROM " . DB_SSP . " WHERE box_id='ssp_box3'");
$data = dbarray($result);

$json = unserialize(base64_decode($data['json_options']));
$json = substr($json, 1);
$json = "{\"path_prefix\":\"" . INFUSIONS . "socialshareprivacy/\",\"css_path\":\"stylesheets/jquery.socialshareprivacy.min.css\"," . $json;

add_to_head("<script type=\"text/javascript\">
        $.fn.socialSharePrivacy.settings.order = ['facebook', 'twitter', 'gplus', 'mail', 'flattr', 'disqus', 'stumbleupon', 'delicious', 'reddit', 'pinterest', 'tumblr', 'linkedin', 'buffer', 'xing'];    
        $(document).ready(function () {        
            $('#ssp_box3').socialSharePrivacy(" . $json . ");            
        });</script>");

echo "<div data-social-share-privacy='true' id='ssp_box3'></div>";
?>
