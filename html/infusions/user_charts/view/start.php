<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 16.10.15
 * Time: 23:55
 */


$number = 1;
echo "<div style='height: 100%; color: red;'>";
echo "<p> Bitte Wählen Sie aus was los ist ! </p>";

$sql2 = "SELECT chart_interpret, chart_song, chart_vote FROM ". DB_CHARTS ." ORDER BY chart_vote DESC ";
$result2 = dbquery($sql2);

echo "<table align='center'>";
echo "        <th> Interpret </th>";
echo "        <th> Song </th>";
echo "        <th> Derzeitige VOTE Stimmen </th>";
while ($vote = dbarray($result2)) {
    echo "    <tr align='center'>";
    echo "        <td>" . $vote['chart_interpret'] . "</td>";
    echo "        <td>" . $vote['chart_song'] . "</td>";
    echo "        <td>" . $vote['chart_vote'] . "</td>";
    echo "    </tr>";
}
echo "</table>";

echo "</div>";