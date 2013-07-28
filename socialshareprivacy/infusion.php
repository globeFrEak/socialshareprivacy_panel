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

if (file_exists(INFUSIONS . "socialshareprivacy/locale/" . $settings['locale'] . ".php")) {
    include INFUSIONS . "socialshareprivacy/locale/" . $settings['locale'] . ".php";
} else {
    include INFUSIONS . "socialshareprivacy/locale/English.php";
}

// Infusion general information
$inf_title = $locale['ssp_title'];
$inf_description = $locale['ssp_desc'];
$inf_version = "1.0";
$inf_developer = "globeFrEak";
$inf_email = "globefreak@cwclan.de";
$inf_weburl = "http://www.cwclan.de";

$inf_folder = "socialshareprivacy";

$inf_newtable[1] = DB_SSP . "(
id MEDIUMINT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
box_id VARCHAR(25) NOT NULL DEFAULT  'socialshareprivacy',
name VARCHAR(25),
json_options TEXT,
PRIMARY KEY (id)
) ENGINE=MyISAM;";

//Tabellen Installation (Default Eintrag)
$inf_insertdbrow[1] = DB_SSP . '(box_id, name, json_options) VALUES("ssp_box1", "social box 1", "czo2NDoieyJsYXlvdXQiOiJib3giLCJpbmZvX2xpbmtfdGFyZ2V0IjoiX2JsYW5rIiwicGVybWFfb3B0aW9uIjp0cnVlfSI7")';
$inf_insertdbrow[2] = DB_SSP . '(box_id, name, json_options) VALUES("ssp_box2", "social box 2", "czo2NDoieyJsYXlvdXQiOiJib3giLCJpbmZvX2xpbmtfdGFyZ2V0IjoiX2JsYW5rIiwicGVybWFfb3B0aW9uIjp0cnVlfSI7")';
$inf_insertdbrow[3] = DB_SSP . '(box_id, name, json_options) VALUES("ssp_box3", "social box 3", "czo2NToieyJsYXlvdXQiOiJsaW5lIiwiaW5mb19saW5rX3RhcmdldCI6Il9ibGFuayIsInBlcm1hX29wdGlvbiI6dHJ1ZX0iOw==")';
$inf_insertdbrow[4] = DB_SSP . '(box_id, name, json_options) VALUES("ssp_box4", "social box 4", "czo2NToieyJsYXlvdXQiOiJsaW5lIiwiaW5mb19saW5rX3RhcmdldCI6Il9ibGFuayIsInBlcm1hX29wdGlvbiI6dHJ1ZX0iOw==")';

//Tabellen Änderung (Update)
//$inf_altertable_[1] = "table_name ADD field5 INT 10 NOT NULL";
//$inf_deldbrow_[1] = "other_table WHERE id = 10";
//
//Tabellen Deinstallation
$inf_droptable[1] = DB_SSP;

$inf_adminpanel[1] = array(
    "title" => $locale['ssp_link'],
    "image" => BASEDIR . INFUSIONS . "socialshareprivacy/images/logo.png",
    "panel" => "socialshareprivacy_admin.php",
    "rights" => "SSP"
);

/**
  $inf_sitelink[1] = array(
  "title" => $locale['etf2l_link1'],
  "url" => "etf2l_panel.php",
  "visibility" => "0"
  );
 * */
?>