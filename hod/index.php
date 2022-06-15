<?php
    session_start();
    require_once('../server/connection.php');
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
            <img src="img/elecdocom.png" alt="logo">
            <h2 class="center">
                Authority Dashboard
            </h2>
  <div>
      <img src="img/elecdocom.png" alt="logo">
    </div>
            <small class="right">Welcome <?php echo $hodNAME?> </small>
        </div>

        <nav class='right'><form action="#" method="post"><input type="submit" value="Log Out" name="logout" class="btn btn-outline-danger"></form></nav>

          
        <br><br><br>
        <div>
            <a href="Forwarded_Proposals.php" class="btn btn-outline-success">Proposals forwarded by you</a>
             <a href="index2.php" class="btn btn-outline-success">Proposals forwarded to you</a>
        </div>
        <table class="table">
        <caption  class='center'>Approve Projects</caption>
            <tr>
                <th>Proposal title</th>
                <th>Proposal document</th>
                <th>Proposal date</th>
                <th>Assign faculty(if any)</th>
                <th>Proposal Status</th>
                <th>Remarks</th>
                <th>Student branch</th>
                <th>Student semester</th>
                <th>Action</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `project_record` WHERE `hod_ID` = '${hodID}';";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $prID = $data['project_ID'];
                        $title = $data['project_TITLE'];
                        $pdate = $data['project_date'];
                        $hodID = $data['hod_ID'];
                        $stdID = $data['student_ID'];
                        $professor = $data['project_PROFESSOR'];
                        $status = $data['project_STATUS'];
                        $comment = $data['project_COMMENT'];
                        $course = $data['project_COURSE'];
                        $batch = $data['project_BATCH'];
                        $file = $data['project_file'];
                        echo"
                        <tr>
                            <td>${title}</td> 
                            <td> <a href = ${file} class='btn btn-info' download>Download</a></td>";
                            echo"<td>${pdate}</td>";
                        ?>
                        <form action="#" method="post">
                        <?php
                            echo"
                            <td>
                                <input type='text' name='prof${prID}' placeholder='Assign faculty(if any)' value='${professor}' required> 
                            </td>
                            <td><select name='status${prID}' class='form-control'>
                                <option value='1'>ACCEPT</option>
                                <option value='2'>REJECT</option>
                            </select></td>
                            <td><input type='text' name='comment${prID}'  placeholder='Leave Remarks' value='${comment}' required></td>
                            ";
                            echo"
                                <td>${course}</td>
                                <td>${batch}</td>
                                <td><a href='./../chat/index.php?hodID=${hodID}&stdID=${stdID}' class='btn btn-primary'>Chat</a></td>
                                <td><input type='submit' name='update${prID}' class='btn btn-primary'></td>
                            <td><button><a href= forward.php?hodID=${hodID}&stdID=${stdID}&prID=${prID}&title={title}>Forward </a></button></td>";
                                ?>
                                </form>
                                <?php
                                if(isset($_POST['update'.$prID])){
                                    $prof = $_POST['prof'.$prID];
                                    $status = $_POST['status'.$prID];
                                    $comment = $_POST['comment'.$prID];
                                    $sql = "UPDATE `project_record` SET `project_PROFESSOR` = '${prof}', `project_STATUS` = '${status}' , `project_COMMENT` = '${comment}' WHERE `project_record`.`project_ID` = ${prID};";
                                    $conn->query($sql);
                                    $sql = "INSERT INTO `project_notification` (`notification_id`, `project_id`, `student_id`, `hod_id`) VALUES (NULL, '${prID}', '${stdID}', '${hodID}')";
                                    $conn->query($sql);
                                }
                        echo "</tr>";

                    }
                }else{
                    echo '<tr><td colspan="8"><div class="alert alert-success center" role="alert" >No Project Waiting for Approval</div></td></tr>';
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