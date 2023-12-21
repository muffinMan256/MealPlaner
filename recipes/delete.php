<?php
    session_start();
    $deleteSuccess = false;
    $deleteFailure = false;
    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
       header("Location: ../index.php");
    }
    require_once '../components/db_connect.php';

    if(isset($_GET["id"]) && !empty($_GET["id"])){

        $id_recipe = $_GET["id"];
        // Delete associated records from review_table
        $sqlDeleteReviews = "DELETE FROM review_table WHERE fk_recipeid=$id_recipe";
        mysqli_query($connection, $sqlDeleteReviews);


        $id = $_GET["id"];
        $sql = "SELECT * FROM `recipes` WHERE `id_recipe` = $id";
        $result = mysqli_query($connection, $sql);

        $row = mysqli_fetch_assoc($result);
        if($row["img_recipe"] !== "default.png"){
            unlink("../image/$row[img_recipe]");
        }

        $sql = "DELETE FROM `recipes` WHERE id_recipe=$id";
        if (mysqli_query($connection, $sql)) {
            if (mysqli_affected_rows($connection) > 0) {
                $deleteSuccess = true;
                echo "Entry deleted successfully.";
            } else {
                $deleteFailure = true;
                echo "No rows were affected, deletion didn't happen.";
            }
        } else {
            $deleteFailure = true;
            echo "Error deleting entry: " . mysqli_error($connection);
        }
        

        mysqli_close($connection);
        header("Location: ./recipes_dashboard.php");
    }
    else{
        mysqli_close($connection);
        header("Location: ./recipes_dashboard.php");
    }

?>
