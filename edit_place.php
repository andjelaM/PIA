<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Izmeni ponudu</title>
</head>
<style>
    body {
        background-color: #e4f2f0;
    }
    h3 {
      text-decoration: underline;
      margin-top: 1em;
      margin-bottom: 1.3em;
    }
 </style>

<body>
    <?php include('seller_navigation.php')?>
    <?php 
        $database = mysqli_connect("localhost",'root','','airbnb');
        $place_id = $_GET['id'];
        $query = "SELECT * from places WHERE id = $place_id";
        $place = $database->query($query)->fetch_assoc();
        if($place['user_id'] != $_SESSION['user_id'] || !isset($_SESSION['user_id'])){
            header('location: home.php');
        }
        if(!empty($_POST)){
            $place_id = $_GET['id'];
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
            $query = "UPDATE places
                        SET user_id = $user_id,
                            city_id = $city,
                            name = '$name',
                            address = '$address',
                            type = '$type',
                            rooms = $rooms,
                            has_parking = $parking,
                            has_internet = $internet,
                            smoking_allowed = $smoking,
                            description = '$description',
                            price_per_day = $price
                        WHERE id = $place_id";

        if($database->query($query) === TRUE){
            header('location:seller_dashboard.php');
        }
        else{
            echo $database->error;
            }
        }
    ?>
    <div class="container">
        <h3 class="text-center">Izmeni ponudu</h3>
        <form action="edit_place.php?id=<?php echo $place['id']?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="booking_name">Naziv:</label>
                    <input type="" class="form-control" id="booking_name" name="booking_name" value = "<?php echo $place['name']?>">
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
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" value = "<?php echo $place['address']?>">
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
                    <label for="smoking">Dozvoljeno pušenje:</label>
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
                    <input name="people" id="people" type="number" min = 1 class="form-control" value = "<?php echo $place['people']?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="rooms">Broj soba:</label>
                    <input name="rooms" id="rooms" type="number" min = 1 class="form-control" value = "<?php echo $place['rooms']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="price">Cena po danu:</label>
                <input name="price" id="price" class="form-control" value = "<?php echo $place['price_per_day']?>">
            </div>

            <div class="form-group">
                <label for="description">Opis:</label>
                <textarea class="form-control" name="description" id="description"><?php echo $place['description']?></textarea>
            </div>


            <div class="form-group d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary" style="background-color:  #17a589 ;">Ažuriraj ponudu</button>
            </div>
            <input type="hidden" name="editing">
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