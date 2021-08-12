<?php
global $_SESSION;
if (!$_SESSION['username'])
    session_start();

ini_set('display_errors', 1);
error_reporting(1);

$host = "localhost";
$username = "root";
$password = "";
$database = "vacations";

$_DB = new mysqli($host, $username, $password, $database);

$sql = "SELECT id, username, password FROM users";
$result = $_DB->query($sql);

// global $_DB;
$somevar = $_GET["uid"];
// print_r(leaveHistory("select '$somevar' from `leave`;"));
echo '<table>';
foreach ($leaves as $leave) {
    echo '<tr>';
    echo '<td>' . $leave['id'] . '</td>';
    echo '<td>' . $leave['type_of_leave'] . '</td>';
    echo '</tr>';
}
echo '</table>';




function leaveHistory($somevar = 10)
{
    global $_DB;
    $sql = "SELECT * from `empusers`
    LIMIT $somevar;";
    // var_dump($sql);
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
    }
    return $leaves;
}

function leave()
{
    global $_DB;
    $sql = "SELECT a.id, a.type, a.postDate, a.status, b.username ,b.fname FROM `leaves` a 
    LEFT JOIN `empusers` b ON a.emp_id = b.id
    LIMIT 5;";
    // var_dump($sql);
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
    }
    return $leaves;
}

function approvedLeaves()
{
    global $_DB;
    $sql = "SELECT a.id, a.type, a.postDate, a.status, b.username ,b.fname FROM `leaves` a 
    LEFT JOIN `empusers` b ON a.emp_id = b.id
    where `status` ='Approved';";
    // var_dump($sql);
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
    }
    return $leaves;
}
function notApprovedLeaves()
{
    global $_DB;
    $sql = "SELECT a.id, a.type, a.postDate, a.status, b.username ,b.fname FROM `leaves` a 
    LEFT JOIN `empusers` b ON a.emp_id = b.id
    where `status` ='Not Approved';";
    // var_dump($sql);
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
    }
    return $leaves;
}
function pendingLeaves()
{
    global $_DB;
    $sql = "SELECT a.id, a.type, a.postDate, a.status, b.username ,b.fname FROM `leaves` a 
    LEFT JOIN `empusers` b ON a.emp_id = b.id
    where `status` ='Waiting for approval';";
    // var_dump($sql);
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
    }
    return $leaves;
}
function getUser($id)
{
    global $_DB;
    $sql = "SELECT * FROM `leaves` a 
    LEFT JOIN `empusers` b ON a.emp_id = b.id where a.id='$id';";
    $result = $_DB->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    return null;
}



function countLeavs()
{
    global $_DB;
    $sql = "select count(id) as `count` from `leaves`";
    $result = $_DB->query($sql);
    $leaves = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['count'];
        }
    }
    return 0;
}
// leaveHistory("select * from `leave`");

// changePassword('admin');



if (isset($_POST['change'])) {
    global $_DB;
    $username = $_SESSION['username'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($newPassword !== $confirmPassword) {
        header("Location:changepassword.php?Error=password doesn't match");
    } else {
        $sql = "UPDATE users SET `password` = '$newPassword' WHERE username='$username';";
        $result = $_DB->query($sql);
        // var_dump($username);
        $_SESSION['password'] = $newPassword;
        header("Location:changepassword.php");
    }
}



if (isset($_POST['submit-status'])) {
    $status = $_POST['status'];
    $description = $_POST['description'];
    $id = $_GET['id'];
    $sql = "UPDATE leaves
SET `status` = '$status',`description` ='$description'
WHERE id='$id';";
    $result = $_DB->query($sql);
    header("Location:../viewdetails.php?id=$id");
}
