<?php

$host = "localhost";
$userName = "root";
$passWord = "";
$dbName = "be20_p2";

$connection = mysqli_connect($host, $userName, $passWord, $dbName);

if (!$connection) {
    echo "ERROR";
}