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

include INFUSIONS . "socialshareprivacy/infusion_db.php";

if (!checkrights("SSP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) {
    redirect("../index.php");
}

function ValidJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

if (file_exists(INFUSIONS . "socialshareprivacy/locale/" . $settings['locale'] . ".php")) {
    include INFUSIONS . "socialshareprivacy/locale/" . $settings['locale'] . ".php";
} else {
    include INFUSIONS . "socialshareprivacy/locale/English.php";
}
//// Select SSP Button by ID
if (isset($_GET['ssp']) && $_GET['ssp'] == "sel" && isset($_POST['ssp_box']) && is_numeric($_POST['ssp_box'])) {
    $id_sel = $_POST['ssp_box'];
    $result_config = dbquery("SELECT * FROM " . DB_SSP . " WHERE id ='" . $_POST['ssp_box'] . "'");
    if (dbrows($result_config) != 0) {
        $data = dbarray($result_config);
        $id = $data['id'];
        $box_id = $data['box_id'];
        $json_options = '"' . $data['json_options'] . '"';
    }
    $json = unserialize(base64_decode($json_options));
} elseif (isset($_GET['ssp']) && $_GET['ssp'] == "edit" && isset($_POST['head-codejson']) && isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['box_id'])) {
    $id_sel = $_POST['id'];
    //Config Form
    ValidJson($_POST['head-codejson']);
    $json_decode = base64_encode(serialize($_POST['head-codejson']));
    $id = $_POST['id'];
    $box_id = $_POST['box_id'];
    $result = dbquery("UPDATE " . DB_SSP . " SET id='$id', json_options='$json_decode' WHERE id='$id' ");
    $json = unserialize(base64_decode($json_decode));
} else {
    $result_config = dbquery("SELECT * FROM " . DB_SSP . " ORDER BY id ASC LIMIT 1");
    $id_sel = "";
    if (dbrows($result_config) != 0) {
        $data = dbarray($result_config);
        $id = $id_sel = $data['id'];
        $box_id = $data['box_id'];
        $json_options = '"' . $data['json_options'] . '"';
    }
    $json = unserialize(base64_decode($json_options));
}

opentable($locale['ssp_a_001']);
$result = dbquery("SELECT id, box_id FROM " . DB_SSP . " ");
if (dbrows($result) != 0) {
    echo "<form action='" . FUSION_SELF . $aidlink . "&ssp=sel' method='post' name='ssp_sel'>";
    echo "<select name='ssp_box' onchange=\"javascript:this.form.submit()\">";
    while ($data = dbarray($result)) {
        if ($data['id'] == $id_sel) {
            echo "<option value='" . $data['id'] . "' selected>" . $data['box_id'] . "</option>";
        } else {
            echo "<option value='" . $data['id'] . "'>" . $data['box_id'] . "</option>";
        }
    }
    echo "</select>";
    echo "</form>";
}
closetable();

add_to_head("<link type='text/css' href='" . INFUSIONS . "socialshareprivacy/stylesheets/sspmain.css' rel='stylesheet' />");
add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min.js'></script>");

if (file_exists(INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js")) {
    add_to_head("<script type='text/javascript' src=' " . INFUSIONS . "socialshareprivacy/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js'></script>");
}
add_to_head('
<script type="text/javascript">
    var json = ' . $json . ';
        console.log(json);
    var path_prefix_var = \'' . INFUSIONS . 'socialshareprivacy_panel/\';
    var siteurl = \'' . $settings['siteurl'] . '\';
    if(!jQuery().cookies) document.write(\'<script type="text/javascript" src="' . INFUSIONS . 'socialshareprivacy/scripts/jquery.cookies.js"><\/script>\');
</script>    
');
add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy/scripts/sspmain.js'></script>");

opentable($locale['ssp_admin']);
echo "<form action='" . FUSION_SELF . $aidlink . "&ssp=edit' method='post' name='ssp_edit'>";
?>
<div id="service-edit">
    <div id="service-select">
        <label for="select-all">
            <input type="checkbox" id="select-all" value="all" checked="checked" onchange="$('#service-select ul input[type=checkbox]').prop('checked', this.checked);
                    updateEmbedCode();">
            All</label>
        <ul>
        </ul>
    </div>
    <table id="options-and-code">
        <tbody>
            <tr>
                <td class="label"><label for="layout">Layout:</label></td>
                <td>
                    <select id="layout" onchange="updateEmbedCode();">
                        <option value="line">Horizontal (Line)</option>
                        <option value="box" selected="selected">Vertical (Box)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="uri">URL (optional):</label>
                </td>
                <td>
                    <input id="uri" type="url" onchange="updateEmbedCode();">
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <input type="checkbox" id="cookies" onchange="updateEmbedCode();" checked="checked">
                    <label for="cookies" class="checkbox-label">Use cookies</label>
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="flattr-uid">Flattr UID:</label>
                </td>
                <td>
                    <input id="flattr-uid" type="text" onchange="updateEmbedCode();">
                </td>
            </tr>
            <tr>
                <td class="label">
                    <label for="disqus-shortname">Disqus shortname:</label>
                </td>
                <td>
                    <input id="disqus-shortname" type="text" onchange="updateEmbedCode();">
                </td>
            </tr>
            </tr>
        </tbody>
    </table>
</div>
<label for="head-code" style="">Insert this once in the head of your page:</label>
<textarea id="head-code" onfocus="var code = this;
                    setTimeout(function() {
                        code.select();
                    }, 0);" readonly="readonly"></textarea>

<label for="head-codejson" style="">Insert this once in the head of your page:</label>
<textarea name="head-codejson" style="visibility: hidden;display: none;position: absolute;" id="head-codejson" onfocus="var code = this;
                    setTimeout(function() {
                        code.select();
                    }, 0);" readonly="readonly"></textarea>

<label for="share-code">Insert this wherever you want a share widget displayed (can be multiple times):</label>
<textarea id="share-code" onfocus="var code = this;
                    setTimeout(function() {
                        code.select();
                    }, 0);" readonly="readonly"></textarea>

<label for="foot-code" style="">Insert this once anywhere after the other code (e.g. the bottom of the page):</label>
<textarea id="foot-code" onfocus="var code = this;
                    setTimeout(function() {
                        code.select();
                    }, 0);" readonly="readonly"></textarea>
          <?php
          echo "<input type='hidden' name='id' value='" . $id . "'>";
          echo "<input type='hidden' name='box_id' value='" . $box_id . "'>";
          ?>
<input type="submit" value="Speichern">
</form>
<div id="share"></div>

<?php
closetable();
require_once(THEMES . "templates/footer.php");
?>