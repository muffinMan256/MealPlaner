<?php

session_start();        //makes that you can use the data from this session all over the website till the session will be closed.

if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
    header("Location: ./index.php");
}

require_once '../components/db_connect.php';
require_once '../components/clean.php';

// alerts
$loginRegisterFailure = false;
$registerSuccess = false;

// LOGIN
$emailError = "";
$passwordError = "";

if (isset($_POST["login"])) {
    $email = clean($_POST["email"]);
    $password = clean($_POST["password"]);
    $error = false;

    // check if email is empty
    if (empty($email)) {
        $error = true;
        $emailError = "Please enter a email";
    }
    // check if email is valid
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email";
    }

    // check if password is empty
    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter a password";
    }

    if (!$error) {
        $password = hash("sha256", $password); //hash crypt the password

        $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) !== 0) {
            $row = mysqli_fetch_assoc($result);
            // Check if the user is blocked
            if ($row["blocked"] == 1) {
                echo "You are blocked. Please contact the administrator!";
                header("Refresh: 3; URL=../index.php");
                exit();
            }
            if ($row["status"] === "user") {
                // here you set var for the session so you can reach the datas in the session
                $_SESSION["user"] = $row["id_user"];
                $_SESSION["img"] = $row["img_user"];
                $_SESSION["name"] = $row["first_name"];
                header("Location: ../index.php");
            } else if ($row["status"] === "adm") {
                // here you set var for the session so you can reach the datas in the session
                $_SESSION["adm"] = $row["id_user"];
                $_SESSION["img"] = $row["img_user"];
                $_SESSION["name"] = $row["first_name"];
                header("Location: ../index.php");
            }
        } else {
            $loginRegisterFailure = true;
        }
    }
}

// REGISTER
$emailError = "";
$passwordError = "";
$fNameError = "";
$lNameError = "";

if (isset($_POST["register"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = clean($_POST["email"]);
    $password = clean($_POST["password"]);
    $status = "user";
    $img_user = "default_user.png";
    $blocked = 0;

    $error = false;

    // check if first_name is empty
    if (empty($first_name)) {
        $error = true;
        $fNameError = "Please enter a firstname";
    }

    // check if last_name is empty
    if (empty($last_name)) {
        $error = true;
        $lNameError = "Please enter a lastname";
    }

    // check if email is empty
    if (empty($email)) {
        $error = true;
        $emailError = "Please enter a email";
    }
    // check if email is valid
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email";
    } else {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) !== 0) {
            $error = true;
            $emailError = "Email already exists.";
        }
    }

    // check if password is empty
    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter a password";
    }
    // check if password is valid
    elseif (strlen($password) < 6) {
        $error = true;
        $passwordError = "Please enter a valid password";
    }

    if ($error === false) {
        $password = hash("sha256", $password); //hash crypt the password

        $sql = "INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `status`, `img_user`, `blocked`) VALUES ('$first_name', '$last_name', '$email', '$password', '$status', '$img_user', '$blocked')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $registerSuccess = true;
        } else {
            $loginRegisterFailure = true;
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - Login</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/login_register_styles.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
        
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- navbar -->
    <div>
        <?php
        $loc = "../";
        require_once '../components/navbar.php';
        ?>
    </div>

    <!-- new start content -->
    <div class="container" id="container">
        <!-- Sign up -->
        <div class="form-container sign-up-container">
            <form class="index-form" method="POST" enctype="multipart/form-data"
                action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                <h1 class='index-h1'>Sign up</h1>
                <!-- Input fields -->
                <input class="index-input" name="first_name" require type="text" placeholder="First Name">
                <span>
                    <?= $fNameError; ?>
                </span>

                <input class="index-input" name="last_name" require type="text" placeholder="Last Name">
                <span>
                    <?= $lNameError; ?>
                </span>

                <input class="index-input" name="email" require type="email" placeholder="Email">
                <span>
                    <?= $emailError; ?>
                </span>

                <input class="index-input" name="password" require type="password" placeholder="Password">
                <span>
                    <?= $passwordError; ?>
                </span>
                <!-- Button -->
                <button type="submit" value="Register" name="register" class="index-button">Sign Up</button>
            </form>
        </div>

        <!-- Sign in -->
        <div class="form-container sign-in-container">
            <form method="POST" class="index-form" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                <h1 class='index-h1'>Sign in</h1>
                <!-- Input fields -->
                <input class="index-input" name="email" type="email" placeholder="Email">
                <span>
                    <?= $emailError; ?>
                </span>

                <input class="index-input" name="password" type="password" placeholder="Password">
                <span>
                    <?= $passwordError; ?>
                </span>
                <!-- Button -->
                <button type="submit" value="Login" name="login" class="index-button">Sign In</button>
            </form>
        </div>

        <!-- Overlays -->
        <div class="overlay-container">
            <div class="overlay">
                <!-- Sign in Overlay -->
                <div class="overlay-panel overlay-left">
                    <h1 class='index-h1'>Welcome Back!</h1>
                    <p class="index-p">To keep connected with us please login with your personal info</p>
                    <button class="index-button ghost" id="signIn">Sign In</button>
                </div>
                <!-- Sign up Overlay -->
                <div class="overlay-panel overlay-right">
                    <h1 class='index-h1'>Hi, Visitor!</h1>
                    <p class="index-p">Enter your personal data</p>
                    <button class="index-button ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        <script src="index.js"></script>
    </div>
    <!-- end content -->

    <!-- footer -->
    <div>
        <?php
        $loc = "../";
        require_once "../components/footer.php"; ?>
    </div>

    <!-- SweetAlert Register for Success -->
    <?php if ($registerSuccess): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'New user has been created!',
                showConfirmButton: false,
                timer: 1500
            }).then(function () {
                window.location = "./login_register.php";
            });
        </script>
    <?php endif; ?>

    <!-- SweetAlert Register for Failure -->
    <?php if ($loginRegisterFailure): ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            }).then(function () {
                window.location = "./login_register.php";
            });
        </script>
    <?php endif; ?>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>