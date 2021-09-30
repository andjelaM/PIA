<?php
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'seller'){
        header('location: home_page.php');
    }
?>