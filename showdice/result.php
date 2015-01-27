

<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.01.15
 * Time: 10:54
 */

$expi=$_GET['id_exp'];

try {
    $pdo=new PDO("mysql:dbname=dice;host=localhost","root","");
} catch (PDOException $error) {
    echo "Возникла ошибка соединения".$error->getMessage();
    exit;
}

echo "<h3>Эксперемент проводился на 36000 бросков</h3>";


$stmt = $pdo->prepare("SELECT `num`,`count` FROM result WHERE id_exp=:id_exp");


$stmt->bindParam(":id_exp", $id_exp);
$id_exp= $expi;
$stmt->execute();

$stmt->bindColumn("num",$num);
$stmt->bindColumn("count",$count);


echo '<table border="1">';
echo '<tr>';
echo '<td bgcolor="#FFCC66"><h4>Выпавшее число</h4</td>';
echo '<td bgcolor="#FFCC66"><h4>Количество выпадений</h4></td>';
echo '<td bgcolor="#FFCC66"><h4>Соотношение</h4></td>';
echo '</tr>';


while ($stmt->fetch(PDO::FETCH_ASSOC)) {

   echo '<tr>';
   echo '<td bgcolor="#CCFF99">'.$num.'</td>';
   echo '<td bgcolor="#CCCCFF">'.$count.'</td>';
   $x=$count/36000;
   echo '<td bgcolor="#996699">'.round($x,2).'</td>';
   echo '</tr>';

}
echo '</table>';

