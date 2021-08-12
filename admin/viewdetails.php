<?php
include_once 'controller/database.php';
session_start();
$id = $_GET['id'];
$user = getUser($id);
// var_dump($user['fname']);

$sql = "UPDATE users SET `password` = '$newPassword' WHERE username='$username';";


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

    <style>
        body {
            background-color: whitesmoke;
        }

        .avatar {
            background: rgba(0, 0, 0, 0.1);
            padding: 2em 0.5em;
            text-align: center;
        }

        img {
            width: 70px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
        }

        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }


        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>

</head>

<body>


    <div class="d-flex justify-content-center bg-primary ">
        <h1 style="color:white">Employee Leave Managment System</h1>
    </div>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-info">
            <header class="avatar bg-info mt-5" style="padding-right:140px">
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
                        <a href="#managmentmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="bi bi-tv mr-3"></span>Leave Managment</a>
                        <ul class="collapse list-unstyled" id="managmentmenu">
                            <li>
                                <a href="allleaves.php">All Leaves</a>
                            </li>
                            <li>
                                <a href="approvedleaves.php">Approved</a>
                            </li>
                            <li>
                                <a href="notapprovedleaves.php">Not Approved</a>
                            </li>
                            <li>
                                <a href="pendingleaves.php">Pending Leaves</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="controller/changepassword.php"><span class="bi bi-speedometer2 mr-3"></span> Change Password</a>
                    </li>
                    <li class="active">

                        <a href="controller/logout.php"><span class="bi bi-box-arrow-in-right mr-3"></span> Logout</a>
                    </li>
                </ul>


            </div>

        </nav>
        <main class="mn-inner">
            <div class="m-5">
                <div class="col s12">
                    <div class="page-title" style="font-size:24px;">Leave Details</div>
                </div>

                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <td style="font-size:16px;" class="text-dark"> <b>Employe Name :</b></td>
                            <td style="font-size:14px;" class="text-primary"><b><?php echo $user["fname"]; ?></b></td>
                            <td style="font-size:16px;" class="text-dark"><b>Emp username :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["username"]; ?></b></td>
                            <td style="font-size:16px;" class="text-dark"><b>Gender :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["gender"]; ?></b></td>
                        </tr>

                        <tr>
                            <td style="font-size:16px;"><b>Emp Email :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["email"]; ?></b></td>
                            <td style="font-size:16px;"><b>Emp Contact No. :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["mobileno"]; ?></b></td>

                        </tr>

                        <tr>
                            <td style="font-size:16px;"><b>Leave Type :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b>Casual leave</b></td>
                            <td style="font-size:16px;"><b>Leave Date :</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["fromDate"]; ?></b></td>
                            <td style="font-size:16px;"><b>Posting Date</b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user["CreationDate"]; ?></b></td>

                        </tr>

                        <tr>
                            <td style="font-size:16px;"><b>Employe Leave Description : </b></td>
                            <td style="font-size:14px;" class="text-muted"><b><?php echo $user['description']; ?></b></td>

                        </tr>

                        <tr>
                            <td style="font-size:16px;"><b>leave Status :</b></td>
                            <td style="font-size:14px;" <?php $status = $user['status'];
                                                        if ($status == 'Approved') {
                                                            echo "class='text-success'";
                                                        } else if ($status == 'Not Approved') {
                                                            echo "class='text-danger'";
                                                        } else {
                                                            echo "class='text-primary'";
                                                        }
                                                        ?>><b><?php echo $user["status"]; ?></b></td>
                        </tr>


                        <tr>
                            <td colspan="5">
                                <a class="" data-toggle="modal" data-target="#mymodal" href="#mymodal"><button type="submit" class="btn btn-success" name="submit-status">Take Action</button></a>

            </div>

            </td>
            </tr>
            </tbody>
            </table>
    </div>
    </div>
    </main>
    </div>
    </div>
    </div>
    <div id="mymodal" class="modal">
        <div class="modal-dialog " style="height:120%">
            <div class="modal-content" style="width:140%">
                <div class="modal-header">
                    <h4 class="modal title text-success">Leave take action</h4>
                </div>
                <div class="modal-body">
                    <form action="controller/database.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <select class="form-select mb-3" aria-label="Default select example" name="status" required="" style="width:650px">
                            <option value="">Choose your option</option>
                            <option value="Approved">Approved</option>
                            <option value="Not Approved">Not Approved</option>
                        </select>
                        <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" style="width:650px"></textarea></p>
                        <div class="modal-footer" style="width:90%">
                            <button type="submit" class="btn btn-success" name="submit-status">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
</body>

</html>