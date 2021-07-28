<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Registruj se</title>
</head>

<style>
    .container {
        width: 45%;
        color: black;
        padding: 1rem ;
        padding-right: 1.5rem;
        margin: auto;
        border-radius: 8px;
        background-color: white;
    }
    body {
        background-image: url("img/pozadina1.jpg");
		background-size: cover;
    }
	.text-center1 {
       text-align: center;
       font-size: 24pt;
       font-family: "Times New Roman";
       font-weight: bold;
       text-shadow: 1px 1px #0059b3;
	   color: #4da6ff;
 }
  
 
</style>

<body>
    <?php session_start()?>
    <div class="container mt-5">
        <h1 class="text-center1">Registracija</h1>
        <?php if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])):?>
        <?php foreach($_SESSION['errors'] as $error):?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error?>
        </div>
        <?php endforeach?>
        <?php $_SESSION['errors'] = []?>
        <?php endif?>
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
                <select id="role" name="role" class="form-control">
                    <option value='user'>Korisnik</option>
                    <option value='seller'>Prodavac</option>
                </select>
            </div>
            <input type="hidden" name="register" value=1>
            <a href="login.php" class="text-center d-block my-3">Imate nalog? Ulogujte se ovde.</a>
            <button type="submit" class="btn btn-primary w-100">Registrujte se</button>
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