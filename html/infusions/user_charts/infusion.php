<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright � 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion.php
| CVS Version: 1.00
| Author: Michael A. Fichtner
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

include INFUSIONS."user_charts/infusion_db.php";

// Check if locale file is available matching the current site locale setting.
if (file_exists(INFUSIONS."user_charts/locale/".$settings['locale'].".php")) {
	// Load the locale file matching the current site locale setting.
	include INFUSIONS."user_charts/locale/".$settings['locale'].".php";

} else {
	// Load the infusion's default locale file.
	include INFUSIONS."user_charts/locale/English.php";
}

// Infusion general information
$inf_title = $locale['charts_title'];
$inf_description = $locale['charts_desc'];
$inf_version = "1.0";
$inf_developer = "Michael A. Fichtner";
$inf_email = "";
$inf_weburl = "http://";
$inf_folder = "user_charts"; // The folder in which the infusion resides.

// Delete any items not required below.

$inf_newtable[1] = DB_CHARTS."(
    chart_id INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
    chart_platz INT(100) NOT NULL,
    chart_interpret VARCHAR(100) NOT NULL,
    chart_song VARCHAR(100) NOT NULL,
    chart_punkte INT(100) NOT NULL,
    chart_vorwoche INT(100) NOT NULL,
    chart_trend INT(5) NOT NULL,
    chart_woche INT(50) NOT NULL,
    chart_cover VARCHAR(255) NOT NULL,
    chart_vote INT(50) NOT NULL,
    PRIMARY KEY (chart_id)
) ENGINE=MyISAM";

$inf_newtable[2] = DB_NEUEINTRAG."(
    neu_id INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
    neu_interpret VARCHAR(100) NOT NULL,
    neu_song VARCHAR(100) NOT NULL,
    PRIMARY KEY (neu_id)
) ENGINE=MyISAM";

$inf_newtable[3] = DB_TIMECHECK."(
    id INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
    userid INT(100) NOT NULL,
    songid INT(100) NOT NULL,
    votetime INT(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=MyISAM";

$inf_adminpanel[1] = array(
	"title" => $locale['charts_admin1'],
	"image" => "image.gif",
	"panel" => "usercharts_admin.php",
	"rights" => "UC"
);

$inf_sitelink[1] = array(
	"title" => $locale['charts_link1'],
	"url" => "user_charts.php",
	"visibility" => "102" // 0 - Guest / 101 - Member / 102 - Admin / 103 - Super Admin.
);


// Cleanup

$inf_droptable[1] = DB_CHARTS;
$inf_droptable[2] = DB_NEUEINTRAG;
$inf_droptable[3] = DB_TIMECHECK;
$inf_deldbrow[1] = DB_ADMIN." WHERE admin_rights='UC'";

?>