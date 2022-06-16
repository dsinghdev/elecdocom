<?php
    session_start();
    require_once('../server/connection.php');
   
    $hodID = $_SESSION['id'];
    $prID=$_GET['prID'];
    
    $sql = "SELECT * FROM `hod_record` WHERE `hod_ID` = '${hodID}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $hodNAME=$data['hod_FIRST_NAME'] . " " . $data['hod_LAST_NAME'];
   $sql = "SELECT * FROM `project_record` WHERE `project_ID` = '${prID}';";
   $result = $conn->query($sql);
   $data = $result->fetch_assoc();
   $title=$data['project_TITLE'];
   $batch=$data['project_BATCH'];
   $course=$data['project_COURSE'];
   $file=$data['project_file'];


  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container container-fluid">
        <div class="jumbotron">
            <img src="img/elecdocom.png" alt="logo"><br><br><br>
            <h1 class="center">
                Forward Proposal
            </h1>
            <small class="right">Welcome <h5><?php echo $hodNAME?></h5> </small>
        </div>
        <div>
        <div class="left"><a href="../" class='btn btn-primary'>Go Back</a></div><br><br>
        <section class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group row">    
                    <input type="text" name="title" readonly class="form-control col-5" value="<?php echo $title?>" >
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="number" name="batch" readonly class="form-control col-5" value="Semester:<?php echo $batch?>" >
                </div>
                <div class="form-group row">
                    <input type="text" name="course" readonly class="form-control col-5" value="<?php echo $course?>" >
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="text" readonly class="form-control col-6" value="Proposal ID: <?php echo $prID?>">
                    
                   
                </div>
                <div class="form-group row">
                    <input type="date" name="pdate" class="form-control col-5" value="<?php echo $pdate?>">
                    &emsp;&emsp;&emsp;&emsp;&emsp;
                     <input type="text" name='fhodID' readonly class="form-control col-6" value="Forwarder ID is: <?php echo $hodID?>">
                 </div>
                <div class="form-group row">
                    <label for="hod" class="col-1 col-form-label">Forward tO</label>
                    <select name="hod" class="col-5 form-control">
                        <?php
                            $sql = "SELECT `hod_ID` , `hod_FIRST_NAME` , `hod_LAST_NAME`, `hod_DEPT`FROM `hod_record`;";
                            $result = $conn->query($sql);
                            $rows = $result->num_rows;
                            if($rows >= 1){
                                while($data = $result->fetch_assoc()){
                                    $id = $data['hod_ID'];
                                    $name = $data['hod_FIRST_NAME'] . " " . $data['hod_LAST_NAME'];
                                    echo "<option value='${id}'>${name}</option>";
                                }
                            }
                        ?>  
                    </select>
                    &emsp;&emsp;&emsp;
                    <?php 
                     $hodID = $_SESSION['id'];
                     $prID=$_GET['prID'];
                     
                     
                    $sql = "SELECT * FROM `project_record` WHERE `project_ID` = '${prID}';";
                    $result = $conn->query($sql);
                    $data = $result->fetch_assoc();
                    
                    $file=$data['project_file'];
                 
                 echo "<td> <a href = ${file} class='btn btn-info' download>Your File   </a></td>";
                   
                     ?>
                 <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $file?>" >
                </div>
                <input type="submit" name="propose" value="Forward" class="btn btn-outline-primary right">
            </form>
            
        </section>
    </div>


</body>
</html>

<?php
        if(isset($_POST['propose'])){
            $title= $_POST['title'];
            $batch= $_POST['batch'];
            $course= $_POST['course'];
            $pdate= $_POST['pdate'];
            $fhodID= $_SESSION['id'];
            $hod= $_POST['hod'];
            $document = '';
            $file = $_FILES['fileToUpload'];
            $fileName = $file['name'];
            $fileTempName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.',$fileName);
            $fileActulaExtension = strtolower(end($fileExt));
            $allowed = array('pdf','doc','txt');
            if(in_array($fileActulaExtension,$allowed)){
                if($fileError === 0){
                    if($fileSize < 5000000){
                        $fileNameNew = uniqid('',true) . '.' . $fileActulaExtension;
                        $fileDestination = '../server/uploads/'.$fileNameNew;
                        move_uploaded_file($fileTempName,$fileDestination);
                        $document = $fileDestination;
                        $sql = "INSERT INTO `forwarded_record` (`project_ID`, `fhod_ID`, `hod_ID`, `project_TITLE`, `project_date`, `project_PROFESSOR`, `project_BATCH`, `project_COURSE`, `project_COMMENT`, `project_STATUS`, `project_file`) VALUES ('${prID}', '${fhodID}', '${hod}', '${title}', '${pdate}', NULL, '${batch}', '${course}', NULL, '0', '${document}')";
                        if($conn->query($sql) === true){
                            header("Location: ./");
                        }else{
                            echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                        }
                    }else
                        echo "Don't upload GIGANTIC FILEs";
                }
            }else
                echo "This type is not accepted, please use either pdf,txt or doc";
        }
?>