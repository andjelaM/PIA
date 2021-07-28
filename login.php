<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Uloguj se</title>

</head>
<style>
    .container {
        width: 37%;
        color: black;
        padding: 1rem ;
        padding-right: 1.5rem;
        margin-bottom: 4em;
        border-radius: 8px;
        background-color: white;
    }
    body {
        background-position: center;
        background-size: cover;
        background-image: url("img/pozadina1.jpg") ;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
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
        <h1 class="text-center1">Uloguj se</h1>
        <?php if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])):?>
        <?php foreach($_SESSION['errors'] as $error):?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error?>
        </div>
        <?php endforeach?>
        <?php $_SESSION['errors'] = []?>
        <?php endif?>
        <form method = "post" action = "index.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Korisničko ime:</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Lozinka:</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <input type = "hidden" name = "login" value = 1>
            <a href="register.php" class="d-block text-center my-3">Nemate nalog? Registrujte se ovde</a>
            <button type="submit" class="btn btn-primary w-100">Uloguj se</button>
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