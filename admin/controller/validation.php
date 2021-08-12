<?php
include_once 'database.php';
session_start();
// i use only sessions 

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



$username = test_input($_POST['username']);
$password = test_input($_POST['password']);

if (isset($_POST['login'])) {
    $sql = "SELECT `password`,`username` FROM `users` WHERE `username`= '$username' and `password`='$password';";
    $result = $_DB->query($sql);

    if ($result->num_rows > 0) {
        //There's resul
        while ($row = $result->fetch_assoc()) {
            if ($password == $row["password"]) {
                $_SESSION["username"] = $row['username'];
                $_SESSION["password"] = $row['password'];

                header("Location:../dashboard.php");
            }
        }
    } else {
        // no matching username
        header("Location:../index.php?Error=Error make sure to fill input fields");
    }
}
