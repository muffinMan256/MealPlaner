<?php 
    session_start();

    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
        header("Location: ./index.php");
    }
    require_once '../components/db_connect.php';
    
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id_recipe = $_GET["id"];
        $proofed = true;

        // first get recipe
        $sql = "SELECT * FROM `recipes` WHERE `id_recipe` = $id_recipe";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        // update the recipe
        $sql = "UPDATE `recipes` 
                SET `proofed`= true 
                WHERE id_recipe = $id_recipe ";
        $result = mysqli_query($connection, $sql);

        if(mysqli_query($connection, $sql)){
            header("Location: ./recipes_dashboard_admin.php");
        }else  {
            header("Location: ./recipes_dashboard_admin.php");
        }
    }

    