/* 
 * main.js from Panzi (http://panzi.github.io/SocialSharePrivacy/)
 * modified and renamed by globeFrEak (https://github.com/globeFrEak)
 */
$.fn.socialSharePrivacy.settings.order = ['facebook', 'twitter', 'gplus', 'mail', 'flattr', 'disqus', 'stumbleupon', 'delicious', 'reddit', 'pinterest', 'tumblr', 'linkedin', 'buffer', 'xing'];
var disqus_shortname = 'socialshareprivacy';
var disqus_url = $.fn.socialSharePrivacy.settings.uri($.fn.socialSharePrivacy.settings);
$(document).ready(function() {
    var services = $.fn.socialSharePrivacy.settings.services;
    var $select = $('#service-select ul');
    for (var service_name in services) {
        var $service = $('<li><label class="checkbox-label"></label></li>');
        var $input = $('<input type="checkbox" checked="checked"/>');


        $input.attr({
            value: service_name,
            id: 'select-' + service_name
        }).change(updateEmbedCode);

        $service.find('label').attr('for', 'select-' + service_name).text(' ' + services[service_name].display_name).prepend($input);

        $select.append($service);
    }
    updateForm();
    updateEmbedCode();
});
var HTML_CHAR_MAP = {"<": "&lt;", ">": "&gt;", "&": "&amp;", "'": "&#39;"};
function escapeSQuotAttr(s) {
    return s.replace(/[<>&']/g, function(ch) {
        return HTML_CHAR_MAP[ch];
    });
}
function updateEmbedCode() {
    var options = {
        layout: $('#layout').val(),
        info_link_target: '_blank'
    };
    var uri = $.trim($('#uri').val());
    var cookies = $('#cookies').is(':checked') ? true : false;
    var flattr = true;
    var disqus = true;
    var flattr_uid = $('#flattr-uid').val();
    var disqus_shortname = $('#disqus-shortname').val();

    if (uri)
        options.uri = uri;

    options.perma_option = cookies;

    var $unchecked = $('#service-select ul input[type=checkbox]:not(:checked)');
    if ($unchecked.length > 0) {
        options.services = {};
        for (var i = 0; i < $unchecked.length; ++i) {
            options.services[$unchecked[i].value] = {status: false};
        }
        if ('flattr' in options.services) {
            flattr = false;
        }
        if ('disqus' in options.services) {
            disqus = false;
        }
    }
    $('#flattr-uid').prop('disabled', !flattr);
    $('#disqus-shortname').prop('disabled', !disqus);

    if (flattr && flattr_uid) {
        if (!options.services)
            options.services = {};
        options.services.flattr = {uid: flattr_uid};
    }
    if (disqus && disqus_shortname) {
        if (!options.services)
            options.services = {};
        options.services.disqus = {shortname: disqus_shortname};
    }
    var head_code = [];
    if (cookies) {
        head_code.push('<script type="text/javascript" src="' + path_prefix_var + 'scripts/jquery.cookies.js"></script>');
    }
    head_code.push('<script type=\"text/javascript\">(\'#share\').socialSharePrivacy({' + escapeSQuotAttr(JSON.stringify(options)) + '});</script>');

    head_code = head_code.join('\n');
    $('#head-code').val(head_code);
    $('#head-code, label[for="head-code"]').show();

    $('#head-codejson').val(escapeSQuotAttr(JSON.stringify(options)));
    $('#head-codejson, label[for="head-codejson"]').show();

    $('#foot-code').val(
            "<script type=\"text/javascript\">(function () {" +
            "var s = document.createElement('script');" +
            "var t = document.getElementsByTagName('script')[0];" +
            "s.type = 'text/javascript';" +
            "s.async = true;" +
            "s.src = '" + path_prefix_var + "scripts/jquery.socialshareprivacy.min.autoload.js';" +
            "t.parentNode.insertBefore(s, t);" +
            "})();" +
            "</script>").show();
    $('label[for="foot-code"]').show();
    $('#share-code').val("<div data-social-share-privacy='true'></div>");
    $("#share").socialSharePrivacy("destroy").css("position", options.layout === "line" ? "static" : "").socialSharePrivacy(options);
}
function updateForm() {
    if (json != '') {
        document.getElementById('layout').value = json.layout;
        if (typeof json.uri != "undefined")
        {
            document.getElementById('uri').value = json.uri;
        }
        if (typeof json.services != "undefined" && typeof json.services.flattr != "undefined" && typeof json.services.flattr.uid != "undefined")
        {
            document.getElementById('flattr-uid').value = json.services.flattr.uid;
        }
        if (typeof json.services != "undefined" && typeof json.servicesdisqus != "undefined" && typeof json.servicesdisqus.shortname != "undefined")
        {
            document.getElementById('disqus-shortname').value = json.services.disqus.shortname;
        }
        if (json.perma_option == true) {
            $('#cookies').attr('checked', 'checked');
        } else {
            $('#cookies').removeAttr('checked');
        }
        if (typeof json.services != "undefined")
        {
            var i = 0;
            $.each(json.services, function(key, val) {
                if (val.status == false)
                    $('#select-' + key).removeAttr('checked');
                i++;
            });
            if (i > 0)
                $('#select-all').removeAttr('checked');
        }
    }
}
