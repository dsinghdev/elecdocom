<?php
    session_start();
    require_once('../server/connection.php');
    $stID = $_SESSION['id'];
    $sql = "SELECT `student_FIRST_NAME` , `student_LAST_NAME` FROM `student_record` WHERE `student_ID` = '${stID}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $studentName = $data['student_FIRST_NAME'] . " " . $data['student_LAST_NAME'] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image" href="img/favicon.ico">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
        <img src="img/elecdocom.png" alt="logo"><br><br><br>
            <h1 class="center">
                Set a Proposal
            </h1>
            <small class="right">Welcome<h5><?php echo $studentName ?></h5></small>
        </div>
        <a href="./" class="btn btn-primary mb-3">Go Back</a>
        <section class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="text" name="title" class="form-control col-5" placeholder="Proposal Title" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="number" name="batch" class="form-control col-6" placeholder="Student semester" required >
                </div>
                <div class="form-group row">
                    <input type="text" name="course" class="form-control col-5" placeholder="Student branch" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="text" readonly class="form-control col-6" placeholder="Your Student ID is: <?php echo $stID?>">
                </div>
                <div class="form-group row">
                    <input type="date" name="pdate" class="form-control col-5" placeholder="Proposal Date" required>
                    &emsp;&emsp;&emsp;&emsp;&emsp;

                 </div>
                <div class="form-group row">
                    <label for="hod" class="col-1 col-form-label">SEND TO</label>
                    <select name="hod" class="col-5 form-control">
                        <?php
                            $sql = "SELECT `hod_ID` , `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record`;";
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
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <input type="submit" name="propose" value="Propose" class="btn btn-outline-primary right">
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
                        $sql = "INSERT INTO `project_record` (`project_ID`, `student_ID`, `hod_ID`, `project_TITLE`, `project_date`, `project_PROFESSOR`, `project_BATCH`, `project_COURSE`, `project_COMMENT`, `project_STATUS`, `project_file`) VALUES (NULL, '${stID}', '${hod}', '${title}', '${pdate}', NULL, '${batch}', '${course}', NULL, '0', '${document}')";
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