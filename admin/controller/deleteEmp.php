<?php

include_once 'database.php';

$id = $_GET['id'];
var_dump($id);

$sql = "delete from `empusers` where id='$id';";
var_dump($sql);
$result = $_DB->query($sql);
var_dump($result);
header("Location:../manageemployee.php");
