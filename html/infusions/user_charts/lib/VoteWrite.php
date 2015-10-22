<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 29.09.15
 * Time: 21:43
 */

//TODO-Michy annpassen noch Prototyp


$songId = $_POST['songId'];
$points = $_POST['points'];
$datenbank = $_POST['db'];
$_update_vote = 'UPDATE '. $datenbank .' SET vote = vote + '.$points.' WHERE id = '.$songId.';';

$res = $_update_vote;

var_dump($res);
