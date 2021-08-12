<?php
include_once 'controller/database.php';

if (!$_SESSION['username'])
    session_start();



$id = $_GET['id'];

if (isset($id)) {
    $sql = "select * from empusers where id ='$id';";

    $result = $_DB->query($sql);

    $row = $result->fetch_assoc();
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Employee Leave Managment System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/addemployee-style.css">

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
                        <a href="dashboard.php"><span class=" fa fa-sticky-note mr-3"></span>Dashboard</a>
                    </li>
                    <li class="active">

                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="bi bi-file-person-fill mr-3"></span>Employees</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="/vacations/addemployee.php">Add Employee</a>
                            </li>
                            <li>
                                <a href="manageemployee.php">Manage Employee</a>
                            </li>

                        </ul>
                    </li>

                    <li class="active">
                        <a href="leavemanagment.php"><span class="bi bi-tv mr-3"></span>Leave Managment</a>
                    </li>

                    <li class="active">
                        <a href="controller/changepassword.php"><span class="bi bi-speedometer2 mr-3"></span>Change Password</a>
                    </li>
                    <li class="active">

                        <a href="controller/logout.php"><span class="bi bi-box-arrow-in-right mr-3"></span>Logout</a>
                    </li>
                </ul>


            </div>

        </nav>
        <div id="content" class="p-md-5">
            <h5 class="text-success">Add Employee</h5>
            <div class="container table-div mt-4 shadow">
                <div class="box">
                    <form action="controller/storeemployee.php" method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="flex-column" style="width:45%">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                <input type="hidden" name="method" value="<?php echo $row['id'] ? 'update' : 'insert' ?>">
                                <?php
                                if (@$_GET["Error"] == true) {
                                ?>
                                    <div>
                                        <h3 style="color:red"> <?php echo $_GET['Error'] ?></h3>
                                    </div>
                                <?php

                                }
                                ?>
                                <div class="input-container">
                                    <input type="text" required="" name="username" value="<?php echo $row['username'] ?>" />
                                    <label class="text-secondary">Employee Code(Must be unique)</label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="input-container">
                                        <input type="text" required="" name="fname" value="<?php echo $row['fname'] ?>" />
                                        <label class="text-secondary">First name</label>
                                    </div>
                                    <div class="input-container">
                                        <input type="text" required="" name="lname" value="<?php echo $row['lname'] ?>" />
                                        <label class="text-secondary">Last name</label>
                                    </div>
                                </div>
                                <div class="input-container">
                                    <input type="text" required="" name="email" value="<?php echo $row['email'] ?>" />
                                    <label class="text-secondary">Email</label>
                                </div>
                                <div class="input-container">
                                    <input type="password" required="" name="password" value="<?php echo $row['password'] ?>" />
                                    <label class="text-secondary">Password</label>
                                </div>
                                <div class="input-container">
                                    <input type="password" required="" name="passwordconfirm" value="<?php echo $row['password'] ?>" />
                                    <label class=" text-secondary">Confirm password</label>
                                </div>
                            </div>

                            <div class="flex-column" style="width:45%">
                                <div class="d-flex justify-content-between">
                                    <div class="input-container">
                                        <select id="selectbox" name="gender">
                                            <option value="">Gender...</option>
                                            <option value="Male" <?php echo ($row['gender'] == "Male") ? 'selected' :  "";  ?>>Male</option>
                                            <option value="Female" <?php echo ($row['gender'] == "Female") ? 'selected' :  "";  ?>>Female</option>
                                            <option value="None">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="input-container">
                                        <input type="text" required="" name="birthday" value="<?php echo $row['DOB'] ?>" />
                                        <label class="text-secondary">Birthdate</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="input-container ">
                                        <select id="selectbox" name="section">
                                            <option value="" selected="selected" disabled="disabled" value="<?php echo $row['section'] ?>">Department...</option>
                                            <option value="Operations" <?php echo ($row['section'] == "Operations") ? 'selected' :  "";  ?>>Operations</option>
                                            <option value="Information Technology" <?php echo ($row['section'] == "Information Technology") ? 'selected' :  "";  ?>>Information Technology</option>
                                            <option value="Human Resources" <?php echo ($row['section'] == "Human Resources") ? 'selected' :  "";  ?>>Human Resources</option>
                                        </select>
                                    </div>
                                    <div class="input-container">
                                        <input type="text" required="" name="country" value="<?php echo $row['country'] ?>" />
                                        <label class="text-secondary">Country</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="input-container ">
                                        <input type="text" required="" name="city" value="<?php echo $row['city'] ?>" />
                                        <label class="text-secondary">City/Town</label>
                                    </div>
                                    <div class="input-container">
                                        <input type="text" required="" name="address" value="<?php echo $row['city'] ?>" />
                                        <label class="text-secondary">Address</label>
                                    </div>
                                </div>
                                <div class="input-container">
                                    <input type="text" required="" name="mobile" value="<?php echo $row['mobileno'] ?>" />
                                    <label class="text-secondary">Mobile Number</label>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg" name="add">Add / Update</button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
    </div>







    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>