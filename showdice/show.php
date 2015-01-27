<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.01.15
 * Time: 9:24
 */
try {
    $pdo=new PDO("mysql:dbname=dice;host=localhost","root","");
} catch (PDOException $error) {
    echo "Возникла ошибка соединения".$error->getMessage();
    exit;
}

$stmt = $pdo->query("SELECT id_exp FROM experiment");

$stmt->bindColumn("id_exp",$id_exp);

echo '<table border="1" >';
echo '<tr>';
echo '<td bgcolor="#FFCC66"><h4>Проведенные эксперементы</h4</td>';

while ($stmt->fetch(PDO::FETCH_ASSOC)) {


    echo '<tr>';
    echo "<td bgcolor='#CCFF99'><a href='result.php?id_exp=".$id_exp."'><font face='Arial'>Эксперемент №: {$id_exp}</font></a></td>";
    echo '</tr>';
}

