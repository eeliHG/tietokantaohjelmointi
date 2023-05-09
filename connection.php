<?php
$ini = parse_ini_file("myconf.ini");

$host = $ini["host"];
$dbname = $ini["db"];
$username = $ini["username"];
$pw = $ini["pw"];

try {
    $dbcon = new PDO("mysql:host=$host;dbname=$dbname", $username, $pw);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
