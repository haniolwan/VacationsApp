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

    <link rel="stylesheet" href="css/manageemployee-stlye.css">

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
                                <a href="addemployee.php">Add Employee</a>
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
                        <a href="/vacations/controller/changepassword.php"><span class="bi bi-speedometer2 mr-3"></span> Change Password</a>
                    </li>
                    <li class="active">

                        <a href="controller/logout.php"><span class="bi bi-box-arrow-in-right mr-3"></span> Logout</a>
                    </li>
                </ul>


            </div>

        </nav>
        <div id="content" class="p-md-5">
            <h5 class="text-success">MANAGE EMPLOYES</h5>
            <div class="container table-div mt-5 shadow">
                <input type="search" name="" class="search-bar" placeholder="Search in records">
                <div class="ml-3 d-grid">
                    <span>Show</span>
                    <?php
                    $select_value = isset($_GET["uid"]) ? $_GET["uid"] : 10;

                    ?>
                    <select class="form-select form-select-lg mb-2" id="view-employees">
                        <?php foreach ([10, 25, 50] as $number) {
                            $isSelected = $number == $select_value ? 'selected' : '';
                            echo "<option value='$number' $isSelected>$number</option>";
                        } ?>
                    </select>
                </div>
                <table class="table table-borderless" id="dtBasicExample">
                    <thead>
                        <tr class="text-danger">
                            <th scope="col" class="th-sm">Sl No.</th>
                            <th scope="col" class="th-sm">Emp Id</th>
                            <th scope="col">Emp Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            <th scope="col">Reg Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $somevar = isset($_GET["uid"]) ? $_GET["uid"] : 10; //puts the uid varialbe into $somevar
                        $leaves = leaveHistory($somevar);
                        // var_dump($leaves);
                        $inc = 1;
                        foreach ($leaves as $leave) {
                            $html = '<tr>';
                            $html .= "<td>$inc</td>";
                            $html .= "<td>{$leave['username']}</td>";
                            $html .= "<td>{$leave['fname']}</td>";
                            $html .= "<td>{$leave['section']}</td>";
                            $html .= "<td class='text-success'>Active</td>";
                            $html .= "<td>{$leave['reg_date']}</td>";
                            $html .= '<td><a href="addemployee.php?id=' . $leave['id'] . '">
                            <i class="bi bi-pen-fill fa-lg"></i>
                            </a>
                            
                            <a class="table-delete-button" href="#myModal" data-toggle="modal" class="ml-2" data-id=' . $leave['id'] . ' onclick="addIdToModalDelete(this)"> <i class="bi bi-x-square-fill fa-lg">
                            
                            </i></a></td>';
                            $html .= "</tr>";
                            echo $html;
                            // var_dump($leave["id"]);
                            $inc++;
                        }
                        ?>

                    </tbody>
                </table>

                <hr class="bg-dark">
                <div class="mb-3 d-flex justify-content-between">
                    <?php
                    $sql = "SELECT count(id) FROM empusers;";
                    $result = $_DB->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_array();
                        $total = $row[0];
                    } ?>
                    <h6 class=""><?php echo "Showing 1 to 2 of $total entries" ?></h6>

                    <div class="d-flex pb-4">

                        <a href="" class="mt-1"><i class="bi bi-chevron-left fa-lg"></i></a>
                        <div class="pages bg-secondary d-flex justify-content-center ml-2 mr-2 ">
                            <h6 class="text-light mt-1">1</h6>
                        </div>
                        <a href="" class="mt-1"><i class="bi bi-chevron-right fa-lg"></i></a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title w-100 ">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-button" onclick="deleteEmp()">Delete</button>
                </div>
            </div>
        </div>
    </div>



    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    <script>
        document.getElementById("view-employees").addEventListener("change", myFunction);

        function myFunction() {
            var e = document.getElementById('view-employees');
            var strUser = e.value;
            window.location.href = "/vacations/manageemployee.php?uid=" + strUser;
        }
    </script>

    <script>
        //DELETE
        function addIdToModalDelete(element) {
            var id = element.getAttribute('data-id');
            document.getElementById('delete-button').setAttribute('data-id', id);
        }

        function deleteEmp() {
            var id = document.getElementById('delete-button').getAttribute('data-id');
            window.location = 'controller/deleteEmp.php?id=' + id;

        }
    </script>
</body>

</html>