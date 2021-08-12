<?php
session_start();
include "databaseconn.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data); //trim white spaces...
            $data = stripslashes($data); //remove backslashes...
            $data = htmlspecialchars($data); //print spical chars...
            return $data;     
        }
        // Get the values from inputs and sotre them in vars...
        $uname = validate($_POST['username']);
        $password = validate($_POST['password']);
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $mobileno = $_POST['mobileno'];
        $gender = $_POST['gender'];
        $section = $_POST['section'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        //Set Cookies by check this input...
        if(isset($_POST['remember-pass'])){
            setcookie("username" ,$uname ,time()+2*24*60*60, "/");
            setcookie("password" ,$password ,time()+2*24*60*60, "/");
        }
        //Check if fields are filled or not...
        if (empty($uname)) {
            header("Location: index.php?error=Username is required");
            exit();
        }else if (empty($password)){
            header("Location: index.php?error=Password is required");
            exit();
        //Check if username and username are valid...
        }else {
            $sql = "SELECT * FROM empusers WHERE username = '$uname' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){ //Return number of rows of this query...
                $row = mysqli_fetch_assoc($result);//Returns an associative array of strings representing the fetched row...

                if ($row['username'] === $uname && $row['password'] === $password){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['fname'] = $row['fname'];

                    header("Location: home.php");
                    exit();
                    }else{
                        header("Location: index.php?error= Incorrect username or password");
                        exit();
                    }
            }else {
                    header("Location: index.php?error= Incorrect username or password");
                    exit();
                }
            }
    }else {
        header("Location: index.php");
        exit();
    }
