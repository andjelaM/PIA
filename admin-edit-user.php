<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Izmeni korisnika</title>
</head>

<body>
    <?php include('admin-navigation.php')?>
    <?php include('admin-mw.php')?>

    <?php
        $database = mysqli_connect('localhost','root','','airbnb');
        if(!empty($_POST)){
            $uname = $_POST['username'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $uid = $_GET['id'];
            echo "updateing";
            $query = "UPDATE users SET
                uname = '$uname',
                fname = '$fname',
                lname = '$lname',
                email = '$email'
                WHERE id = $uid
            ";
            if($database->query($query) === TRUE){
                header("location:admin.php");
            }
            else{
                echo $database->error;
            }
        }
    
    ?>
    <div class="container mt-5">
        <h1 class="text-center">Izmeni korisnika</h1>
        <?php 
            $user_id = $_GET['id'];
            $query = "SELECT * FROM users WHERE id = $user_id";
            $user = $database->query($query)->fetch_assoc();
        ?>  
        <form method="post" action="admin-edit-user.php?id=<?php echo $user['id']?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Ime:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value = "<?php echo $user['fname']?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Prezime:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value = "<?php echo $user['lname']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="username">Korisnicko ime:</label>
                <input class="form-control" type="text" name="username" id="username" value = "<?php echo $user['uname']?>">
            </div>
            <div class="form-group">
                <label for="email">Email adresa:</label>
                <input type="email" class="form-control" id="email" name="email" value = "<?php echo $user['email']?>">
            </div>
           
            <input type="hidden" name="update" value=1>
            <button type="submit" class="btn btn-primary w-100">Izmeni</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>