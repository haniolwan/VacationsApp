<?php
include_once 'database.php';
$id = $_GET['id'];
$sql = "select * from empusers where id ='$id';";

$result = $_DB->query($sql);
// var_dump($result);

$result->fetch_assoc();
