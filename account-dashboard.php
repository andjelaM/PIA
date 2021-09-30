<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Moj nalog</title>
</head>
<style>
    body {
        background-color: #e4f2f0;
    }
    .text-center1 {
	 
       text-align: center;
       font-size: 30pt;
       font-family: "Times New Roman";
       font-weight: bold;
       text-shadow: 1px 2px #999999;
	   text-decoration: underline;
    }
    h3{
	 
      text-align: center;
      font-size: 23pt;
      font-family: "Times New Roman";
      font-weight: italic;
    
	}
 </style>

<body>
    <?php include('navigation.php')?>
    <?php include('user-mw.php')?>

    <?php
        $database = mysqli_connect('localhost','root','','airbnb');
        $user_id = $_SESSION['user_id'];
        $reservations_query = "SELECT place_reservations.*,place_reservations.id as rid, cities.name as cname,places.* FROM place_reservations INNER JOIN places on place_reservations.place_id = places.id INNER JOIN cities on cities.id = places.city_id WHERE place_reservations.user_id = $user_id";
        $reviews_query = "SELECT place_reviews.*,place_reviews.id as rid, places.* FROM place_reviews INNER JOIN places on places.id = place_reviews.place_id WHERE place_reviews.user_id = $user_id";
        $reservations = $database->query($reservations_query);
        $reviews = $database->query($reviews_query);
      ?>
    <h1 class="text-center1 mt-3">Pregled naloga</h1>
    <div class="container mt-5">
        <div class="container">
            <h3>Ocene:</h3>
            <div class="reviews mb-5">
                <?php while($review = $reviews->fetch_assoc()):?>
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <p class="m-0"><?php echo $review['name']?></p>
                        <p class="m-0"><?php echo $review['grade']?> / 5</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $review['review']?></p>
                    </div>
                    <div class="card-footer">
                        <a href="remove_review.php?id=<?php echo $review['rid']?>" class='btn w-50 btn-danger' style="margin-left:25%;">Ukloni
                            recenziju</a>
                    </div>
                </div>
                <?php endwhile?>
            </div>
        </div>
        <div class="container">
            <h3>Rezervacije:</h3>
            <div class="reviews mb-5">
                <?php while($reservation = $reservations->fetch_assoc()):?>
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <p class="m-0"><?php echo $reservation['name']?> - <?php echo $reservation['cname']?>, <?php echo $reservation['address']?></p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Datum rezervacije: <?php echo $reservation['start_date']?></p>
                        <p class="card-text">Datum povratka: <?php echo $reservation['end_date']?></p>

                    </div>
                    <div class="card-footer">
                        <a href="remove_reservation.php?id=<?php echo $reservation['rid']?>" class='btn w-50 btn-danger' style="margin-left:25%;">Ukloni
                            rezervaciju</a>
                    </div>
                </div>
                <?php endwhile?>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
</body>

</html>