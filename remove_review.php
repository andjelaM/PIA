<?php
    session_start();
    $database = mysqli_connect('localhost','root','','airbnb');
    $user_id = $_SESSION['user_id'];
    $review_id = $_GET['id'];
    $review = $database->query("SELECT user_id FROM place_reviews WHERE id = $review_id LIMIT 1")->fetch_assoc();
    if($review['user_id'] == $user_id){
        $query = "DELETE FROM place_reviews WHERE id = $review_id";
        if($database->query($query) === TRUE){
            header('location:account-dashboard.php');
        }
        else{
            header('location:home.php');
        }
    }
?>