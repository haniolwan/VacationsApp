<?php
session_start();
include "databaseconn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql_show = "SELECT * FROM empusers WHERE id='$id'";
    $result_show =  mysqli_query($conn, $sql_show);
    $row = mysqli_fetch_array($result_show);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="Css/profile-style.css">
        <style>
            input[type="text"][disabled] {
                background-color: #FFFFFF;
            }

            .success {
                position: absolute;
                background-color: #D1E7DD;
                color: #0F5132;
                padding: 10px;
                margin-top: 20px;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <h3>UPDATE EMPLOYEE DETAILS</h3>
        <form action="profile.php" method="post">

            <div class="first-column">

                <label>
                    <p>Employee username</p>
                    <input type="text" name="username" Disabled value="<?php echo $row['username']; ?>">
                </label>

                <div class="second-row">
                    <label>
                        <p>First name</p>
                        <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                    </label>
                    <label>
                        <p>Last name</p>
                        <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                    </label>
                </div>

                <label>
                    <p>Email</p>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>">
                </label>

                <label>
                    <p>Mobile number</p>
                    <input type="text" name="mobileno" value="<?php echo $row['mobileno']; ?>">
                </label>

            </div>
            <div class="second-column">

                <select name="gender">
                    <option><?php echo $row['gender']; ?></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

                <select name="section">
                    <option><?php echo $row['section']; ?></option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Operations">Operations</option>
                    <option value="Human Resources">Human Resources</option>
                </select>

                <label>
                    <p>City/Town</p>
                    <input type="text" name="city" value="<?php echo $row['city']; ?>">
                </label>

                <button type="submit" name="update">UPDATE</button>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>

            </div>
            <div class="third-column">
                <label>
                    <p>Date of birth</p>
                    <input type="date" name="dob" value="<?php echo $row['DOB']; ?>">
                </label>

                <label>
                    <p>Country</p>
                    <input type="text" name="country" value="<?php echo $row['country']; ?>">
                </label>
            </div>
        </form>
    </body>

    </html>

<?php

    if (isset($_POST['update'])) {
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM empusers WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            $sql2 = "UPDATE empusers
                SET fname='$_POST[fname]',lname='$_POST[lname]',
                email='$_POST[email]',mobileno='$_POST[mobileno]',
                gender='$_POST[gender]',section='$_POST[section]',
                city='$_POST[city]',country='$_POST[country]',
                DOB='$_POST[dob]'
                WHERE id='$id'";

            mysqli_query($conn, $sql2);
            header("Location: profile.php?success=Your profile successfully updated");
            exit();
        }
    }
} else {
    header("Location: profile.php");
    exit();
}
