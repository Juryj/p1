<?php

function mysql_connect ($server = 'ini_get("localhost")', $username = 'ini_get("mysql")', $password = 'ini_get("mysql.default_password")', $new_link = false, $client_flags = 0) {}
function mysql_select_db ($database_name, $link_identifier = null) {}

//Конект к базе
mysql_connect("localhost", "root", "900020jWP#") or die(mysql_error()) ;
mysql_select_db("users") or die(mysql_error()) ; //


$dbcounter = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

    if (empty($_GET['id'])) {
        header('HTTP/1.1 404 Not found');
        die();
    } else {

        $id = mysql_real_escape_string($_GET['id']);
        $result = mysql_query("select url from users where id = '$id'");

        if (!mysql_num_rows($result)) {
            header('HTTP/1.1 404 Not found');
            die();
        }

        $url = mysql_result($result, 0);

        mysql_query("update users set clicks = clicks + 1 where id = '$id'");
        header('Location: http://'.$url);

    }