<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 16.10.15
 * Time: 23:55
 */


require_once "../../../maincore.php";
include INFUSIONS."user_charts/infusion_db.php";

//echo "<script> if( $('#status').length ){ $('#status').remove(); } </script>";

$number = 1;
echo "<div style='height: 100%; color: black;'>";
echo "<h4 style='text-align: center'> Übersicht </h4>";

$sql2 = "SELECT chart_interpret, chart_song, chart_vote FROM ". DB_CHARTS ." ORDER BY chart_vote DESC ";
$result2 = dbquery($sql2);

echo "<table align='center' class='GeneratedTable'><thead><tr>";
echo "        <th> Interpret </th>";
echo "        <th> Song </th>";
echo "        <th> Derzeitige VOTE Stimmen </th></tr></thead><tbody>";
while ($vote = dbarray($result2)) {
    echo "    <tr align='center'>";
    echo "        <td>" . $vote['chart_interpret'] . "</td>";
    echo "        <td>" . $vote['chart_song'] . "</td>";
    echo "        <td>" . $vote['chart_vote'] . "</td>";
    echo "    </tr>";
}
echo "</tbody></table>";
echo "<a href='' ><button>Refresh</button></a>";
echo "</div>";