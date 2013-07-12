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
$json = "''";
if (isset($_GET['ssp']) && $_GET['ssp'] == "edit" && isset($_POST['head-codejson'])) {
    $json_encode = json_encode($_POST['head-codejson']);
    $json = json_decode($json_encode);
}
add_to_head("<link type='text/css' href='".INFUSIONS."socialshareprivacy_panel/stylesheets/sspmain.css' rel='stylesheet' />");
add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min.js'></script>");

if (file_exists(INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js")) {
    add_to_head("<script type='text/javascript' src=' " . INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js'></script>");
}
add_to_head('
<script type="text/javascript">
    var json = ' . $json . ';
        console.log(json);
    var path_prefix_var = \'' . INFUSIONS . 'socialshareprivacy_panel/\';
    var siteurl = \'' . $settings['siteurl'] . '\';
    if(!jQuery().cookies) document.write(\'<script type="text/javascript" src="' . INFUSIONS . 'socialshareprivacy_panel/scripts/jquery.cookies.js"><\/script>\');
</script>    
');
add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy_panel/scripts/sspmain.js'></script>");

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
<textarea name="head-codejson" id="head-codejson" onfocus="var code = this;
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
<input type="submit" value="Speichern">
<div id="share"></div>
</form>

<?php
closetable();
require_once(THEMES . "templates/footer.php");
?>