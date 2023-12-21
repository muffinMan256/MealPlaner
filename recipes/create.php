<?php
session_start();

$user_id = "";

// get the recipes of the user which is logged in
if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
}
// get the recipes of the user which is logged in
elseif (isset($_SESSION["adm"])) {
    $user_id = $_SESSION["adm"];
}
// if your not logged in, redirect to index.php
else {
    header("Location: ./index.php");
}

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";

// alerts
$createSuccess = false;
$createFailure = false;

if (isset($_POST["create"])) {

    $name_recipe = $_POST["name_recipe"];
    $description = $_POST["description"];
    $img_recipe = fileUpload($_FILES["picture"], "recipes");
    $prepTime = $_POST["prepTime"];
    $calories = $_POST["calories"];
    $proofed = false;
    $categories = $_POST["categories"];
    $ingredients = $_POST["ingredients"];


    $sql = "INSERT INTO `recipes`(`name_recipe`, `description`, `img_recipe`, `prepTime`, `calories`, `proofed`, `categories`, `fk_user`, `ingredients`) 
                VALUES ('$name_recipe','$description','$img_recipe[0]','$prepTime',$calories,'$proofed', '$categories', '$user_id', '$ingredients')";

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
    <title>Create Recipe</title>
    <!--bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/create_styles.css">
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
    <section class="login-container mt-5">
        <div class="login-box">
            <h2>Create a new Recipe</h2>
            <form id="formID" class="row justify-content-center form" action="" method="POST" enctype="multipart/form-data">
                <!-- picture -->
                <div class="user-box">
                    <h6 style="color:azure">Image</h6>
                    <input type="file" name="picture" placeholder="Picture">
                </div>
                <!-- categories -->
                <div class="user-box mb-3">
                    <h6 style="color:azure">Category</h6>
                    <select class="form-select" required type="text" name="categories">
                        <?php
                        $allCategories = ["Vegan", "Vegetarian", "Meat", "Dessert", "Breakfast", "Lunch", "Dinner"];
                        foreach ($allCategories as $category) {
                            $selected = ($category == $row["categories"]) ? 'selected' : '';
                            echo '<option ' . $selected . '>' . htmlspecialchars($category) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- name_recipe -->
                <div class="user-box">
                    <input type="text" name="name_recipe" required>
                    <label>Recipe Title</label>
                </div>
                <!-- prepTime -->
                <div class="user-box">
                    <input type="text" name="prepTime" required>
                    <label>Preparation Time in Minutes</label>
                </div>
                <!-- calories -->
                <div class="user-box">
                    <input type="text" name="calories" required>
                    <label>Calories</label>
                </div>
                <!-- description -->
                <div class="user-box">
                    <input type="textarea" name="description" required>
                    <label>Description</label>
                </div>
                <!-- ingredients -->
                <div class="user-box">
                    <input type="textarea" name="ingredients" required>
                    <label>Ingredients</label>
                </div>
                <!-- create button -->
                <input type="submit" value="Create Recipe" name="create" class="btn btn-custom-gradient my-3">
            </form>
        </div>
    </section>
    <!-- end content -->

    <!-- footer -->
    <?php
    $loc = "../";
    require_once "../components/footer.php"; ?>

    <!-- SweetAlert for Success -->
    <?php if ($createSuccess) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'New recipe has been created!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "./recipes_dashboard.php";
            });
        </script>
    <?php endif; ?>

    <!-- SweetAlert for Failure -->
    <?php if ($createFailure) : ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            }).then(function() {
                window.location = "../index.php";
            });
        </script>
    <?php endif; ?>

    <!--bootstrap css  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- duration picker -->
    <script src="src/src/jquery-duration-picker.js"></script>
    <script>
        var createButton = document.getElementById('createButton');

        // Attach a click event listener to the createButton
        createButton.addEventListener('click', function(event) {
            // Prevent the default behavior of the anchor tag
            event.preventDefault();
            // Trigger the form submission when the createButton is clicked
            document.getElementById('formID').submit();
        });
    </script>
</body>

</html>