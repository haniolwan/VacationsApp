<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="Css/password-style.css" <?php echo time(); ?>>

    <style>
        .error {
            background-color: #F2DEDE;
            color: #A94442;
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 5px;
        }

        .success {
            background-color: #D1E7DD;
            color: #0F5132;
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h3>CHANGE PASSWORD</h3>

    <form action="change-password.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
        <label>
            <p>Enter old password</p>
            <input type="password" name="old-password">
        </label>

        <label>
            <p>Enter new password</p>
            <input type="password" name="new-password">
        </label>

        <label>
            <p>Enter confirm password</p>
            <input type="password" name="confirm-password">
        </label>

        <button type="submit">CHANGE</button>
    </form>

    <?php
    session_start();
    include "databaseconn.php";

    if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
        if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])) {

            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $oldPassword = validate($_POST['old-password']);
            $newPassword = validate($_POST['new-password']);
            $confirmPassword = validate($_POST['confirm-password']);
            //Check if any field is empty or not...
            if (empty($oldPassword)) {
                header("Location: change-password.php?error=Old password is required");
                exit();
            } else if (empty($newPassword)) {
                header("Location: change-password.php?error=New password is required");
                exit();
            } else if ($newPassword !== $confirmPassword) {
                header("Location: change-password.php?error=The confirmation does not match!");
                exit();
            } else {
                $id = $_SESSION['id'];
                //Select the old password then update it with a new one...
                $sql = "SELECT password
                    FROM empusers WHERE
                    id='$id' AND password='$oldPassword'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) === 1) {

                    $sql2 = "UPDATE empusers
                        SET password='$newPassword'
                        WHERE id='$id'";

                    mysqli_query($conn, $sql2);
                    header("Location: change-password.php?success=Your password successfully changed");
                    exit();
                } else {
                    header("Location: change-password.php?error=Incorrect password!");
                    exit();
                }
            }
        }
    } else {
        header("Location: change-password.php");
        exit();
    }
    ?>
</body>

</html>