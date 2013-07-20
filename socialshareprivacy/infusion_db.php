<?php
/* -------------------------------------------------------+
  | PHP-Fusion Content Management System
  | Copyright (C) 2002 - 2012 Nick Jones
  | http://www.php-fusion.co.uk/
  +--------------------------------------------------------+
  | Mod: socialshareprivacy Panel
  | File: infusion_db.php
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

if (!defined("DB_SSP")) {
	define("DB_SSP", DB_PREFIX."ssp_main");
}
?>