<?php

session_start();

require_once "components/db_connect.php";

$user_name = "";

// get the id of the user which is logged in
if (isset($_SESSION["user"])) {
  $user_name = " " . $_SESSION["name"];
}
// get the id of the adm which is logged in
elseif (isset($_SESSION["adm"])) {
  $user_name = " " . $_SESSION["name"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meal Planer</title>
  <!-- bootstrap CSS  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- CSS navbar -->
  <link rel="stylesheet" href="./css/navbar_styles.css">
  <!-- swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <!-- CSS footer -->
  <link rel="stylesheet" href="./css/footer_styles.css">
  <!-- CSS -->
  <link rel="stylesheet" href="./css/index_styles.css">
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
  <?php
  $loc = "";
  require_once "components/navbar.php"; ?>

  <!-- start content -->
  <div class="hero3">
    <div class="hero-text">
      <h1 style="font-size:50px">Hello<?= $user_name ?>!
      </h1>
      <p class="">Enjoy Your time making delicious meals!</p>
    </div>
  </div>

  <!-- (hero2) -->
  <div class="hero2">
    <section class="home-how ">
      <div class="container-section d-flex justify-content-between row-cols-3-xxl row-cols-2-md row-cols-1-xs">
        <header class="title-area">
          <h2></h2>
        </header>

        <div class="home-how__row how-block-row">
          <article class="how-block">
            <div class="how-block__inside">
              <figure class="how-block__image">
                <img src="images/logo4_index.png" data-srcset=" " width="250px" height="225px" alt="Choose Your Meals"
                  class=" lazyloaded" srcset="" src="">
              </figure>
              <header class="how-block__head ">
                <div class="how-block__head-svg">
                  <svg width="38px" height="38px" viewBox="0 0 38 38" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>number-1</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Desktop---eMeals-Homepage-E1" transform="translate(-153.000000, -1200.000000)">
                        <g id="How-it-Works" transform="translate(139.000000, 811.000000)">
                          <g id="1" transform="translate(0.000000, 114.000000)">
                            <g id="Group" transform="translate(14.000000, 275.000000)">
                              <g id="number-1">
                                <circle id="Oval" fill="#e55934" cx="19" cy="19" r="19"></circle>
                                <text id="1" font-family="Poppins-Medium, Poppins" font-size="20" font-weight="400"
                                  fill="#FFFFFF">
                                  <tspan x="16" y="26">1</tspan>
                                </text>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>

                <div>
                  <h5 data-uw-rm-heading="level" role="heading" aria-level="3">Plan Your Meals</h5>
                </div>
              </header>

              <div class="how-block__content">
                <p>Discover flexibility in our weekly meal plans. Choose recipes that match your tastes and needs.
                  Diverse
                  options cater to your preferences, ensuring a personalized and enjoyable dining experience.</p>
              </div>
            </div>
          </article>

          <article class="how-block">
            <div class="how-block__inside">
              <figure class="how-block__image">
                <img src="images/logo1_index.png" data-srcset="" width="250px" height="225px" alt="Get Your Groceries"
                  class=" lazyloaded" srcset=" " src="">
              </figure>

              <header class="how-block__head">
                <div class="how-block__head-svg">
                  <svg width="38px" height="38px" viewBox="0 0 38 38" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>number-2</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Desktop---eMeals-Homepage-E1" transform="translate(-572.000000, -1200.000000)">
                        <g id="How-it-Works" transform="translate(139.000000, 811.000000)">
                          <g id="2" transform="translate(416.000000, 114.000000)">
                            <g id="Group-5" transform="translate(17.000000, 275.000000)">
                              <g id="number-2">
                                <circle id="Oval" fill="#f77f00" cx="19" cy="19" r="19"></circle>
                                <text id="2" font-family="Poppins-Medium, Poppins" font-size="20" font-weight="400"
                                  fill="#FFFFFF">
                                  <tspan x="13" y="26">2</tspan>
                                </text>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>

                <div>
                  <h5 data-uw-rm-heading="level" role="heading" aria-level="4">Choose Your Ingredients</h5>
                </div>
              </header>

              <div class="how-block__content">
                <p>Craft your culinary journey with the freedom to choose your ingredients. Select fresh, quality
                  components to create meals that cater to your unique taste and preferences.</p>
              </div>

            </div>

          </article>

          <article class="how-block">

            <div class="how-block__inside">

              <figure class="how-block__image">
                <img src="images/logo5_index.png" data-srcset=" " width="250px" height="225px"
                  alt="Enjoy Delicious Meals" class=" lazyloaded" srcset="" src="">
              </figure>

              <header class="how-block__head">

                <div class="how-block__head-svg">
                  <svg width="38px" height="38px" viewBox="0 0 38 38" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>number-3</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="Desktop---eMeals-Homepage-E1" transform="translate(-949.000000, -1200.000000)">
                        <g id="How-it-Works" transform="translate(139.000000, 811.000000)">
                          <g id="3" transform="translate(809.000000, 114.000000)">
                            <g id="Group-7" transform="translate(1.000000, 275.000000)">
                              <g id="number-3">
                                <circle id="Oval" fill="#efca08" cx="19" cy="19" r="19"></circle>
                                <text id="3" font-family="Poppins-Medium, Poppins" font-size="20" font-weight="400"
                                  fill="#FFFFFF">
                                  <tspan x="13" y="26">3</tspan>
                                </text>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>

                <div>
                  <h5>Enjoy Your Food!</h5>
                </div>

              </header>
              <div class="how-block__content">
                <p>Savor every bite and relish the delightful flavors. Enjoy your food, a symphony of tastes that brings
                  joy to your palate and nourishes your body with pleasure.</p>
              </div>
            </div>
          </article>
        </div>

        <div class="home-how__button">
          <a href="/account/start.php" class="btn btn--orange"></a>
        </div>
      </div>
    </section>
  </div>

  <!-- grid section -->
  <div class="container-grid">

    <div class="container1">
      <div class="container">
        <img src="images/first.png" class="image" />

        <a href="recipes.php" class="middle">
          <div class="text">Vegan</div>
        </a>
      </div>
    </div>

    <div class="container2">
      <div class="container">
        <img src="images/vegetarian.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Vegetarian</div>
        </a>
      </div>
    </div>

    <div class="container3">
      <div class="container">
        <img src="images/third.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Meat</div>
        </a>
      </div>
    </div>

    <div class="container4">
      <div class="container">
        <img src="images/dessert.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Desert</div>
        </a>
      </div>
    </div>

    <div class="container5">
      <div class="container">
        <img src="images/breakfast.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Breakfast</div>
        </a>
      </div>
    </div>

    <div class="container6">
      <div class="container">
        <img src="images/sixth.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Lunch</div>
        </a>
      </div>
    </div>

    <div class="container7">
      <div class="container">
        <img src="images/seventh.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Dinner</div>
        </a>
      </div>
    </div>

    <div class="container8">
      <div class="container">
        <img src="images/eight.png" alt="Avatar" class="image" />

        <a href="recipes.php" class="middle">
          <div class="text">Vegan</div>
        </a>
      </div>
    </div>

    <div class="container9">
      <div class="container">
        <img src="images/ninth.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Lunch</div>
        </a>
      </div>
    </div>

    <div class="container10">
      <div class="container">
        <img src="images/desssert.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Dessert</div>
        </a>
      </div>
    </div>

    <div class="container11">
      <div class="container">
        <img src="images/second.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Dinner</div>
        </a>
      </div>
    </div>

    <div class="container12">
      <div class="container">
        <img src="images/vege.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Vegetarian</div>
        </a>
      </div>
    </div>

    <div class="container13">
      <div class="container">
        <img src="images/thirteenth.png" alt="Avatar" class="image" />
        <a href="recipes.php" class="middle">
          <div class="text">Meat</div>
        </a>
      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- end banner -->
  <div class="custom-hero-image">
    <div class="custom-hero-text">
      <h1>Meal Planner Makes Planning Dinner Easy and Fun</h1>
      <p>Enjoy preparing your meals!</p>

    </div>
  </div>
  <!-- end content -->

  <!-- footer -->
  <?php
  $loc = "";
  require_once "components/footer.php"; ?>

  <!-- SweetAlert for Delete Success -->
  <?php if (isset($_GET['delete']) && $_GET['delete'] == 'success'): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Recipe deleted successfully.',
      });
    </script>
  <?php endif; ?>
  <!-- SweetAlert for Delete Error -->
  <?php if (isset($_GET['delete']) && $_GET['delete'] == 'error'): ?>
    <script>
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
      });
    </script>
  <?php endif; ?>

  <!--bootstrap css  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="main.js"></script>
</body>

</html>