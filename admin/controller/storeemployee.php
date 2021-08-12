<?php
include_once 'database.php';
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$method = test_input($_POST['method']);
$id = test_input($_POST['id']);
$username = test_input($_POST['username']);
$fname = test_input($_POST['fname']);
$lname = test_input($_POST['lname']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);
$confirm = test_input($_POST['passwordconfirm']);
$gender = test_input($_POST['gender']);
$birthday = test_input($_POST['birthday']);
$section = test_input($_POST['section']);
$country = test_input($_POST['country']);
$city = test_input($_POST['city']);
$address = test_input($_POST['address']);
$mobile = test_input($_POST['mobile']);

var_dump($method);

var_dump($id);
if ($password !== $confirm) {
    header("Location:../addemployee.php?Error=password doesn't match");
} else {
    if ($method == 'update') {
        $sql = "select * from empusers where id='$id';";
        $result = $_DB->query($sql);
        // var_dump($result);
        if ($result->num_rows > 0) {
            $sql = "UPDATE `empusers` SET `username` = '$username',`password`='$password', `fname`='$fname' , `lname`='$lname',
            `gender`='$gender',`DOB`='$birthday',`email`='$email',`mobileno`='$mobile', `section` = '$section' ,`city` ='$city',`country` = '$country'   WHERE `id`='$id';";
            // var_dump($sql);
            $result = $_DB->query($sql);
            header("Location:../manageemployee.php");
        }
    } else {
        $sql = "select * from empusers where username='$username'";
        $result = $_DB->query($sql);
        if ($result->num_rows > 0) {
            header("Location:../addemployee.php?Error=user already exists");
        } else {
            $sql = "INSERT INTO
        `empusers`(`username`, `password`, `fname`, `lname`, `gender`, `DOB`, `email`, `mobileno`, `section`, `city`, `country`,`reg_date`)
         VALUES ('$username','$password','$fname','$lname','$gender','$birthday','$email','$mobile','$section','$city','$country',NOW());";
            $result = $_DB->query($sql);
            var_dump($result);
            header("Location:../manageemployee.php");
        }
    }
}
