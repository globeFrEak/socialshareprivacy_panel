<?php
/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) 2002 - 2012 Nick Jones
  | http://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Mod: socialshareprivacy Panel
  | File: infusion.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }

include INFUSIONS."socialshareprivacy_panel/infusion_db.php";

if (file_exists(INFUSIONS."socialshareprivacy_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."socialshareprivacy_panel/locale/".$settings['locale'].".php";
} else {	
	include INFUSIONS."socialshareprivacy_panel/locale/English.php";
}

// Infusion general information
$inf_title = $locale['ssp_title'];
$inf_description = $locale['ssp_desc'];
$inf_version = "1.0";
$inf_developer = "globeFrEak";
$inf_email = "globefreak@cwclan.de";
$inf_weburl = "http://www.cwclan.de";

$inf_folder = "socialshareprivacy_panel"; // The folder in which the infusion resides.

// Delete any items not required below.
//$inf_newtable[1] = DB_SOCIALSP."(
//id int(8) UNSIGNED NOT NULL,
//name VARCHAR(60) DEFAULT '' ,
//sort smallint(3) DEFAULT '0' NOT NULL ,
//active smallint(1) UNSIGNED DEFAULT '1' NOT NULL ,
//time int(10) UNSIGNED,
//PRIMARY KEY (id)
//)";

// Tabellen Deinstallation
//$inf_droptable[1] = DB_ETF2L;

$inf_adminpanel[1] = array(
	"title" => $locale['ssp_admin1'],
	"image" => "images/2-klick-logo.jpg",
	"panel" => "socialshareprivacy_admin.php",
	"rights" => "SSP"
);

/**
$inf_sitelink[1] = array(
	"title" => $locale['etf2l_link1'],
	"url" => "etf2l_panel.php",
	"visibility" => "0"
);
**/
?>