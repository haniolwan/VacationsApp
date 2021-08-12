<?php
//Connect to database...

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "vacations";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection Failed" . mysqli_connect_error();
}
