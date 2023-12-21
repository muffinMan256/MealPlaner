<?php

    session_start();

    $connect = new PDO("mysql:host=localhost;dbname=be20_p2", "root", "");

    $recipe_id = $_SESSION["sessionid"];
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

    if (isset($_POST["rating_data"])) {

    $data = array(
        ':user_name'    => $_POST["user_name"],
        ':user_rating'  => $_POST["rating_data"],
        ':user_review'  => $_POST["user_review"],
        ':datetime'     => time(), // Use current time
        ':fk_userid'    => $user_id,
        ':fk_recipeid'  => $recipe_id
    );
    
    $query = "INSERT INTO review_table (user_name, user_rating, user_review, datetime, fk_userid, fk_recipeid) 
            VALUES (:user_name, :user_rating, :user_review, :datetime, :fk_userid, :fk_recipeid)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    
    echo "Your Review & Rating Successfully Submitted";
    }
    
    if (isset($_POST["action"])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();
    
    // Add a WHERE clause to filter reviews by recipe ID
    $recipe_id = isset($_POST["recipe_id"]) ? $_POST["recipe_id"] : null;
    $where_clause = $recipe_id ? "WHERE fk_recipeid = $recipe_id" : "";
    
    $query = "SELECT * FROM review_table $where_clause ORDER BY review_id DESC";
    
    $result = $connect->query($query, PDO::FETCH_ASSOC);
    
    foreach ($result as $row) {
        $review_content[] = array(
            'user_name'     => $row["user_name"],
            'user_review'   => $row["user_review"],
            'rating'        => $row["user_rating"],
            'datetime'      => date('l jS, F Y h:i:s A', $row["datetime"])
        );
    
        // Count star ratings
        switch ($row["user_rating"]) {
            case '5':
                $five_star_review++;
                break;
            case '4':
                $four_star_review++;
                break;
            case '3':
                $three_star_review++;
                break;
            case '2':
                $two_star_review++;
                break;
            case '1':
                $one_star_review++;
                break;
        }
    
        $total_review++;
        $total_user_rating += $row["user_rating"];
    }
    
    $average_rating = $total_user_rating / $total_review;
    
    $output = array(
        'average_rating'    => number_format($average_rating, 1),
        'total_review'      => $total_review,
        'five_star_review'  => $five_star_review,
        'four_star_review'  => $four_star_review,
        'three_star_review' => $three_star_review,
        'two_star_review'   => $two_star_review,
        'one_star_review'   => $one_star_review,
        'review_data'       => $review_content
    );
    
    echo json_encode($output);
    
    }
?>

