<?php
    session_start();
    require_once('../server/connection.php');
    $stdID = $_SESSION['id'];
    $sql = "SELECT `student_FIRST_NAME` , `student_LAST_NAME` FROM `student_record` WHERE `student_ID` = '${stdID}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $studentName = $data['student_FIRST_NAME'] . " " . $data['student_LAST_NAME'] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image" href="img/apple-touch-icon.png">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron mb-5">
            <img src="img/elecdocom.png" alt="logo"><br><br><br>
            <h1 class='center'>Notifications
            </h1>
            <small class="right">Welcome<h5><?php echo $studentName ?></h5></small>
        </div>
        <a href="./" class="btn btn-primary mb-3">Go Back</a>
        <?php
            $sql = "SELECT * FROM `project_notification` WHERE `student_id` = '${stdID}' AND `seen` = 0";
            $result = $conn->query($sql);
            $rows = $result->num_rows;
            if($rows>=1){
                echo "
                    <table class='table'>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                ";
                $count = 0;
                while($data = $result->fetch_assoc()){
                    $count+=1;
                    $prID = $data['project_id'];
                    $notID = $data['notification_id'];
                    $sql1 = "SELECT `project_STATUS`,`project_TITLE`  FROM `project_record` WHERE `project_ID` = '${prID}'";
                    $result1 = $conn->query($sql1);
                    $data1 = $result1->fetch_assoc();
                    $title = $data1['project_TITLE'];
                    echo "
                        <td>${count}</td>
                        <td><span class='mt-5 alert alert-warning center' role='alert'>`Proposal ${title}`
                    ";
                    if($data1['project_STATUS'] == 1){
                        echo "<font color='green'><strong> ACCEPTED</strong></font>";
                    }else{
                        echo "<font color='red'><strong> REJECTED</strong></font>";
                    }
                    echo"
                        </span></td>
                        <td><form method='POST'><input type='submit' value='Delete' class='btn btn-info' name='seen${notID}'></form></td>
                        </tr>
                    ";
                    if(isset($_POST['seen'.$notID])){
                        $sql2 = "UPDATE `project_notification` SET `seen` = '1' WHERE `project_notification`.`notification_id` = ${notID};";
                        $conn->query($sql2);
                        header('location:./notification_screen.php');
                    }
                }
                echo "
                    </table>
                ";
            }else{
                echo '<div class="mt-5 alert alert-success center" role="alert">No New Notification</div>';
            }
        ?>
    </div>
</body>
</html>