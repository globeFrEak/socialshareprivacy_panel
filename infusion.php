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

$inf_folder = "socialshareprivacy_panel";

$inf_newtable[1] = DB_SSP."(
id MEDIUMINT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
info_link_target VARCHAR(8) NOT NULL DEFAULT  '_blank',
layout VARCHAR(4) NOT NULL DEFAULT  'line',
perma_option TINYINT(1) NOT NULL DEFAULT  '1',
PRIMARY KEY (id)
) ENGINE=MyISAM;";

$inf_newtable[2] = DB_SSP_SER."(
id MEDIUMINT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
service_id MEDIUMINT(4),
service_key TEXT ,
service_value TEXT,
PRIMARY KEY (id)
) ENGINE=MyISAM;";

//Tabellen Installation (Default Eintrag)
$inf_insertdbrow[1] = DB_SSP. "(info_link_target, layout, perma_option) VALUES('_blank', 'box', '1')";
$inf_insertdbrow[2] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'buffer', 'status:false')";
$inf_insertdbrow[3] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'delicious', 'status:false')";
$inf_insertdbrow[4] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'disqus', 'status:false')";
$inf_insertdbrow[5] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'flattr', 'status:false')";
$inf_insertdbrow[6] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'hackernews', 'status:false')";
$inf_insertdbrow[7] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'linkedin', 'status:false')";
$inf_insertdbrow[8] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'pinterest', 'status:false')";
$inf_insertdbrow[9] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'stumbleupon', 'status:false')";
$inf_insertdbrow[10] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'tumblr', 'status:false')";
$inf_insertdbrow[11] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'reddit', 'status:false')";
$inf_insertdbrow[12] = DB_SSP_SER. "(service_id, service_key, service_value) VALUES('1', 'xing', 'status:false')";

//Tabellen Änderung (Update)
//$inf_altertable_[1] = "table_name ADD field5 INT 10 NOT NULL";
//$inf_deldbrow_[1] = "other_table WHERE id = 10";

//Tabellen Deinstallation
$inf_droptable[1] = DB_SSP;
$inf_droptable[2] = DB_SSP_SER;

$inf_adminpanel[1] = array(
	"title" => $locale['ssp_link'],
	"image" => BASEDIR.INFUSIONS."socialshareprivacy_panel/images/logo.png",
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