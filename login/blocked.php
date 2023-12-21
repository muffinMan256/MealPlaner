<?php
session_start();

require_once '../components/db_connect.php';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id_user = $_GET["id"];

    // Toggle the user's blocked status in the database
    $sql = "UPDATE `user` SET `blocked` = NOT `blocked` WHERE id_user = $id_user";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        header("Location: ./user_dashboard.php");
        exit();
    } else {
        // Handle error, maybe redirect with an error message
        header("Location: ./user_dashboard.php?error=1");
        exit();
    }
} else {
    // Handle case where ID is not provided in the URL
    header("Location: ./user_dashboard.php?error=2");
    exit();
}
