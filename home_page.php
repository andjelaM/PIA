<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e68961ce89.js" crossorigin="anonymous"></script>

  <title>Airbnb</title>
</head>
<style>
  .h-150 {
    height: 150px !important;
    object-fit: cover;
    margin-top: 1em;

  }
  body {
    background-color: #e4f2f0;
    background-image: url("img/pozadina.jpg") ;
    background-size: cover;
  
  }
 .text-center {
	 
    text-align: center;
    font-size: 28pt;
    font-family: "Times New Roman";
    font-weight: bold;
    

 }
 footer {
    background-color: black ; 
    width: 100%  
    
}

.fab {
    
    color:  #3498db ;
    font-size: 30px;
    margin:  1rem 2rem;
    padding-top: -1rem;
}


.smed i:hover {
    color: rgb(255,165,0);
}


  
  
</style>
<body>
  <?php include('navigation.php')?>
  <div class="container mt-5">
    <h1 class = "text-center">Ponude</h1>
    <div class="row mx-auto">
      <?php
          $database = mysqli_connect('localhost','root','','airbnb');
          $query = "SELECT place_images.image as 'image', places.*,users.uname as 'uname',cities.name as 'cname' FROM places INNER JOIN cities on cities.id = places.city_id INNER JOIN users on users.id = places.user_id INNER JOIN place_images on place_images.place_id = places.id GROUP BY places.name";
          $results = $database->query($query);
      ?>
	  
      <?php while($place = $results->fetch_assoc()):?>
      <div class="card mx-auto my-3" style="width: 18rem;">
        <?php echo '<img class = "img-thumbnail h-150" src="data:image/jpeg;base64,'.base64_encode( $place['image'] ).'"/>'?>
        <div class="card-body">
          <h5 class="card-title"><?php echo $place['name']?> - <?php echo $place['cname']?></h5>
          <p class = "card-text">Dozvoljeno pušenje: <?php echo ($place['smoking_allowed']) ? "Da" : "Ne";?></p>
          <p class = "card-text">Parking: <?php echo ($place['has_parking']) ? "Da" : "Ne";?></p>
          <p class = "card-text">Internet: <?php echo ($place['has_internet']) ? "Da" : "Ne";?></p>

          <a href="details.php?id=<?php echo $place['id']?>" class="btn btn-primary" style="margin-left:25%;">Prikaži detalje</a>
        </div>
      </div>
      <?php endwhile?>
    </div>
  </div>
  <footer>
    <div class="row text-center">
      <div class="col-md-4 smed">
        <a href="https://www.facebook.com/airbnb"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/airbnb/"><i class="fab fa-instagram"></i></a>        
        <a href="https://twitter.com/airbnb"><i class="fab fa-twitter"></i></a>
        
      </div>
      
    </div>
  </footer>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
  </script>

</body>

</html>