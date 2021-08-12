<?php
session_start();
include "databaseconn.php";

if (isset($_SESSION['id'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Apply Leave</title>
        <link rel="stylesheet" href="Css/apply-style.css">
        <style>
            button {
                display: block;
                padding: 7px 25px;
                border: none;
                border-radius: 2px;
                outline: none;
                background-color: #27b161;
                color: #f5f6fa;
                font-size: 15px;
                font-weight: bold;
                cursor: pointer;
                box-shadow: 0 0 2px #999999;
            }

            .success {
                background-color: #D1E7DD;
                color: #0F5132;
                padding: 10px;
                margin-bottom: 10px;
                width: 100%;
                border-radius: 5px;
            }

            .error {
                background-color: #F2DEDE;
                color: #A94442;
                padding: 10px;
                margin-bottom: 10px;
                width: 100%;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <h3>APPLY FOR LEAVE</h3>
        <form action="apply-leave.php" method="post">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="first-row">
                <label>
                    <p>From Date </p>
                    <input type="date" name="from-date">
                </label>
                <label>
                    <p>To Date </p>
                    <input type="date" name="to-date">
                </label>
            </div>

            <select name="leave-type">
                <option selected="selected">Select leave type...</option>
                <option value="medical-leave">Medical leave</option>
                <option value="casual-leave">Casual leave</option>
                <option value="restricted-holiday">Restricted holiday</option>
            </select>

            <label>
                <p>Description</p>
                <input type="text" name="description">
            </label>

            <button type="submit" name="apply">APPLY</button>

        </form>
    </body>

    </html>
<?php
    if (isset($_POST['apply'])) {
        $id = $_SESSION['id'];
        //Check the fields if they are empty or not...
        if (!empty($_POST['from-date']) && !empty($_POST['to-date']) && !empty($_POST['leave-type']) && !empty($_POST['description'])) {

            //Store the post data in vars...
            $fromDate = $_POST['from-date'];
            $toDate = $_POST['to-date'];
            $leaveType = $_POST['leave-type'];
            $description = $_POST['description'];
            //Check if the date is valid...
            if ($fromDate >= $toDate) {
                header("Location: apply-leave.php?error=ToDate should be greater than FromDate");
                exit();
            }

            $sql = "INSERT INTO leaves(emp_id,fromDate, toDate, type, description) VALUES ('$id', '$fromDate', '$toDate', '$leaveType', '$description')";
            $result = mysqli_query($conn, $sql);

            header("Location: apply-leave.php?success=Leave Applied");
            exit();
        } else {
            header("Location: apply-leave.php?error=All Fields Required!");
            exit();
        }
    }
}
?>