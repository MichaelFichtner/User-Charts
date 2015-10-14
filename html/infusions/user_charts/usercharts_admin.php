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
var_dump($_POST);

$uc_interpret = "";
$uc_titel = "";

if (array_key_exists('weg', $_POST)){
	$uc_interpret = $_POST['interpret'];
	$uc_titel = $_POST['titel'];
}
?>

	<div style="float: left; border: dashed 1px black">EINS</div>
	<div>ZWEI</div>

<table><tr><td><?php echo $uc_interpret . " : " . $uc_titel ?></td></tr></table>

<form action="<?php FUSION_SELF.$aidlink ?>" method="post" name="hitliste">
	<input type="text" name="interpret">
	<input type="text" name="titel">
	<input type="submit" name="weg">
</form>

<?php
closetable();

require_once THEMES."templates/footer.php";
?>