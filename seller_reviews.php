<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Recenzije</title>
</head>
<style>
    body {
        background-color: #e4f2f0;
    }
	.text-center1 {
	   font-family: "Times New Roman";
       font-size: 10pt;
       margin: auto;
       width: 50%;
       font-weight: bold;
       background-color: #FFFFFF;
       padding: 1rem;
       align-self: center;
	   text-align: center;
       font-size: 24pt;
       font-family: "Times New Roman";
       font-weight: bold;
       text-shadow: 1px 2px #999999;
       border-radius: 10px;
	}
    
 </style>

<body>
    <?php include('seller_navigation.php')?>
    <?php include('seller-mw.php')?>
    <?php 
        $database = mysqli_connect('localhost','root','','airbnb');
        $user_id = $_SESSION['user_id'];
        $query = "SELECT places.*, users.*, place_reviews.* FROM place_reviews  INNER JOIN places on place_reviews.place_id = places.id INNER JOIN users on place_reviews.user_id = users.id WHERE places.user_id = $user_id";
        $reviews = $database->query($query);
    ?>
    <div class="container mt-5">
        <h3 class="text-center1">Ocene ponuda</h3>
        <?php while($review = $reviews->fetch_assoc()):?>
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between"><h5><?php echo $review['uname']?></h5><h5><?php echo $review['grade']?> / 5</h5></div>
            <div class="card-body">
                    <p class="card-text">
                        <?php echo $review['review']?>
                    </p>
            </div>
            <div class="card-footer">
                <h5 class = 'text-center'><?php echo $review['name']?></h5>
            </div>
        </div>
        <?php endwhile?>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>