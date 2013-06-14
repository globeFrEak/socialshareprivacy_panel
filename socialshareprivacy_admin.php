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
require_once "../../maincore.php";
require_once THEMES . "templates/admin_header.php";

include INFUSIONS . "socialshareprivacy_panel/infusion_db.php";
//include INFUSIONS . "socialshareprivacy_panel/function.php";

if (!checkrights("SSP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) {
    redirect("../index.php");
}

if (file_exists(INFUSIONS . "socialshareprivacy_panel/locale/" . $settings['locale'] . ".php")) {
    include INFUSIONS . "socialshareprivacy_panel/locale/" . $settings['locale'] . ".php";
} else {
    include INFUSIONS . "socialshareprivacy_panel/locale/English.php";
}

$id = $_POST['id'];
$name = $_POST['name'];
$sort = $_POST['sort'];
$active = $_POST['active'];
$time = time();

if (isset($_GET['team']) && $_GET['team'] == "add") {
    $result = dbquery("SELECT * FROM " . DB_ETF2L . " WHERE id = '" . $_POST['id'] . "'");
    if (dbrows($result) == 1) {
        $result = dbquery("UPDATE " . DB_ETF2L . " SET id='$id', name='$name', sort='$sort', active='$active', time='$time' WHERE id='$id' ");
        SAVEXML(TRUE, $id);
    } else {
        $result = dbquery("INSERT INTO " . DB_ETF2L . " (id, name, sort, active, time) VALUES ('$id', '$name', '$sort', '$active', '$time' )");
        SAVEXML(TRUE, $id);
    }
}
if (isset($_GET['team']) && $_GET['team'] == "del") {
    $result = dbquery("DELETE FROM " . DB_ETF2L . " WHERE id='" . $_POST['id'] . "'");
}

opentable($locale['ssp_admin']);
/* * Server aus DB auslesen* */
echo "<h4>Eingetragene Server:</h4>";
$result = dbquery("SELECT * FROM " . DB_ETF2L . " ORDER BY sort ASC");
if (dbrows($result) != 0) {
    echo "<table class='tbl-border forum_idx_table' cellpadding='0' cellspacing='1'>";
    echo "<tr>";
    echo "<td class='tbl1'><strong>ID</strong></td>";
    echo "<td class='tbl1'><strong>Name</strong></td>";
    echo "<td class='tbl2'><strong>Sortierung</strong></td>";
    echo "<td class='tbl1'><strong>Active</strong></td>";
    echo "<td class='tbl2' colspan='2'><strong>Optionen</strong></td>";
    echo "</tr>";
    while ($data = dbarray($result)) {
        echo "<tr>";
        echo "<td class='tbl1'>" . $data['id'] . "</td>";
        echo "<td class='tbl1'>" . $data['name'] . "</td>";
        echo "<td class='tbl2'>" . $data['sort'] . "</td>";
        if ($data['active'] == 1) {
            echo "<td class='tbl1'>Ja</td>";
        } else {
            echo "<td class='tbl1'>Nein</td>";
        }
        echo "<td class='tbl2'>";
        echo "<form name='addteam' method='post' action='" . FUSION_SELF . $aidlink . "&team=del'>";
        echo "<input type='hidden' name='id' value='" . $data['id'] . "'>";
        echo "<input type='submit' value='l&ouml;schen'>";
        echo "</form>";
        echo "</td>";
        echo "<td class='tbl1'>";
        echo "<form name='addteam' method='post' action='" . FUSION_SELF . $aidlink . "&team=edit'>";
        echo "<input type='hidden' name='id' value='" . $data['id'] . "'>";
        echo "<input type='hidden' name='name' value='" . $data['name'] . "'>";
        echo "<input type='hidden' name='sort' value='" . $data['sort'] . "'>";
        echo "<input type='hidden' name='active' value='" . $data['active'] . "'>";
        echo "<input type='submit' value='editieren'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "keine Server Eingetragen!";
}
echo "<b>" . $error . "<b>";
echo "<hr class='side-hr'/>";
/* * Server hinzufuegen/editieren * */
if (isset($_GET['team']) && $_GET['team'] == "edit") {
    echo "<h4>Server editieren:</h4>\n";
    echo "<table class='tbl-border forum_idx_table' cellpadding='0' cellspacing='1'>\n";
    echo "<tr>\n";
    echo "<td class='tbl1'><strong>Server ID</strong></td>\n";
    echo "<td class='tbl2'><strong>Name</strong></td>\n";
    echo "<td class='tbl1'><strong>Sortierung</strong></td>\n";
    echo "<td class='tbl2'><strong>Active</strong></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td class='tbl1'><form name='addteam' method='post' action='" . FUSION_SELF . $aidlink . "&team=add'>\n";
    echo "<input name='id' type='text' size='6' maxlength='8' value='$id'></td>\n";
    echo "<td class='tbl1'><input name='name' type='text' size='50' maxlength='50' value='$name'></td>\n";
    echo "<td class='tbl2'><input name='sort' type='text' size='3' maxlength='3' value='$sort'></td>\n";
    if (isset($active) && $active == "1") {
        echo "<td class='tbl1'><input type='checkbox' name='active' value='1' checked></td>\n";
    } else {
        echo "<td class='tbl1'><input type='checkbox' name='active' value='1'></td>\n";
    }
    echo "</tr>\n";
    echo "</table>\n";
    echo "<input type='submit' value='Absenden'>\n";
    echo "<input type='reset' value='Abbrechen'>\n";
    echo "</form>\n";
} else {
    echo "<h4>Server zur auswahl:</h4>\n";
    echo "<table class='tbl-border forum_idx_table' cellpadding='0' cellspacing='1'>";
    echo "<tr>";

    echo "<td class='tbl1'><strong>ID</strong></td>";
    echo "<td class='tbl2'><strong>Name</strong></td>";
    echo "<td class='tbl1'><strong>Sortierung</strong></td>";
    echo "<td class='tbl2'><strong>Active</strong></td>";
    echo "<td class='tbl1' colspan='2'><strong>Optionen</strong></td>";
    echo "</tr>";
    echo "<form name='addteam' method='post' action='" . FUSION_SELF . $aidlink . "&team=add'>";
    echo "<tr>";
    echo "<td class='tbl1'>";
    echo "<input name='id' type='text' size='6' maxlength='8' value='" . $data['serverId'] . "'>";
    echo "</td>";
    echo "<td class='tbl2'>";
    echo "<input type='text' name='name' size='60' maxlength='60' value='" . $data['name'] . "'>";
    echo "</td>";
    echo "<td class='tbl1'>";
    echo "<input name='sort' type='text' size='3' maxlength='3' value='10'>";
    echo "</td>";
    echo "<td class='tbl2'>";
    echo "<input type='checkbox' name='active' value='1' checked>";
    echo "</td>";
    echo "<td class='tbl1'>";
    echo "<input type='submit' value='hinzuf&uuml;gen'>";
    echo "</td>";
    echo "</tr>";
    echo "</form>";
    echo "</table>";
}
closetable();

require_once(THEMES . "templates/footer.php");
?>