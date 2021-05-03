<?php

function table_sql($sql){
    $host = "localhost";
    $username = "root";
    $passwd = "123456";
    $dbname = "ClubPlus";
    $mysqlport = "3306";

    $conn = new \mysqli($host, $username, $passwd, $dbname, $mysqlport);
    $conn->query("SET NAMES 'UTF8'");

    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    $conn->close();
            return $result;
}
