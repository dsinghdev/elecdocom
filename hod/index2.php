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
                Proposals forwarded to you
            </h2>
            <small class="right">Welcome <h5><?php echo $hodNAME?></h5> </small>
        </div>

        <nav class='right'><form action="#" method="post"><input type="submit" value="Log Out" name="logout" class="btn btn-outline-danger"></form></nav>

          
        <br><br><br>
        <h4 class='center'>Forwarded Projects</h4><br>
        <table class="table">
       
            <tr>
                <th>Proposal title</th>
                <th>Proposal document</th>
                <th>Proposal date</th>
                <th>Proposal Status</th>
                <th>Remarks</th>
                <th>Student branch</th>
                <th>Forwarder by</th>
                <th>Action</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `forwarded_record` WHERE `hod_ID` = '${hodID}';";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $prID = $data['project_ID'];
                        $title = $data['project_TITLE'];
                        $pdate = $data['project_date'];
                        $hodID = $data['hod_ID'];
                        $fhodID = $data['fhod_ID'];
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
                            
                            <td><select name='status${prID}' class='form-control'>
                                <option value='1'>ACCEPT</option>
                                <option value='2'>REJECT</option>
                            </select></td>
                            <td><input type='text' name='comment${prID}'  placeholder='Leave Remarks' value='${comment}' required></td>
                            ";
                             $sql1 = "SELECT `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record` WHERE `hod_ID` = '${fhodID}'";
                        $result1 = $conn->query($sql1);
                        $data1 = $result1->fetch_assoc();
                        $fhodNAME = $data1['hod_FIRST_NAME'] . ' ' . $data1['hod_LAST_NAME'];
                            echo"
                                <td>${course}</td>
                                <td>${fhodNAME}</td>";
                                   
                            if($status==1&&2){
                                echo "<td><b><p><font color='green'>SUBMITTED</font></p></b></td>";  
                               }
                            else{
                                echo "<td><input type='submit' name='update${prID}' class='btn btn-primary'></td>";
                            }
                                "<td><a href= forward.php?hodID=${hodID}&fhodID=${fhodID}&prID=${prID}>Forward</a></td>";
                                ?>
                                </form>
                                <?php
                                if(isset($_POST['update'.$prID])){
                                    $status = $_POST['status'.$prID];
                                    $comment = $_POST['comment'.$prID];
                                    $sql = "UPDATE `forwarded_record` SET `project_PROFESSOR` = '${professor}', `project_STATUS` = '${status}' , `project_COMMENT` = '${comment}' WHERE `forwarded_record`.`project_ID` = ${prID};";
                                    $conn->query($sql);
                                   
                                }
                        echo "</tr>";

                    }
                }else{
                    echo '<tr><td colspan="8"><div class="alert alert-success center" role="alert" >No forwards</div></td></tr>';
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