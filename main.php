<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.01.15
 * Time: 16:04
 */


try {
    $pdo=new PDO("mysql:dbname=dice;host=localhost","root","");
} catch (PDOException $error) {
    echo "Возникла ошибка соединения".$error->getMessage();
    exit;
}

    $stmt = $pdo->prepare("INSERT INTO experiment (`date`,`time`,`name`,`bones_num`,`throws`) VALUES (:date, :time,:name,:bones_num, :throws)");

    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':bones_num', $bones_num);
    $stmt->bindParam(':throws', $throws);
    $date= date("m.d.y");
    $time = date("H:i:s");
    $name = "tester1";
    $bones_num=2;
    $throws=36000;
    $stmt->execute();

$Id=$pdo->lastInsertId();


$res = array(2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);


for ($i=0; $i<36000; $i++) {
    $dise_f[$i] = rand(1, 6);
    $dise_s[$i] = rand(1, 6);
    $sum = $dise_f[$i] + $dise_s[$i];
    $res[$sum]++;
}

foreach($res as $key => $value) {
    $stmt = $pdo->prepare("INSERT INTO result (num,count,id_exp) VALUES (:num, :count,:id_exp)");

        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':count', $count);
        $stmt->bindParam(':id_exp', $id_exp);

    $num=(int)$key ;
    $count =(int)$value ;
    $id_exp = $Id;
$stmt->execute();

}
echo '<table border="1">';
echo '<tr>';
echo '<td bgcolor="#FFCC66"><h4>Выпавшее число</h4</td>';
echo '<td bgcolor="#FFCC66"><h4>Количество выпадений</h4></td>';
echo '<td bgcolor="#FFCC66"><h4>Соотношение</h4></td>';
echo '</tr>';

foreach($res as $key => $value) {
    echo '<tr>';
    echo '<td bgcolor="#CCFF99">'.$key.'</td>';
    echo '<td bgcolor="#CCCCFF">'.$value.'</td>';
    $x=$value/36000;
    echo '<td bgcolor="#996699">'.round($x,2).'</td>';
echo '</tr>';
}
echo '</table>';
