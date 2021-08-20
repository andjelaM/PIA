<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<style>
    .h-150 {
        height: 150px !important;
        object-fit: cover;
        margin-top: 1em;
    }
    body {
        background-color: #e4f2f0;
    }
</style>

<body>
    <?php include('navigation.php')?>
    <?php 
        $database = mysqli_connect('localhost','root','','airbnb');
        $stext = $_GET['search'];
        $smoking = $_GET['smoking'];
        $parking = $_GET['parking'];
        $internet = $_GET['internet'];
        $query = "SELECT place_images.image as 'img',places.*, cities.name as cname FROM places INNER JOIN cities on cities.id = places.city_id INNER JOIN place_images on place_images.place_id = places.id  WHERE (places.name LIKE '%$stext%' OR cities.name LIKE '%$stext%') AND places.smoking_allowed = $smoking AND places.has_parking = $parking AND places.has_internet = $internet GROUP BY places.name";
        $results = $database->query($query);
    ?>
    <div class="container">
        <div class="form-group row mt-3">
            <div class="col-md-4">
                <label for="smoking-filter">Dozvoljeno pusenje</label>
                <select class="form-control" id="smoking-filter">
                    <option value=1>Da</option>
                    <option value=0>Ne</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="internet-filter">Internet</label>

                <select class="form-control" id="internet-filter">
                    <option value=1>Da</option>
                    <option value=0>Ne</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="parking-filter">Parking</label>

                <select class="form-control" id="parking-filter">
                    <option value=1>Da</option>
                    <option value=0>Ne</option>
                </select>
            </div>

        </div>
    </div>
    <div class="container">
        <?php if(mysqli_num_rows($results) == 0):?>
            <h3 class = "text-center mt-5">Nazalost, nemamo ponuda sa odabranim kriterijumima. Pokusajte da izmenite tekst kako biste nasli ponudu koja odgovara samo Vama.</h3>
        <?php else:?>
        <?php while($place = $results->fetch_assoc()):?>
        <div class="card col-md-3 mx-auto my-3" style="width: 18rem;">
        <?php echo '<img class = "img-thumbnail h-150" src="data:image/jpeg;base64,'.base64_encode( $place['img'] ).'"/>'?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $place['name']?> - <?php echo $place['cname']?></h5>
                <p class="card-text">Dozvoljeno pusenje: <?php echo ($place['smoking_allowed']) ? "Da" : "Ne";?></p>
                <p class="card-text">Parking: <?php echo ($place['has_parking']) ? "Da" : "Ne";?></p>
                <p class="card-text">Internet: <?php echo ($place['has_internet']) ? "Da" : "Ne";?></p>

                <a href="details.php?id=<?php echo $place['id']?>" class="btn btn-primary">Prikazi detalje</a>
            </div>
        </div>
        <?php endwhile?>
        <?php endif?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            if($("#smoking").val() == 1){
                $("#smoking-filter").val('1').change();
            }
            else{
                $("#smoking-filter").val('0').change();
            }
            if($("#internet").val() == 1){
                $("#internet-filter").val('1').change();
            }
            else{
                $("#internet-filter").val('0').change();
            }
            if($("#parking").val() == 1){
                $("#parking-filter").val('1').change();
            }
            else{
                $("#parking-filter").val('0').change();
            }
        })
        $('#smoking-filter').change(function(){
            $("#smoking").val($("#smoking-filter").val())
        })
        $('#internet-filter').change(function(){
            $("#internet").val($("#internet-filter").val())
        })
        $('#parking-filter').change(function(){
            $("#parking").val($("#parking-filter").val())
        })
    </script>
</body>

</html>