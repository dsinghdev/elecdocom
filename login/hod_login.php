<?php
    session_start();
    require_once('../server/connection.php');
    require_once("../header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <img src="img/elecdocom.png" alt="logo"> <br><br><br>
            <h1 class="center">AUTHORITY LOGIN</h1>
            
        </div>
        <nav>
            <span class="right"><h5>If you are a student then login <a href="./student_login.php"> <b>HERE</b></h5></a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="hodID" class="left"><h5>Authority ID,</h5></label>
                    <input type="number" name="hodID" class="form-control" id="hodID" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left"><h5>Password</h5></label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="right">
                    <input type="submit" name="login" value="Login" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <br><br><br>
        <?php
            if(isset($_POST['login'])){
                $id = $_POST['hodID'];
                $pwd = $_POST['pwd'];
                $sql = "SELECT *  FROM `hod_record` WHERE `hod_ID` = ${id} AND `hod_PASSWORD` = '${pwd}'";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows == 1){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'hod';
                    $_SESSION['id'] = $id;
                    header("Location: ./../hod/");
                } else {
                    echo '<div class="alert alert-danger center" role="alert">HoD with this credentials wasn\'t found</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>