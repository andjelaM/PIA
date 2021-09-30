<?php 
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'user'){
        header('location:home_page.php');
    }

?>