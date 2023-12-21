<?php
session_start();
    
require_once '../components/db_connect.php';

// Check if a category filter is set
$categoryFilter = isset($_GET['categories']) ? $_GET['categories'] : '';

$user_id = "";
$cardsMon = $cardsTue = $cardsWed = $cardsThu = $cardsFri = $cardsSat = $cardsSun = "";
// get the if of the user which is logged in
if(isset($_SESSION["user"])){
    $user_id = $_SESSION["user"];
} 
// get the id of the adm which is logged in
elseif(isset($_SESSION["adm"])){
    $user_id = $_SESSION["adm"];  
}
// if your not logged in, redirect to index.php
else{
    header("Location: ./index.php");
}

$sql = "SELECT * FROM `planner`
        INNER JOIN `recipes` ON planner.fk_recipe_id = recipes.id_recipe
        INNER JOIN `user` ON planner.fk_user_id = user.id_user
        WHERE `fk_user_id` = '$user_id'";

// Include the category filter in the SQL query
if (!empty($categoryFilter) && $categoryFilter !== 'All Categories') {
    $sql .= " AND recipes.categories = '$categoryFilter'";
}
$result = mysqli_query($connection, $sql);    
$card = "You have no recipes choosen";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $dayClass = strtolower($row['week_day']);

        $card = "

            <div class='card text-center mb-3 $dayClass'>
                <div class='card-body'>
                    <h6 class='card-title'>" . htmlspecialchars($row['name_recipe']) . "</h6>
                    <a class='btn btn-custom-info btn-outline-dark' href='../recipes/details.php?id=" . htmlspecialchars($row['id_recipe']) . "' data-bs-toggle='tooltip' data-bs-placement='top' title='" . htmlspecialchars($row['name_recipe']) . "'><i class='fa-solid fa-info'></i></a>
                    <a class='btn btn-custom-danger btn-outline-dark' href='../meal_planer/delete_meal_planer.php?id=" . htmlspecialchars($row['id_planner']) . "' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete from Meal Planer'><i class='fa-solid fa-trash'></i></a>
                </div>
                </div>
        ";
        switch ($row['week_day']) {
            case "Monday":
                $cardsMon .= $card;
                break;
            case "Tuesday":
                $cardsTue .= $card;
                break;
            case "Wednesday":
                $cardsWed .= $card;
                break;
            case "Thursday":
                $cardsThu .= $card;
                break;
            case "Friday":
                $cardsFri .= $card;
                break;
            case "Saturday":
                $cardsSat .= $card;
                break;
            case "Sunday":
                $cardsSun .= $card;
                break;
        }
    }
} else {
    $cardsMon = $card;
    $cardsTue = $card;
    $cardsWed = $card;
    $cardsThu = $card;
    $cardsFri = $card;
    $cardsSat = $card;
    $cardsSun = $card;
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - Your Plan</title>
    <!-- bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/meal_planer_styles.css">
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
    $loc = "../";
    require_once "../components/navbar.php"; ?>

    <!-- start content -->

      <!-- Category filter form/links -->
   <div class="container mt-3">
    <form method="get" action="">
      <label for="categoryFilter">Filter by Category:</label>
      <select style="width: 10%;" class="form-select" name="categories" id="categoryFilter" onchange="this.form.submit()">
        <option  value=""></option>
        <option value="">All Categories</option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
        <option value="Meat">Meat</option>
        <option value="Vegetarian">Vegetarian</option>
        <option value="Vegan">Vegan</option>
        <option value="Dessert">Dessert</option>
    
        <!-- Add more category options as needed -->
      </select>
    </form>
  </div>
    <div class="justify-content-center d-flex">
        <div class="row mt-3 justify-content-center ">
            <!-- Monday -->
            <div class="text-center" style="width: 20vh">
                <h3>Monday</h3>
                <?= $cardsMon; ?>
            </div>
            <!-- Tuesday -->
            <div class="text-center" style="width: 20vh">
                <h3>Tuesday</h3>
                <?= $cardsTue; ?>
            </div>
            <!-- Wednesday -->
            <div class="text-center" style="width: 20vh">
                <h3>Wednesday</h3>
                <?= $cardsWed; ?>
            </div>
            <!-- Thursday -->
            <div class="text-center" style="width: 20vh">
                <h3>Thursday</h3>
                <?= $cardsThu; ?>
            </div>
            <!-- Friday -->
            <div class="text-center" style="width: 20vh">
                <h3>Friday</h3>
                <?= $cardsFri; ?>
            </div>
            <!-- Saturday -->
            <div class="text-center" style="width: 20vh">
                <h3>Saturday</h3>
                <?= $cardsSat; ?>
            </div>
            <!-- Sunday -->
            <div class="text-center" style="width: 20vh">
                <h3>Sunday</h3>
                <?= $cardsSun; ?>
            </div>
        </div>
    </div>
  <!-- end content -->

  <!-- footer -->
  <?php 
  $loc = "../";
  require_once "../components/footer.php"; ?>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>



 