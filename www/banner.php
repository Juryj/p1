<?php

class db {
    function getConnection()
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=db_counter","root","900020jWP#");
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
        $db->exec("set names utf8");
        return $db;
    }
}

$db = db::getConnection();
$url = $_SERVER['REQUEST_URI'];

/* проверяем есть ли уже такой url в базе  */
$result = $db->prepare("SELECT * FROM counter WHERE url='$url'");
$result->execute();

if($result->rowCount() > 0){
    while($res = $result->fetch(PDO::FETCH_BOTH)){
        $row['id'] = $res['id'];
    }
    $result = $db->prepare("UPDATE counter set counter = counter + 1 WHERE id=" . $row['id']);
    $result->execute();

} else {
    $result = $db->prepare("INSERT INTO counter (url, counter) VALUES ('$url', 1)");
    $result->execute();
}