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
include INFUSIONS . "socialshareprivacy_panel/infusion_db.php";

add_to_head("<script type='text/javascript' src='" . INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min.js'></script>");
add_to_head('
<script type="text/javascript">
    if(jQuery().cookies) { } // test to see if the jQuery function is defined
    else document.write(\'<script type="text/javascript" src="' . INFUSIONS . 'socialshareprivacy_panel/scripts/jquery.cookies.js"><\/script>\');
</script>    
');

if (file_exists(INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js")) {
    include INFUSIONS . "socialshareprivacy_panel/scripts/jquery.socialshareprivacy.min." . $settings['locale'] . ".js";
}
add_to_head("<script type=\"text/javascript\">
    $.fn.socialSharePrivacy.settings.order = ['facebook', 'gplus', 'twitter', 'tumblr'];
                $(document).ready(function () {
                    $('.socialshareprivacy_line').socialSharePrivacy(
                    {  
                    'path_prefix' : '" . INFUSIONS . "socialshareprivacy_panel/',
                    'css_path':    'scripts/jquery.socialshareprivacy.min.css',
                    'perma_option': true,
                    'info_link_target': '_blank',
                    'layout' : 'line',
                    services : {
                        buffer:{status:false}, 
                        delicious:{status:false},
                        disqus:{status:false},
                        flattr:{status:false} ,
                        hackernews:{status:false}, 
                        linkedin:{status:false}, 
                        pinterest:{status:false}, 
                        reddit:{status:false}, 
                        stumbleupon:{status:false},
                        tumblr:{status:false}, 
                        xing:{status:false}}                     
                    }                    
                    );
                });
                </script>");

echo "<div class='socialshareprivacy_line'></div>";
?>
