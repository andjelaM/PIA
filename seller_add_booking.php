<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>Dodaj rezervaciju</title>
</head>
<style>
	h1 {
	 
       text-align: center;
       font-size: 24pt;
       font-family: Arial;
       font-weight: bold;
       text-shadow: 1px 2px grey;
       margin-top: 1em;
       margin-bottom: 1.3em;

    }
    body {
        background-color: #e4f2f0;
    }
    
  
 
</style>

<body>
  <?php include('seller_navigation.php')?>
    <?php include('seller-mw.php')?>

  <?php 
    $database = mysqli_connect('localhost','root','','airbnb');
  ?>
  <?php 
    if(!empty($_POST)){
      $name = $_POST['booking_name'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $type = $_POST['type'];
      $smoking = $_POST['smoking'];
      $internet = $_POST['internet'];
      $parking = $_POST['parking'];
      $people = $_POST['people'];
      $rooms = $_POST['rooms'];
      $user_id = $_SESSION['user_id'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $files = $_FILES['pictures']['name'];
      $query = "INSERT INTO places(user_id,city_id,name,address,type,rooms,people,has_parking,has_internet,smoking_allowed,description,price_per_day)
                            VALUES($user_id,$city,'$name','$address','$type','$rooms',$people,$parking,$internet,$smoking,'$description', $price)";
      if($database->query($query) === TRUE){
        $place_id = $database->insert_id;
        $filename = $_FILES['pictures']['name'];
        $file_tmp = $_FILES['pictures']['tmp_name'];
        $filetype = $_FILES['pictures']['type'];
        $filesize = $_FILES['pictures']['size'];
        for($i=0; $i < count($file_tmp); $i++){
          if(!empty($file_tmp[$i])){
              $temp = addslashes(file_get_contents($file_tmp[$i]));
              if($database->query("Insert into place_images(place_id,image) values('$place_id','$temp')") != TRUE){
                echo $database->error;
              }
            }
          }
        }
      else{
          echo $database->error;
        }
      }
  ?>
  <div class="container mt-5">
    <h1>Dodaj nekretninu</h1>
    <form method="post" action="seller_add_booking.php" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="booking_name">Naziv:</label>
          <input type="" class="form-control" id="booking_name" name="booking_name">
        </div>
        <div class="form-group col-md-6">
          <?php 
            $db = mysqli_connect("localhost",'root','','airbnb');
            $query = "SELECT * FROM cities";
            $cities = $db->query($query);
        ?>
          <label for="cities">Grad:</label>
          <select class="form-control" name="city" id="cities">
            <?php while($city = $cities->fetch_assoc()):?>
            <option value="<?php echo $city['id']?>"><?php echo $city['name']?></option>
            <?php endwhile?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="address">Adresa:</label>
        <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address">
      </div>
      <div class="form-group">
        <label for="type">Tip:</label>
        <select name="type" class="form-control">
          <option value="house">Kuca</option>
          <option value="appartment">Stan</option>

        </select>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="smoking">Dozvoljeno pusenje:</label>
          <select class="form-control" name="smoking" id="smoking">
            <option value="0">Ne</option>
            <option value="1">Da</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="parking">Parking:</label>
          <select id="parking" name="parking" class="form-control">
            <option value="0">Ne</option>
            <option value="1">Da</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="internet">Internet:</label>
          <select name="internet" id="internet" class="form-control">
            <option value="0">Ne</option>
            <option value="1">Da</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="form-group col-md-6">
          <label for="people">Broj ljudi:</label>
          <input name="people" id="people" type="number" min = 1 class="form-control">
        </div>
        <div class="form-group col-md-6">
          <label for="rooms">Broj soba:</label>
          <input name="rooms" id="rooms" type="number" min = 1 class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="price">Cena po danu:</label>
        <input name="price" id="price" class="form-control">
      </div>

      <div class="form-group">
        <label for="description">Opis:</label>
        <textarea class="form-control" name="description" id="description"></textarea>
      </div>

      <div class="form-row mt-4">
        <div class="form-group col-md-6">
          <label for="pictures">Slike:</label>
          <input type="file" class="form-control-file" id="pictures" name="pictures[]" multiple="multiple">

        </div>
        <div class="form-group d-flex justify-content-center align-items-center col-md-6">
          <button type="submit" class="btn btn-primary" style="background-color:  #17a589 ; width:50%;">Kreiraj ponudu</button>
        </div>
      </div>
      <input type="hidden" name="uploading">
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