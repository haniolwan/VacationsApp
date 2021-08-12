<?php

include_once 'controller/database.php';
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

        .divs {
            width: 30%;
            height: 100px;
            background-color: #232b2b;
            /* borde
      r: 5px solid yellow; */
        }

        .table-div {
            background-color: white;

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
                        <a href="changepassword.php"><span class="bi bi-speedometer2 mr-3"></span> Change Password</a>
                    </li>
                    <li class="active">

                        <a href="logout.php"><span class="bi bi-box-arrow-in-right mr-3"></span> Logout</a>
                    </li>
                </ul>


            </div>

        </nav>



        <div class="container table-div m-5 ">
            <br>
            <h6 class="text-success pb-3">APPROVED LEAVE HISTORY
            </h6>
            <table class="table table-borderless">
                <thead>
                    <tr class="text-danger">
                        <th scope="col">#</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">Posting Date</th>
                        <th scope="col">Status</th>
                        <th scope="">Action</th>
                        <th scope="col-sm-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $leaves = pendingLeaves();
                    $inc = 1;
                    foreach ($leaves as $leave) {
                        $status = $leave['status'];
                        $html = '<tr>';
                        $html .= "<td>$inc</td>";
                        $html .= "<td>{$leave['fname']}</td>";
                        $html .= "<td>{$leave['type']}</td>";
                        $html .= "<td>{$leave['postDate']}</td>";
                        $html .= "<td $status=='Approved'?echo class='text-danger'':echoclass='text-primary''>{$status}</td>";
                        $html .= '<td></td>';
                        $html .= '<td><a href="viewdetails.php?id=' . $leave['id'] . '"><button type="button" class="btn btn-success">View Details</button></a></td>';
                        $html .= "</tr>";
                        echo $html;
                        // var_dump($leave["id"]);
                        $inc++;
                    }
                    ?>

                </tbody>
            </table>
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