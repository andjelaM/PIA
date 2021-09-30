<?php 
    session_start();
    $database = mysqli_connect("localhost",'root','','airbnb');

    $place_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    if(!isset($_SESSION['user_id'])){
        header('location:home.php');
    }
    $query = "SELECT * FROM places where id = $place_id";
    $place = $database->query($query)->fetch_assoc();
    if($place['user_id'] == $_SESSION['user_id']){
        $query = "DELETE FROM places WHERE id = $place_id";
        echo $query;
        if($database->query($query) === TRUE){
            header("location:seller_dashboard.php");
        }
        else{
            echo $database->error;
        }
    }

?>