<?php
    session_start();

    $user_id ="";

    // get the recipes of the user which is logged in
    if(isset($_SESSION["user"])){
        $user_id = $_SESSION["user"];
        
    } 
    // get the recipes of the user which is logged in
    elseif(isset($_SESSION["adm"])){
        $user_id = $_SESSION["adm"];  
    }
    // if your not logged in, redirect to index.php
    else{
        header("Location: ./index.php");
    }

    require_once "../components/db_connect.php";
    require_once "../components/file_upload.php";

    // alerts
    $updateSuccess = false;
    $updateFailure = false;

    // get the recipe
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id_recipe = $_GET["id"];
        $sql = "SELECT * FROM `recipes` WHERE `id_recipe` = $id_recipe";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
    }

    // update the recipe
    if(isset($_POST["update"])) {
        $name_recipe = $_POST["name_recipe"];
        $description = $_POST["description"];
        $img_recipe = fileUpload($_FILES["picture"], "recipes");
        $prepTime = $_POST["prepTime"];
        $calories = $_POST["calories"];
        $proofed = false;
        $categories = $_POST["categories"];
        $ingredients = $_POST["ingredients"];
        $fk_user = $user_id; // Assuming you have a valid user session
    
    if($_FILES["picture"]["error"] == 0) {
            if($row["img_recipe"] !== "product.png"){
                unlink("../images/$row[img_recipe]");
            }
            $sql = "UPDATE `recipes` 
            SET `name_recipe`= '$name_recipe', 
            `description`='$description', 
            `img_recipe`='$img_recipe[0]', 
            `prepTime`='$prepTime', 
            `calories`=$calories, 
            `proofed`='$proofed',
            `categories` = '$categories',
            `ingredients` = '$ingredients', 
            `fk_user`= $fk_user WHERE `id_recipe`=$id_recipe";
        }else{
            $sql = "UPDATE `recipes` 
            SET `name_recipe`= '$name_recipe', 
            `description`='$description',
            `img_recipe`='$img_recipe[0]', 
            `prepTime`='$prepTime', 
            `calories`=$calories, 
            `proofed`='$proofed', 
            `categories` = '$categories',
            `ingredients` = '$ingredients', 
            `fk_user`=$fk_user WHERE `id_recipe`=$id_recipe";
        }

        if(mysqli_query($connection, $sql)){
            $updateSuccess = true;
        }else  {
            $updateFailure = true;
        }
    }
        // close the connection
        mysqli_close($connection);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Planer - Update</title>
    <!--bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CSS navbar -->
    <link rel="stylesheet" href="../css/navbar_styles.css">
    <!-- CSS footer -->
    <link rel="stylesheet" href="../css/footer_styles.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/update_recipes_styles.css">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- navbar -->
    <?php 
    $loc = "../";
    require_once "../components/navbar.php"; ?>

    <!-- start content -->
    <div class='headline'>
        
    </div>
    <div class="container login-box mt-2">
    <h1 class="text-center mt-3 mb-1"> Update Recipe <?= htmlspecialchars($row["name_recipe"] ?? ''); ?> </h1>
        <!-- you need enctype="multipart/form-data" if you use input type file-->
        <form class="row justify-content-center form" action="" method="POST" enctype="multipart/form-data">
            <div class="col-lg-8 col-md-10 mb-3 mt-2">
                <!-- title -->
                <h5>Title: </h5>
                <input value ="<?= htmlspecialchars($row["name_recipe"] ?? ''); ?>" type="text" name="name_recipe" class="form-control">
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- description -->
                <h5> Description: </h5>
                <textarea name="description" class="form-control form-control-lg"><?= htmlspecialchars($row["description"]); ?></textarea>
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- image -->
                <h5>Image: </h5>
                <input type="file" name="picture" class="form-control">
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- prepTime -->
                <h5>Preperation time: </h5>
                <input value="<?= htmlspecialchars($row["prepTime"] ?? ''); ?>" placeholder="please enter the duration in minutes" type="text" name="prepTime" class="form-control">
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- calories -->
                <h5>Calories: </h5>
                <input value=" <?= htmlspecialchars($row["calories"] ?? ''); ?> " type="text" name="calories" class="form-control">
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- categories -->
                <h5> Categories: </h5>
                <select type="text" name="categories" class="form-select">
                    <?php
                    $allCategories = ["Vegan", "Vegetarian", "Meat", "Dessert", "Breakfast", "Lunch", "Dinner"];
                    foreach ($allCategories as $category) {
                        $selected = ($category == $row["categories"]) ? 'selected' : '';
                        echo '<option ' . $selected . '>' . htmlspecialchars($category) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-8 col-md-10 mb-3">
                <!-- ingredients -->
                <h5> Ingredients </h5>
                <textarea name="ingredients" class="form-control form-control-lg"><?= htmlspecialchars($row["ingredients"]); ?></textarea>
            </div>
            <div class="buttonForm">
                            <button type="submit" name="update" class="btn btn-custom-danger btn-outline-dark mt-3">
                                <i class='fa-solid fa-pen-nib'></i> Update
                            </button>
                        </div>
        </form>
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
            title: 'Recipe successful updated!',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            
            window.location = "recipes_dashboard.php";
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
            window.location = "../index.php"; 
        });
    </script>
    <?php endif; ?>

    <!--bootstrap css  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- duration picker -->
    <script src="src/src/jquery-duration-picker.js"></script>
</body>

</html>