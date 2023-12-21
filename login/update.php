<?php
    session_start();        
    
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ./index.php");
        exit();
    }

    // if you an adm then you get the choosen id from a user you want to change via dashboard
    if(isset($_SESSION["adm"])){
        $id_user = $_GET["id"]??$_SESSION["adm"];
    } else{
        $id_user = $_SESSION["user"];
    }

    require_once '../components/db_connect.php';
    require_once '../components/clean.php';
    require_once '../components/file_upload.php';

    $emailError = "";
    $passwordError = "";
    $fNameError = "";
    $lNameError = "";
    $error = "";

    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    $sql = "SELECT * FROM user WHERE `id_user` = $id_user";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["update"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = clean($_POST["email"]);    
        $password = clean($_POST["password"]);
        $img_user = fileUpload($_FILES["img"]);

        $error = false;
         // check if first_name is empty
         if(empty($first_name)) {     
            $error = true;
            $fNameError = "Please enter a firstname";
        } 

        // check if last_name is empty
        if(empty($last_name)) {     
            $error = true;
            $lNameError = "Please enter a lastname";
        } 
        
        // check if email is empty
        if(empty($email)) {     
            $error = true;
            $emailError = "Please enter a email";
        } 
        // check if email is valid
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {    
            $error = true;
            $emailError = "Please enter a valid email";
        }

        // check if password is empty
        if(empty($password)) { 
            $error = true;
            $passwordError = "Please enter a password";
        } 
        // check if password is valid
        elseif(strlen($password) < 6) { 
            $error = true;
            $passwordError = "Please enter a valid password";
        }

        if($error === false) {
            $password = hash("sha256", $password); //hash crypt the password

            if($_FILES["img"]["error"] == 0){
                if($row["img_user"] !== "default_user.png"){
                    unlink("../images/$row[img_user]");
                }
                $sql = "UPDATE `user` SET `first_name`='$first_name', `last_name` = '$last_name', `img_user`='$img_user[0]',`email`='$email',`password`='$password' WHERE id_user = $id_user";
            }
            else{
                $sql = "UPDATE `user` SET `first_name`='$first_name', `last_name` = '$last_name', `email`='$email',`password`='$password' WHERE id_user = $id_user";
            }

            $result = mysqli_query($connection, $sql);
            if($result) {
                // show the new image if updated
                $sql = "SELECT * FROM user WHERE `id_user` = $id_user";
                $result = mysqli_query($connection,$sql);
                $row = mysqli_fetch_assoc($result);
                
                if (isset($_SESSION["user"]) || ($_SESSION["adm"])) {
                    $_SESSION["img"] = $row["img_user"];
                    $_SESSION["name"] = $row["first_name"];
                }
                $updateSuccess = true;
            }else  {
                $updateFailure = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/update_user_styles.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
</head>
<body>
    <!-- navbar -->
    <?php
    $loc="../";
    require_once '../components/navbar.php'; 
    ?>  

    <!-- start content -->
    
        <div class="login-box container d-flex justify-content-center mt-5">
            <div class="formUser">   
            <h2 class="text-center mb-4 mt-2">Update your Profile</h2> 
                <form method="post" enctype="multipart/form-data" class="">
                <div class = "row">
                    <div class = "col-md-6 mb-3"> 
                            <h5>First Name</h5>
                            <input required type="text" name="first_name" class="form-control" value="<?= $row["first_name"]; ?>">
                            <span><?= $fNameError; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                            <h5>Last Name</h5>
                            <input required type="text" name="last_name" class="form-control" value="<?= $row["last_name"]; ?>">
                            <span><?= $lNameError; ?></span>
                    </div>  
                </div>

                <div class = "row">
                <div class = "col-md-6 mb-3">    
                        <h5>E-Mail</h5>
                        <input type="email" name="email" class="form-control" value="<?= $row["email"]; ?>">
                        <span><?= $emailError; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Password</h5>
                        <input type="password" name="password" class="form-control">
                        <span><?= $passwordError; ?></span>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="mb-3">
                            <h5>Picture</h5>
                            <input type="file" name="img" class="form-control">
                        </div>
                        <div class="buttonForm">
                            <button type="submit" name="update" class="btn btn-custom-danger btn-outline-dark mt-3">
                                <i class='fa-solid fa-pen-nib'></i> Update
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>          
        </div>
    <!-- end content -->

    <!-- footer -->
    <?php 
    $loc = "../";
    require_once "../components/footer.php"; ?>

    <!-- SweetAlert for Success -->
    <?php if ($updateSuccess): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Update successful',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location = "../index.php";
        });
    </script>
    <?php endif; ?>
    
    <!-- SweetAlert for Failure -->
    <?php if ($updateFailure): ?> 
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
        }).then(function() {
            window.location = "./update.php"; 
        });
    </script>
    <?php endif; ?>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>