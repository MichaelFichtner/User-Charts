<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 29.09.15
 * Time: 21:43
 */

//TODO-Michy annpassen noch Prototyp

require_once "../../../maincore.php";
include INFUSIONS."user_charts/infusion_db.php";

$songId = $_POST['songId'];
$points = $_POST['points'];
$datenbank = $_POST['db'];
$_update_vote = 'UPDATE '. $datenbank .' SET chart_vote = chart_vote + '.$points.' WHERE chart_id = '.$songId.';';

$res = $_update_vote;

$was = dbquery($res);

echo $was;
