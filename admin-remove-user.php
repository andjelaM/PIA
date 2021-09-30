<?php
    session_start();
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
        $database = mysqli_connect('localhost','root','','airbnb');
        $admin_id = $_SESSION['user_id'];
        $query = "SELECT * from users WHERE id = $admin_id LIMIT 1";
        $admin = $database->query($query)->fetch_assoc();
        $user_id = $_GET['id'];
        if($admin['id'] != $user_id){
            $query = "DELETE FROM users where id = $user_id";
            if($database->query($query) === TRUE){
                header("location: admin.php");
            }
            else{
                echo $database->error;
            }
        }
        else{
            header("location: admin.php");
        }
    }
    else{
        header('location: home_page.php');
    }
?>