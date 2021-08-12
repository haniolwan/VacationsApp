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
  <link rel="stylesheet" href="css/dashboard-style.css">


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

    <div id="content" class="p-4 p-md-5">

      <nav class="d-flex justify-content-between">

        <div class="divs shadow-sm  mt-5">
          <div class="d-block p-3 ml-3">
            <h5 style="color:white">TOTAL REGD EMPLOYEE</h5>

            <h5 style="color:white">
              <?php
              $sql = "SELECT count(id) FROM empusers;";
              $result = $_DB->query($sql);
              if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                $count = $row[0];
                echo $count;
              }
              ?>
            </h5>
          </div>
        </div>

        <div class="divs shadow-sm  mt-5">
          <div class="d-block p-3 ml-3">
            <h5 style="color:white">TOTAL DEPARTMENTS</h5>

            <h5 style="color:white">
              3
            </h5>
          </div>
        </div>

        <div class="divs shadow-sm  mt-5">
          <div class="d-block p-3 ml-1">
            <h5 style="color:white">TOTAL LEAVE APPLICATIONS</h5>

            <h5 style="color:white">
              <?php
              $sql = "SELECT count(id) FROM leaves;";
              $result = $_DB->query($sql);
              if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                $count = $row[0];
                echo $count;
              }
              ?>
            </h5>
          </div>
        </div>

      </nav>

      <div class="container table-div mt-5 shadow">
        <br>
        <h6 class="text-success pb-3">Latest Leave Application</h6>
        <table class="table table-borderless">
          <thead>
            <tr class="text-danger">
              <th scope="col">Sl No.</th>
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
            $leaves = leave();
            $inc = 1;
            foreach ($leaves as $leave) {
              $status = $leave['status'];
              $class = "";
              if ($status == 'Approved') {
                $class = "text-success";
              } else if ($status == 'Not Approved') {
                $class = "text-danger";
              } else {
                $class = "text-primary";
              }
              $html = '<tr>';
              $html .= "<td>$inc</td>";
              $html .= "<td>{$leave['fname']}</td>";
              $html .= "<td>{$leave['type']}</td>";
              $html .= "<td>{$leave['postDate']}</td>";
              $html .= "<td class='{$class}'>{$status}</td>";
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
        <a href="">
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