<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>Prodavac pocetna</title>
</head>
<style>
    body {
        background-color: #e4f2f0;
    }
    h2 {
      text-decoration: underline;
    }
	.text-center {
	 
      text-align: center;
      font-size: 24pt;
      font-family: "Times New Roman";
      font-weight: bold;
      text-shadow: 1px 2px #999999;

 }
  
 </style>


<body>
  <?php include('seller_navigation.php')?>
  <?php include('seller-mw.php')?>
  <div class="container mt-5">
    <h2 class="text-center">Aktivne ponude</h2>
    <?php 
        $database = mysqli_connect('localhost','root','','airbnb');
        $seller_id = $_SESSION['user_id'];
        $query = "SELECT place_images.image as img, places.*, cities.name as cname FROM places INNER JOIN place_images on place_images.place_id = places.id INNER JOIN cities on cities.id = places.city_id WHERE places.user_id = $seller_id GROUP BY places.name";
        $places = $database->query($query);
      ?>
    <?php while($place = $places->fetch_assoc()):?>
    <div class="card m-3">
        <h5 class="card-header"><?php echo $place['name']?> - <?php echo $place['cname']?>,
          <?php echo $place['address']?></h5>
        <div class="card-body row">
          <div class="col-md-4 d-flex align-items-center justify-content-center">
            <?php echo '<img class = "img-fluid" src="data:image/jpeg;base64,'.base64_encode( $place['img'] ).'"/>'?>

          </div>
          <div class="col-md-8">
<p class="card-text">
            Dozvoljeno pusenje: <?php echo ($place['smoking_allowed']) ? "Da" : "Ne"?>
          </p>
          <p class="card-text">
            Parking: <?php echo ($place['has_parking']) ? "Da" : "Ne"?>
          </p>
          <p class="card-text">
            Internet: <?php echo ($place['has_internet']) ? "Da" : "Ne"?>
          </p>
          <p class="card-text">
             Opis: <?php echo $place['description']?>
          </p>
          <p class="card-text">
            Cena po nocenju: <?php echo $place['price_per_day'] ?>.00rsd
          </p>
          </div>
          
        </div>
        <div class="card-footer d-flex justify-content-around align-items-center">
          <a href = "edit_place.php?id=<?php echo $place['id']?>" class = "btn btn-warning w-45">Izmeni ponudu</a>
          <a href = "remove_place.php?id=<?php echo $place['id']?>" class = "btn btn-danger w-45">Ukloni ponudu</a>

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