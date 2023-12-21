<?php 
    session_start();
    require_once '../components/db_connect.php';

    $addSuccess = false;
    $addFailure = false;
    $addFailureUnknown = false;
    $user_id = $week_day = $recipe_id = "";
    // Check if user is logged in, otherwise redirect
    // get the id of the user which is logged in
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
        exit;
    }
    
    if (isset($_GET["id"]) && isset($_GET["week_day"])) {
        // Sanitize the inputs
        $recipe_id = mysqli_real_escape_string($connection, $_GET["id"]);
        $week_day = mysqli_real_escape_string($connection, $_GET["week_day"]);
    
        // Validation for enum values
        $allowed_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        if (!in_array($week_day, $allowed_days)) {
            // Handle the error appropriately, maybe redirect back with an error message
            header("Location: ./recipes.php?error=invalid_day");
            exit;
        }

        // Check if the recipe is already planned for the same user and day
        $checkQuery = "SELECT * FROM `planner` WHERE `fk_user_id` = '$user_id' AND `fk_recipe_id` = '$recipe_id' AND `week_day` = '$week_day'";
        $result = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Recipe already planned for this day, handle this case
            echo "You already have this recipe on ".$week_day;
            header("Location: ../recipes.php");
            // $addFailure = true;
        } else {
            // Proceed with insertion since the recipe is not already planned for this day
            $sql = "INSERT INTO `planner` (`fk_user_id`, `fk_recipe_id`, `week_day`) VALUES ('$user_id', '$recipe_id', '$week_day')";
            if (mysqli_query($connection, $sql)) {
                echo "You added the recipe to your Meal Planner!";
                header("Location: ../recipes.php");
                // $addSuccess = true;
            } else {
                echo "Something went wrong!";
                header("Location: ../recipes.php");
                // $addFailureUnknown = true;
            }
        }
    }
?>    
<!-- SweetAlert -->
<script src="https//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert for add Success
    <?php if ($addSuccess) : ?>
        Swal.fire({
            icon: 'success',
            title: 'You added the recipe to your Meal Planner!',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location = "../recipes.php";
        });
    <?php endif; ?>
    // SweetAlert for add Failure of already exist
    <?php if ($addFailure) : ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You already have this recipe on <?php echo $week_day; ?>.'
        }).then(function() {
            window.location = "../recipes.php";
        });
    <?php endif; ?>
    // SweetAlert for add Failure
    <?php if ($addFailureUnknown) : ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!'
        }).then(function() {
            window.location = "../recipes.php";
        });
    <?php endif; ?>
</script>