<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright � 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: usercharts_admin.php
| CVS Version: 1.00
| Author: INSERT NAME HERE
| pw Website : cd12A922112  <---- LÖSCHEN !!!!!!!!!!!!!
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
require_once INFUSIONS."user_charts/lib/SearchCover.php";
require_once INFUSIONS."user_charts/lib/StatusMessage.php";


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
$status = '';

$status = new StatusMessage;


if (array_key_exists('coverMake', $_POST)){
    coverMake();
}
if (array_key_exists('new', $_POST)){
    $view = "new";
}
if (array_key_exists('auswertung', $_POST)){
    $view = "auswertung";
}
if (array_key_exists('neueintrag', $_POST)){
    databaseWrite($_POST, $status);
}
if (array_key_exists('delete', $_POST)){
    $status->addMessages("LOESCHEN.. !!!");
}

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
                beforeLoad: function( event, ui ) {
                    ui.jqXHR.fail(function() {
                        ui.panel.html(
                                "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                "If this wouldn't be a demo." );
                    })
                },
                active : oldIndex,
                activate : function(event, ui){
                    var newIndex = ui.newTab.parent().children().index(ui.newTab);
                    dataStore.setItem(index, newIndex);
                    $('#status').remove();
                }
            });
        });
    </script>
    <div id="tabs">
        <ul>
            <li><a href="view/start.php">Preloaded</a></li>
            <li><a href="view/cover.php">Cover erstellen</a></li>
            <li><a href="view/new.php">Neue Song einpflegen</a></li>
            <li><a href="view/auswertung.php">Wochen Auswertung</a></li>
        </ul>

        <?php
        $isError = $status->hasMesasage();
        if($isError){
            echo "<div id='status'>";
            echo $status->printMessages();
            echo "</div>";
        }
        ?>

    </div>
<?php
closetable();
require_once THEMES."templates/footer.php";

function databaseWrite($data, StatusMessage $status){
    if(empty($data['interpret']) && empty($data['song'])) {
        $status->addMessages("Bitte Felder vollständig aausfüllen");
    }else{
        $sql = "INSERT INTO " . DB_NEUEINTRAG . " (neu_interpret, neu_song) VALUES ('" . $data['interpret'] . "' , '" . $data['song'] . "')";
        //var_dump($sql);  // SQL Statement überprüfen
        $res = dbquery($sql);
        if ($res) {
            $status->addMessages("Datenbank schreiben");
        } else {
            $status->addMessages("Fehler beim DB schreiben");
        }
    }
    return $status;
}

function coverMake()
{
    echo "Cover erstellen jetzt";
    $unseri = unserialize($_POST['daten']);
    foreach ($unseri as $key) {
        var_dump($key['id']);
        var_dump($key['interpret']);
        var_dump($key['song']);
        $coverNew = new SearchCover($key['interpret'], $key['song'], $key['id']);
        $coverNew->getTest();
    }
    var_dump(count($unseri));
}
?>