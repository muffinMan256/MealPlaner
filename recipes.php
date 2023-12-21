<?php
session_start();

require_once 'components/db_connect.php';


// Check if a category filter is set
$categoryFilter = isset($_GET['categories']) ? $_GET['categories'] : '';


$sql = "SELECT * FROM `recipes`";
if (!empty($categoryFilter)) {
  $sql .= " WHERE categories = '$categoryFilter'";
}
$result = mysqli_query($connection, $sql);
$cards = "";

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    $cards .= "
    <section class='team-section'>
    <div class=''>
        <div class='row justify-content-center'>
            <div class=''>
                <div class='card border-0 shadow-lg pt-5 my-5 position-relative'>
                    <div class='card-body p-4'>
                    <div class='member-profile w-100 text-center'>
                    <img class='rounded-circle mb-2 d-inline-block shadow-sm' src='images/{$row["img_recipe"]}' alt='{$row["name_recipe"]}'>
                </div> 
                        <div class='card-text pt-1'>
                        <h5 class='member-name mt-5 mb-3 text-center text-primary font-weight-bold'>{$row["name_recipe"]}</h5>
                        <div class='mb-3 text-center'>Preparation Time: $row[prepTime]</div>
                        </div>
                    </div><!--//card-body-->
                    <div class='card-footer theme-bg-primary border-0 text-center'>
                        <ul class='social-list list-inline mb-0 mx-auto'>
                                
                        <a href='recipes/details.php?id=$row[id_recipe]' class='btn btn-outline-success mb-3'><i class='fa-solid fa-circle-info'></i> &nbsp; read more...</a></br>
                            
                            ";

    // if user show his recipes and buttons  
    // we dont need to show the use if it the recipe is proofed - show it only if and when the admin proofed id
    if (isset($_SESSION["user"])) {
      $cards .= "
      
      <a href='#' onclick='addToPlaner($row[id_recipe]);' class='btn btn-outline-warning'><i class='fa-solid fa-plus'></i> &nbsp; Add to planer</a>
      
                                ";
    }
    // if admin show the recipes to proof and proofed checkbox
    if (isset($_SESSION["adm"])) {
      $cards .= "
                              
      <a href='#' onclick='addToPlaner($row[id_recipe]);' class='btn btn-outline-warning'><i class='fa-solid fa-plus'></i> &nbsp; Add to planer</a>
      
                                
                                ";
    }
    $cards .= "
                            </ul>
                            </div><!--//card-footer-->
                        </div><!--//card-->
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//container-->
        </section>";
  }
} else {
  $cards = "no data found";
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Planer - Recipes</title>
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

  <!-- start Hero -->
  <div class="heading">
    <div class="wrapper">
      <div class="typing-demo">
        Welcome to our Recipes.
      </div>
    </div>
    <img src="images/pile22.png" class="slika" alt="">
  </div>
  <!-- end Hero -->

  <!--Category-->

  <section class="categories container">
    <!-- Add a form or links to filter recipes by category -->
    <div class="category-filter">
      <div class="category-title">
        <h2>Categories</h2>
        <a href="?categories=" class="category-btn">View all Categories</a>
      </div>
      <div class="category-cards column">
        <a href="?categories=Breakfast" class="cat-card">
          <img src="images/croissant.png" alt="">
          <h6>Breakfast</h6>
        </a>
        <a href="?categories=Vegan" class="cat-card">
          <img src="images/broccoli.png" alt="">
          <h6>Vegan</h6>
        </a>
        <a href="?categories=Meat" class="cat-card">
          <img src="images/steak.png" alt="">
          <h6>Meat</h6>
        </a>
        <a href="?categories=Vegetarian" class="cat-card">
          <img src="images/cheese-148351_1280.png" alt="">
          <h6>Vegetarien</h6>
        </a>
        <a href="?categories=Dessert" class="cat-card">
          <img src="images/cherry.png" alt="">
          <h6>Dessert</h6>
        </a>
        <a href="?categories=Lunch" class="cat-card">
          <img src="images/burger.png" alt="">
          <h6>Lunch</h6>
        </a>
        <a href="?categories=Dinner" class="cat-card">
          <img src="images/sushi.png" alt="">
          <h6>Dinner</h6>
        </a>
      </div>
    </div>
    </div>



  </section>
  <!-- end Category -->



  <!-- recipes cards -->
  <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
    <?= $cards; ?>
  </div>
  <!-- recipes cards -->



  <!-- footer -->
  <?php
  $loc = "";
  require_once "components/footer.php"; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] == 'error') : ?> <script>
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085D6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    </script>
  <?php endif; ?>

  <!-- Swiper Script-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- Bootstrap Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="meal_planer/add_to_planer.js"></script>
  <!-- Custom js file link-->
  <script src="components/js/script.js"></script>

</body>

</html>