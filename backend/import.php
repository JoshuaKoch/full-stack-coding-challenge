<?php
$_db_user = "root";
$_db_host = "127.0.0.1";
$_db_name = "pizza";
$_db_pass = "ChangeMe";
$_db_port = 3336;

$db = new PDO('mysql:dbname=' . $_db_name . ';host=' . $_db_host . ';port=' . $_db_port . ';charset=utf8', $_db_user, $_db_pass);

$sql = file_get_contents('data.sql');

$qr = $db->exec($sql);
