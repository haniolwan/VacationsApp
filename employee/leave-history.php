<?php
session_start();
error_reporting(0);
include "databaseconn.php";

if (isset($_SESSION['id'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Leave History</title>
        <style>
            * {
                box-sizing: border-box;
                padding: 0;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            body {
                padding: 60px 40px;
            }

            h3 {
                padding-bottom: 20px;
                color: #239954;
            }

            form {
                padding: 50px 40px;
                background-color: #FFFFFF;
                box-shadow: 0 0 7px #cfcfcf;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                text-align: left;
            }

            th {
                padding: 15px 5px;
                color: red;
                font-size: 17px;
                border-bottom: 2px solid #f2f2f2;
            }

            td {
                padding: 20px 5px;
                font-size: 15px;
                border-bottom: 2px solid #f2f2f2;
            }

            .search-box {
                display: flex;
                justify-content: space-between;
                padding-bottom: 40px;
            }

            .search-box input,
            .search-box select {
                display: block;
                padding: 10px;
                border: none;
                outline: none;
                border-bottom: 1px solid #f5f6fa;
            }

            .search-box input {
                width: 300px;
            }
        </style>
    </head>

    <body>
        <h3>LEAVE HISTORY</h3>
        <form action="leave-history.php" method="post">
            <div class="search-box">
                <select name="number">
                    <option selected="selected" disabled>Choose number of rows</option>
                    <option value="_10">5</option>
                    <option value="_25">25</option>
                    <option value="_50">50</option>
                    <option value="_100">100</option>
                </select>
                <input type="search" name="search" placeholder="Search">
            </div>
            <table>
                <thead>
                    <th>id</th>
                    <th>Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Description</th>
                    <th>Posting Date</th>
                    <th>Status</th>
                </thead>


                <?php
                function leave()
                {
                    global $_DB;
                    $sql = "SELECT a.id, a.type, a.postDate, a.status, b.username ,b.fname FROM `leaves` a 
                    LEFT JOIN `empusers` b ON a.emp_id = b.id
                    LIMIT 5;";
                    // var_dump($sql);
                    $result = $_DB->query($sql);
                    $leaves = [];
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $leaves[] = $row;
                        }
                    }
                    return $leaves;
                }
                $id = $_SESSION['id'];
                //For search input...
                if (isset($_POST['search'])) {
                    $searchKey = $_POST['search'];
                    $sql = "SELECT * FROM leaves WHERE type like '%$searchKey%'";
                } else
                    //Select data from db where id of user equal id of leaves...
                    $sql = "SELECT * FROM leaves WHERE emp_id = '$id'";
                $result = mysqli_query($conn, $sql);
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    $type[$i] = $row['type'];
                    $fromDate[$i] = $row['fromDate'];
                    $toDate[$i] = $row['toDate'];
                    $desc[$i] = $row['description'];
                    $postDate[$i] = $row['postDate'];
                    $status[$i] = $row['status'];

                    $i++;
                }
                for ($i = 1; $i <= count($type); $i++) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $type[$i]; ?></td>
                        <td><?php echo $fromDate[$i]; ?></td>
                        <td><?php echo $toDate[$i]; ?></td>
                        <td><?php echo $desc[$i]; ?></td>
                        <td><?php echo $postDate[$i]; ?></td>
                        <td><?php echo $status[$i]; ?></td>
                    </tr>
                <?php
                } ?>
            </table>
        </form>
    </body>

    </html>
<?php
}
?>