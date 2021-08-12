<?php
include_once 'database.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Employee Leave Managment System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/changepassword-stlye.css">

</head>


<body>


    <div class="d-flex justify-content-center bg-primary ">
        <h1 style="color:white">Employee Leave Managment System</h1>
    </div>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-info">
            <header class="avatar bg-info mt-5" style="padding-right:120px">
                <img src="https://www.w3schools.com/howto/img_avatar.png" />

                <h4><?php echo $_SESSION['username']; ?></h4>
            </header>

            <div class="p-1 ">
                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>

                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="../dashboard.php"><span class=" fa fa-sticky-note mr-3"></span>Dashboard</a>
                    </li>
                    <li class="active">

                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="bi bi-file-person-fill mr-3"></span>Employees</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="../addemployee.php">Add Employee</a>
                            </li>
                            <li>
                                <a href="../manageemployee.php">Manage Employee</a>
                            </li>

                        </ul>
                    </li>

                    <li class="active">
                        <a href="#managmentmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="bi bi-tv mr-3"></span>Leave Managment</a>
                        <ul class="collapse list-unstyled" id="managmentmenu">
                            <li>
                                <a href="../allleaves.php">All Leaves</a>
                            </li>
                            <li>
                                <a href="../approvedleaves.php">Approved</a>
                            </li>
                            <li>
                                <a href="../notapprovedleaves.php">Not Approved</a>
                            </li>
                            <li>
                                <a href="../pendingleaves.php">Pending Leaves</a>
                            </li>

                        </ul>
                    </li>
                    <li class="active">
                        <a href="/vacations/controller/changepassword.php"><span class="bi bi-speedometer2 mr-3"></span> Change Password</a>
                    </li>
                    <li class="active">

                        <a href="logout.php"><span class="bi bi-box-arrow-in-right mr-3"></span> Logout</a>
                    </li>
                </ul>


            </div>

        </nav>

        <div class="container">
            <div class="d-flex justify-content-center mt-5">

                <div class="col-sm-6 " style="margin:120px">
                    <?php
                    if (@$_GET["Error"] == true) {
                    ?>
                        <div>
                            <h4 style="color:red"> <?php echo $_GET['Error'] ?></h4>
                        </div>
                    <?php

                    }
                    ?>

                    <form action="database.php" method="POST">
                        <h5>Current Password</h5>
                        <div class="form-group pass_show">
                            <input type="password" value="<?php echo $_SESSION['password'] ?>" class="form-control" placeholder="Current Password">
                        </div>
                        <h5>New Password</h5>
                        <div class="form-group pass_show">
                            <input type="password" class="form-control" name="password">
                        </div>
                        <h5>Confirm Password</h5>
                        <div class="form-group pass_show">
                            <input type="password" class="form-control" name="confirm-password">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-lg" name="change">Confirm</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>


    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>





    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>


</body>