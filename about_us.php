<?php
session_start();

require_once "components/db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Planer - Contact us</title>
  <!-- Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Swiper CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- CSS navbar -->
  <link rel="stylesheet" href="./css/navbar_styles.css">
  <!-- CSS contact us -->
  <link rel="stylesheet" href="./css/contact_us_styles.css">
  <!-- CSS footer -->
  <link rel="stylesheet" href="./css/footer_styles.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./css/recipes_styles.css">
  <!-- CSS about us -->
  <link rel="stylesheet" href="./css/about_us_styles.css">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- fonts -->
  <link rel="preconnect" href="http://fonts.googleapis.com">
  <link rel="preconnect" href="http://fonts/gstatic.com" crossorigin>
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
  <?php
  $loc = "";
  require_once "components/navbar.php"; ?>
  <!-- End navbar -->



  <!-- Start About us -->
  <section class="about">
    <div class="main">
      <img src="images/group.jpeg">
      <div class="about-text">
        <h1>About Us</h1>
        <h5>Backend & Frontend </h5>
        <p>A dynamic collaboration unfolded as a team of two backenders and three frontenders tackled a challenging
          group project. Despite facing hurdles, their combined expertise and dedication prevailed. The journey, marked
          by continuous communication and innovative problem-solving, culminated in success. The diverse skills of each
          team member harmonized, resulting in a triumphant completion of the project, showcasing the power of
          collaboration and resilience in overcoming obstacles.</p>
      </div>

    </div>

    <div>
      <div class="hero">

        <div class="swiper mySwiper" style="padding-top:5rem" style="padding-bottom:5rem">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60/">
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1493770348161-369560ae357d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjN8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://plus.unsplash.com/premium_photo-1663852705829-aa8707495e2e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjF8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
            <div class="swiper-slide">
              <img
                src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjV8fGZvb2R8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60" />
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
  </section>




  <!-- Start Footer -->
  <?php
  $loc = "";
  require_once "components/footer.php"; ?>
  <!-- End Footer -->

  </script>
  <!-- Swiper Script-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- Bootstrap Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- Custom js file link-->
  <script src="components/js/script.js"></script>
  <!-- Slider -->
  <script src="main.js"></script>
</body>

</html>