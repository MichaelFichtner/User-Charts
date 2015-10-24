<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 15.10.15
 * Time: 00:53
 */

require_once "../../../maincore.php";
include INFUSIONS."user_charts/infusion_db.php";

$resultNew = dbquery("SELECT * FROM ".DB_NEUEINTRAG);
$resultRaus = dbquery("SELECT * FROM ".DB_CHARTS." WHERE chart_woche = 8 ");
$rowsRaus = dbrows($resultRaus);
$rowsNew = dbrows($resultNew);

echo "Wochen auswertung <br>";

if($rowsNew >= $rowsRaus) {
    echo "OK";
}else{
    echo "Bitte erst neue Songs einpflegen ! ";
}
