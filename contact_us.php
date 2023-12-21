<?php
session_start();



require_once "components/db_connect.php";

// alerts
$createSuccess = false;
$createFailure = false;

if (isset($_POST["send"])) {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $message = $_POST["message"];



    $sql = "INSERT INTO `contact_messages`(`first_name`, `last_name`, `email`, `mobile`, `message`) VALUES ('$first_name','$last_name','$email','$mobile','$message')";


    if (mysqli_query($connection, $sql)) {
        $createSuccess = true;
    } else {
        $createFailure = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - Contact us</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Swiper CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- CSS navbar -->
    <link rel="stylesheet" href="./css/navbar_styles.css">

    <!-- CSS footer -->
    <link rel="stylesheet" href="./css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/recipes_styles.css">
    <!-- CSS contact us -->
    <link rel="stylesheet" href="./css/contact_us_styles.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- navbar -->
    <?php
    $loc = "";
    require_once "components/navbar.php"; ?>
    <!-- End navbar -->


    <!-- Start Form -->

    <div class="contactUs">
        <div class="title">
            <h2>Get in Touch</h2>
        </div>
        <div class="box">
            <div class="contact form">
                <h3>Send a Message</h3>
                <form method="POST">
                    <div class="formBox">
                        <div class="row50">
                            <div class="inputBox">
                                <span>First Name</span>
                                <input name="first_name" type="text" placeholder="John">
                            </div>
                            <div class="inputBox">
                                <span>Last Name</span>
                                <input name="last_name" type="text" placeholder="Doe">
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Email</span>
                                <input name="email" type="text" placeholder="john@email.com">
                            </div>
                            <div class="inputBox">
                                <span>Mobile</span>
                                <input name="mobile" type="text" placeholder="+91 987 654 3210">
                            </div>
                        </div>
                        <div class="row100">
                            <div class="inputBox">
                                <span>Message</span>
                                <textarea name="message" placeholder="Write your message here..."></textarea>
                            </div>
                        </div>
                        <div class="row100">
                            <div class="inputBox">
                                <input name="send" type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--info box-->
            <div class="contact info">
                <h3>Contact Info</h3>
                <div class="infoBox">
                    <div>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                        <p>1010 Karlsplatz, Vienna <br></p>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:loremipsum@email.com">info@example.com</a>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:+91 987 654 3210">+66 987 654 3210</a>
                    </div>
                    <!--Social Media Links -->
                    <ul class="sci">
                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-square-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- Map -->
            <div class="contact map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d170130.20893932588!2d16.214868852939674!3d48.220395795811484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d079e5136ca9f%3A0xfdc2e58a51a25b46!2sWien!5e0!3m2!1sde!2sat!4v1702588984638!5m2!1sde!2sat" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <!-- End Form -->

    <!-- Start Footer -->
    <?php
    $loc = "";
    require_once "components/footer.php"; ?>
    <!-- End Footer -->

    </script>
    <!-- Swiper Script-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Bootstrap Script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Custom js file link-->
    <script src="components/js/script.js"></script>


    <?php if ($createSuccess) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thank you for your message,we will write to you soon!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "contact_us.php";
            });
        </script>
    <?php endif; ?>

    <!-- SweetAlert Register for Failure -->
    <?php if ($createFailure) : ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            }).then(function() {
                window.location = "contact_us.php";
            });
        </script>
    <?php endif; ?>



</body>

</html>