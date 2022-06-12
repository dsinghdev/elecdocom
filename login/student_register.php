<?php
    session_start();
    require_once('../server/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <img src="img/elecdocom.png" alt="logo"><br><br><br>
            <h1 class="center">STUDENT REGISTRATION</h1>
        </div>
       
        <nav>
            <span class="right"><h5><a href="./hod_login.php"> Authority Sign In</a></h5></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="studentFName" class="left"><b>Student First Name</b></label>
                    <input type="text" name="studentFName" class="form-control" id="studentFName" required>
                </div>
                <div class="form-group">
                    <label for="studentLName" class="left"><b>Student Last Name</b></label>
                    <input type="text" name="studentLName" class="form-control" id="studentLName" required>
                </div>
                <div class="form-group">
                    <label for="studentEmail" class="left"><b>Student Email</b></label>
                    <input type="email" name="studentEmail" class="form-control" id="studentEmail" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left"><b>Password</b></label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="left">
                    <a href="./student_login.php" class="btn btn-outline-secondary">Sign In</a>
                </div>
                <div class="right">
                    <input type="submit" name='register' value="Sign Up" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <br><br><br>
        <?php
            if(isset($_POST['register'])){
                $fName = $_POST['studentFName'];
                $lName = $_POST['studentLName'];
                $email = $_POST['studentEmail'];
                $pwd = $_POST['pwd'];
                $sql = "INSERT INTO `student_record` (`student_ID`, `student_EMAIL`, `student_FIRST_NAME`, `student_LAST_NAME`, `student_PASSWORD`) VALUES (NULL, '${email}', '${fName}', '${lName}', '${pwd}')";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'student';
                    $_SESSION['fname'] = $fName;
                    $_SESSION['lname'] = $lName;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $last_id;
                    echo '<div class="alert alert-success center" role="alert">Account Created Successfully, Your ID is: '.$_SESSION['id'].'</div>';
                    echo '<div class="alert alert-success center" role="alert">Your Application is Now waiting for Approval by HOD</div>';
                } else {
                    echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>
