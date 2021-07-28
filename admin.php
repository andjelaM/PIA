<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Admin</title>
  </head>
  <style>
  body {
	  background-image: url("img/pozadina1.jpg") ;
  }
	.text-center {
      text-align: center;
      font-size: 28pt;
      font-family: "Times New Roman";
      font-weight: bold;
      color: black;
      margin-bottom: 1.2em;
    }
    .form-row {
      padding: 25px;
      margin: auto;
    }
    </style>
  <body>
    <?php include('admin-navigation.php')?>
    <?php include('admin-mw.php')?>

    <div class="container mt-5">
        <h2 class="text-center">Kreiraj korisnika</h2>
        <form method="post" action="index.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Ime:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Prezime:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>
            <div class="form-group">
                <label for="username">Korisnicko ime:</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="email">Email adresa:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Lozinka:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="role">Rola:</label>
                <select id="role" name = "role" class="form-control">
                    <option value = 'user'>Korisnik</option>
                    <option value = 'seller'>Prodavac</option>
                </select>
            </div>
            <input type="hidden" name="register" value=1>
            <input type = "hidden" name = "admin_register" value = 1>
            <button type="submit" class="btn btn-primary w-50" style="margin-left:25%; background-color: #45dc14 ;">Kreiraj korisnika</button>
        </form>
    </div>

    <div class="container mt-5">
        <h3 class="text-center">Lista korisnika</h3>
        <?php 
            $database = mysqli_connect("localhost",'root','','airbnb');
            $query = "SELECT * from users";
            $users = $database->query($query);
        ?>
        <?php while($user = $users->fetch_assoc()):?>
            <div class="card mt-2">
                <div class="card-header">
                    <?php echo $user['uname']?>
                </div>
                <div class="card-body">
                    <p class = "card-text">Ime: <?php echo $user['fname']?></p>
                    <p class = "card-text">Prezime: <?php echo $user['lname']?></p>
                    <p class = "card-text">Email adresa: <?php echo $user['email']?></p>
                </div>
                <div class="card-footer d-flex justify-content-around align-items-center">
                    <a href="admin-edit-user.php?id=<?php echo $user['id']?>" class="btn btn-primary" style="background-color:  #FFBF00 ;">Izmeni korisnika</a>
                    <a href="admin-remove-user.php?id=<?php echo $user['id']?>" class="btn btn-primary" style="background-color:  #f82020  ;">Ukloni korisnika</a>
                </div>
            </div>
        
        <?php endwhile?>
        
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>