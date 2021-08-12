<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Login</title>
    <link rel="stylesheet" href="Css\login-style.css">
</head>

<body>
    <h1>Leave Managment System</h1>
    <form action="login.php" method="post">
        <h2>EMPLOYEE LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <input type="text" name="username" placeholder="Enter Employee username" value="<?php if (isset($_COOKIE["username"])) {
                                                                                            echo $_COOKIE["username"];
                                                                                        } ?>">
        <input type="password" name="password" placeholder="Enter Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                        echo $_COOKIE["password"];
                                                                                    } ?>">
        <label>
            <input type="checkbox" name="remember-pass">
            remember login?
        </label>
        <button type="submit">Login</button>
    </form>

</body>

</html>