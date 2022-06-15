<?php
    require_once('../server/connection.php');
    session_start();
    $hodID = $_SESSION['id'];
    

   
    
    $sql = "SELECT `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record` WHERE `hod_ID` = '${hodID}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $hodNAME = $data['hod_FIRST_NAME'] . " " . $data['hod_LAST_NAME'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container container-fluid">
        <div class="jumbotron">
            <img src="img/elecdocom.png" alt="logo"><br><br><br>
            <h1 class="center">
                Forwarded Proposal
            </h1>
            <small class="right">Welcome <h5><?php echo $hodNAME?></h5> </small>
        </div>
        <div>
            </h3>
            
<div class="left"><a href="../" class='btn btn-primary'>Go Back</a></div><br><br>
        <nav class="right">
            <form action="#" method="post">
                
                &nbsp
                <input type="submit" value="Log Out" class="btn btn-outline-danger" name="logout">
            </form><br><br><br>
        </nav>
        <table class="table">
            <tr>
                <th>Proposal title</th>
                <th>Proposal date</th>
                <th>Receiver Authority</th>
                <th>Proposal Status</th>
                <th>Proposal comments</th>
                <th>Proposer Department</th>
                <th>Proposer Semester</th>
                           </tr>
            <?php
                $sql = "SELECT * FROM `forwarded_record` WHERE `hod_ID` = '${hodID}';";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $title = $data['project_TITLE'];
                        $pdate = $data['project_date'];
                        $hodID = $data['hod_ID'];
                        $professor = $data['project_PROFESSOR'];
                        $status = $data['project_STATUS'];
                        $comment = $data['project_COMMENT'];
                        $course = $data['project_COURSE'];
                        $batch = $data['project_BATCH'];
                        echo"
                        <tr>
                            <td>${title}</td>
                            <td>${pdate}</td>
                        ";
                        $hodNAME = '';
                        $sql1 = "SELECT `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record` WHERE `hod_ID` = '${hodID}'";
                        $result1 = $conn->query($sql1);
                        $data1 = $result1->fetch_assoc();
                        $hodNAME = $data1['hod_FIRST_NAME'] . ' ' . $data1['hod_LAST_NAME'];
                        echo"
                            <td>${hodNAME}</td>
                            
                        ";
                        if($status == 0){
                            echo "<td><font color='blue'><strong>PENDING</strong></font></td>";
                        }elseif($status == 1){
                            echo "<td><font color='green'><strong>ACCEPTED</strong></font></td>";
                        }else{
                            echo "<td><font color='red'><strong>REJECTED</strong></font></td>";
                        }
                        echo"
                            <td>${comment}</td>
                            <td>${course}</td>
                            <td>${batch}</td>
                            
                        </tr>";
                    }
                }else{
                    echo '<br><br><br><br><tr><td colspan="9"><div class="alert alert-danger center" role="alert" >You Have No Project</div></td></tr>';
                }
            ?>
        </table>
    </div>
</body>
</html>
<?php
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: ../");
    }
?>