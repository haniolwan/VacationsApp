<?php
session_start();
include "databaseconn.php";

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['password'] = $_COOKIE['password'];
}

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Home</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <link rel="stylesheet" href="Css/home-style.css" <?php echo time(); ?>>
        <style>
            a:hover {
                opacity: 0.7;
            }

            .home-body .Employee-profile {
                width: 260px;
            }

            body>div>div>div.Employee-list>ul>li:nth-child(3) {
                list-style-type: none;
            }

            #headingOne>button>i {
                margin-right: 20px;
            }

            body>div>div>div.Employee-list>ul>li:nth-child(3) li {
                padding-bottom: 15px;
                font-size: 18px;
                margin-left: 24px;
            }

            body>div>div>div.Employee-list>ul>li:nth-child(3) li a {
                text-decoration: none;
                color: #000000;
            }

            .accordion-body {
                padding: 0;
            }

            #collapseTwo>div>ul {
                list-style-type: none;
            }

            .accordion-button {
                background-color: #8cced8;
                font-size: 18px;
            }

            .accordion-item {
                border: none;
            }

            .accordion-button:not(.collapsed) {
                opacity: 0.7;
                color: #000;
                background-color: #FFFFFF;
                box-shadow: none;
            }

            .accordion-button:focus {
                border: none;
                box-shadow: none;
            }

            button:focus:not(:focus-visible) {
                outline: none;
            }
        </style>
    </head>

    <body>
        <h1>Employee Leave Managment System</h1>
        <div class="home-body">
            <div class="Employee-profile">
                <div class="Employee-info">
                    <img src="images/profile.png" />
                    <p>Hello, <?php echo $_SESSION['fname']; ?></p>
                    <p><?php echo $_SESSION['username']; ?></p>
                </div>
                <div class="Employee-list">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="profile.php" target="main"><i class="fas fa-user-circle"></i>My Profile</a></li>
                        <li class="list-group-item"><a href="change-password.php" target="main"><i class="fas fa-unlock"></i>Change Password</a></li>
                        <li>
                            <div class="accordion" id="accordionExample">

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fas fa-th"></i>Leaves
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="apply-leave.php" target="main">Apply Leave</a></li>
                                                <li><a href="leave-history.php" target="main">Leave History</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <iframe class="Employee-details" name="main"></iframe>
        </div>

        <script src="Bootstrap/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>

    </html>

<?php

} else {
    header("Location: index.php");
    exit();
}
?>