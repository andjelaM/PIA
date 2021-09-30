<?php
    session_start();
    $database = mysqli_connect('localhost','root','','airbnb');
    $user_id = $_SESSION['user_id'];
    $reservation_id = $_GET['id'];
    $query = "SELECT user_id FROM place_reservations WHERE id = $reservation_id LIMIT 1";
    $reservation = $database->query("SELECT user_id FROM place_reservations WHERE id = $reservation_id LIMIT 1")->fetch_assoc();
    var_dump($query);
    if($reservation['user_id'] == $user_id){
        $query = "DELETE FROM place_reservations WHERE id = $reservation_id";
        if($database->query($query) === TRUE){
            header('location:account-dashboard.php');
        }
        else{
            header('location:home.php');
        }
    }
?>