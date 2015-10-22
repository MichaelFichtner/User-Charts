<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 15.10.15
 * Time: 00:53
 */
include INFUSIONS."user_charts/infusion_db.php";


echo "Cover erstellen";

$sql = "SELECT chart_interpret, chart_song, chart_cover FROM ". DB_CHARTS ." ";

$result = dbquery($sql);
while ($data = dbarray($result)){
    echo "<p>" . var_dump($data) . "</p>";
}

