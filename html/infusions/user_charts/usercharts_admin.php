<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright � 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: usercharts_admin.php
| CVS Version: 1.00
| Author: INSERT NAME HERE
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES."templates/admin_header.php";

include INFUSIONS."user_charts/infusion_db.php";

if (!checkrights("UC") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

// Check if locale file is available matching the current site locale setting.
if (file_exists(INFUSIONS."user_charts/locale/".$settings['locale'].".php")) {
	// Load the locale file matching the current site locale setting.
	include INFUSIONS."user_charts/locale/".$settings['locale'].".php";
} else {
	// Load the infusion's default locale file.
	include INFUSIONS."user_charts/locale/English.php";
}

opentable("User Charts - ADMIN");

echo '<link rel="stylesheet" href="' . INFUSIONS . 'user_charts/css/my.css">';
echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';

$uc_interpret = "";
$uc_titel = "";

$view = "start";
$status = '';


if (array_key_exists('cover', $_POST)){
    $view = "cover";
}
if (array_key_exists('new', $_POST)){
    $view = "new";
}
if (array_key_exists('auswertung', $_POST)){
    $view = "auswertung";
}
if (array_key_exists('neueintrag', $_POST)){
    if(empty($_POST['interpret']) && empty($_POST['song'])) {
        $status = "Bitte Felder vollständig aausfüllen";
    }else{
        $sql = "INSERT INTO " . DB_NEUEINTRAG . " (neu_interpret, neu_song) VALUES ('" . $_POST['interpret'] . "' , '" . $_POST['song'] . "')";
        //var_dump($sql);  // SQL Statement überprüfen
        $res = dbquery($sql);
        if ($res) {
            $status = "Datenbank schreiben";
        } else {
            $status = "Fehler beim DB schreiben";
        }
    }
}

//include_once INFUSIONS."user_charts/view/".$view.".php";

?>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            var index = 'activeTab';
            var dataStore = window.sessionStorage;
            try {
                var oldIndex = dataStore.getItem(index);
            } catch(e){
                var oldIndex = 0;
            }
            $('#tabs').tabs({
                active : oldIndex,
                activate : function(event, ui){
                    var newIndex = ui.newTab.parent().children().index(ui.newTab);
                    dataStore.setItem(index, newIndex)
                },
            });
        });
    </script>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Preloaded</a></li>
            <li><a href="#tabs-2">Cover erstellen</a></li>
            <li><a href="#tabs-3">Neue Song einpflegen</a></li>
            <li><a href="#tabs-4">Wochen Auswertung</a></li>
        </ul>

        <?php

        echo "<div id='tabs-1'>";
        include_once INFUSIONS."user_charts/view/start.php";
        echo "</div>";

        echo "<div id='tabs-2'>";
        include_once INFUSIONS."user_charts/view/cover.php";
        echo "</div>";

        echo "<div id='tabs-3'>";
        include_once INFUSIONS."user_charts/view/new.php";
        echo "</div>";

        echo "<div id='tabs-4'>";
        include_once INFUSIONS."user_charts/view/auswertung.php";
        echo "</div>";

        ?>
    </div>
<?php
closetable();
require_once THEMES."templates/footer.php";
?>