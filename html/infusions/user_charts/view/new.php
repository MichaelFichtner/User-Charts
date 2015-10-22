<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 15.10.15
 * Time: 00:53
 */


$number = 1;
$resultNew = dbquery("SELECT * FROM ".DB_NEUEINTRAG);
$resultRaus = dbquery("SELECT * FROM ".DB_CHARTS." WHERE chart_woche = 8 ");
$rowsRaus = dbrows($resultRaus);
$rowsNew = dbrows($resultNew);

/*echo "<div style='height: 100%; background-color: #e63636'><strong>Debug-Info</strong>";
var_dump($rowsRaus);
var_dump($rowsNew);
var_dump($_POST);
echo "</div>";*/
echo "<div style='height: 100%'>";

echo "<h2 style='text-align: center'>Neue Song einpflegen</h2>";
echo "<p style='text-align: center'>Diese Woche sind <strong>".$rowsRaus."</strong> Einträge nötig</p></br>";


echo "<form action=" . FUSION_SELF.$aidlink . " method='post'><table align='center' width='100%'>";
    while($data = dbarray($resultNew)) {
        echo "<tr>
                <td>".$number."</td>
                <td>".$data['neu_interpret']."</td>
                <td>".$data['neu_song']."</td>
                <td><input type='checkbox' name='delete' value='".$data['neu_id']."'></td>
              </tr>";$number++;
    }
echo "   <tr><td colspan='4'><hr color='red'></td></tr>";
if($rowsNew == $rowsRaus) {
    echo "<tr><td>Fertig ....</td><td>Weiter </td></tr>";
}else{
    echo "   <tr>
            <td colspan='2'><input type=\"text\" name='interpret'></td>
            <td colspan='1'><input type=\"text\" name='song'></td>
            <td><input id='neueintrag' type='submit' name='neueintrag'></td>
        </tr>";
}
echo "</table></form>";
echo $status;
echo "</div>";