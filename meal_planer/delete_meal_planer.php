<?php
session_start();
require_once '../components/db_connect.php';

$user_id = "";
// get the id of the user which is logged in
if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
} elseif (isset($_SESSION["adm"])) {
    $user_id = $_SESSION["adm"];
} else {
    header("Location: ./index.php");
}

if (isset($_GET["id"])) {
    $planner_id = mysqli_real_escape_string($connection, $_GET["id"]);

    // Perform the deletion
    $delete_sql = "DELETE FROM `planner` WHERE `id_planner` = '$planner_id' AND `fk_user_id` = '$user_id'";
    if (mysqli_query($connection, $delete_sql)) {
        // Deletion successful
        header("Location: ./meal_planer.php");
        exit;
    } else {
        // Deletion failed
        header("Location: ./meal_planer.php");
        exit;
    }
} else {
    // Redirect if no planner ID is provided
    header("Location: ./meal_planer.php");
    exit;
}
?>
