 <?php
        $database = mysqli_connect('localhost','root','','airbnb');
        $place_id = $_GET['id'];
        $query = "SELECT places.*,users.uname as 'uname',cities.name as 'cname' FROM places INNER JOIN cities on cities.id = places.city_id INNER JOIN users on users.id = places.user_id INNER JOIN place_images on place_images.place_id = places.id WHERE places.id = $place_id LIMIT 1";
        $place = $database->query($query)->fetch_assoc();
    ?>
 <?php if(!empty($_POST)){
        if(isset($_POST['submit_review'])){
            $user_id = $_POST['user_id'];
            $pid = $_GET['id'];
            $grade = $_POST['rate'];
            $comment = $_POST['comment'];
            $query = "INSERT INTO place_reviews(user_id,place_id,grade,review)
                    VALUES($user_id,$pid,$grade,'$comment');
            ";
            if($database->query($query) === TRUE){
                header("location: details.php?id=$pid");
            }
        }
        if(isset($_POST['edit_review'])){
            $review_id = $_POST['review_id'];
            $pid = $_GET['id'];
            $grade = $_POST['rate'];
            $comment = $_POST['comment'];
            $query = "UPDATE place_reviews
                        SET grade = $grade,
                            review = '$comment'
            ";
            if($database->query($query) === TRUE){
                header("location: details.php?id=$pid");
            }
        }
        if(isset($_POST['get_dates'])){
            $place_id = $_POST['offer_id'];
            $query = "SELECT start_date, end_date FROM place_reservations where place_id = $place_id";
            $places = $database->query($query);
            $places_json = [];
            $i = 0;
            while($row = $places->fetch_assoc()){
                $places_json[$i] = $row;
                $i++;
            }
            echo json_encode($places_json);
            return;
        }
        if(isset($_POST['create_reservation'])){
            $user_id = $_POST['user_id'];
            $place_id = $_GET['id'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $query = "INSERT INTO place_reservations(user_id,place_id,start_date,end_date) VALUES ($user_id,$place_id,'$start','$end')";
            if($database->query($query) === TRUE){
                header('location: home_page.php');
            }
            else{
                echo $database->error;
            }
        }

    }
    ?>
 <!doctype html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
         integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     <title>Detalji o nekretnini</title>
 </head>
 <style>
     .container {
         width: 45%;
	}
    h1 {
        text-decoration: underline;
        margin-bottom: 1.5em;
        margin-top: 1.2em;
    }
    body {
        background-color: #e4f2f0;
        background-image: url("img/pozadina1.jpg") ;
        background-size: cover;
  
  
    }
 </style>

 <body>
     <?php include ('navigation.php')?>

     <input type="hidden" value="<?php echo $_GET['id']?>" id="offer_id">

     <div class="container mt-4">
         <h1 class="text-center">
             <?php echo $place['name']?>
         </h1>
         <?php
            $query = "SELECT * FROM place_images WHERE place_id = $place_id";
            $images = $database->query($query);
            ?>
         <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
             <div class="carousel-inner">
                 <?php $i = 0;?>
                 <?php while($image = $images->fetch_assoc()):?>

                 <?php if($i == 0):?>
                 <div class="carousel-item active">
                     <?php echo '<img class = " d-block w-100" style="height: 500px; object-fit:contain;" src="data:image/jpeg;base64,'.base64_encode( $image['image'] ).'"/>'?>

                 </div>
                 <?php else:?>
                 <div class="carousel-item">
                     <?php echo '<img class = " d-block w-100" style="height: 500px; object-fit:contain;" src="data:image/jpeg;base64,'.base64_encode( $image['image'] ).'"/>'?>

                 </div>
                 <?php endif?>
                 <?php $i++;?>
                 <?php endwhile?>
             </div>
             <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Next</span>
             </a>
         </div>
     </div>
     <div class="container mt-3">
         <h1 class="text-center">Detalji o ponudi</h1>
         <h5>Lokacija: <?php echo $place['cname'] .", " . $place['address']?></h5>
         <h5>Tip ponude: <?php echo ($place['type'] === 'house') ? "Kuca" : "Apartman"?></h5>
         <h5>Broj soba: <?php echo $place['rooms']?></h5>
         <h5>Maksimalan broj ljudi: <?php echo $place['people']?></h5>
         <div class="row mx-auto mt-3">
             <div class="col-md-4">
                 <h6 class="text-center">Pušenje:
                     <?php echo ($place['smoking_allowed']) ? "Dozvoljeno" : "Zabranjeno"?></h6>
             </div>
             <div class="col-md-4">
                 <h6 class="text-center">Internet: <?php echo ($place['has_internet']) ? "Postoji" : "Ne postoji"?></h6>
             </div>
             <div class="col-md-4">
                 <h6 class="text-center">Parking: <?php echo ($place['has_parking']) ? "Postoji" : "Ne postoji"?></h6>
             </div>
         </div>
         <button class="btn btn-primary w-50 mt-3" style="margin-left:25%;"><strong>Cena po noćenju:
                 <strong id="price_per_day"><?php echo $place['price_per_day']. ".00rsd"?></strong></button>
     </div>
     <div class="container">
         <?php 
            if(isset($_SESSION['user_id'])){
                $query = "SELECT place_reviews.*, users.uname as 'uname' FROM place_reviews INNER JOIN users on users.id = place_reviews.user_id";
                $reviews = $database->query($query);
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM place_reviews where place_reviews.user_id = $user_id and place_reviews.place_id = $place_id";
                $preview = $database->query($query);
                if(mysqli_num_rows($preview) == 0){
                    $rated = 0;
                }
                else{
                    $rated = 1;
                }     
            }
            else{
                $rated = 0;
            }       
        
        ?>
         <?php 
            $booking_id = $_GET['id'];
            $query = "SELECT * FROM place_reservations where user_id = $user_id and place_id = $booking_id ORDER BY start_date DESC  LIMIT 1 ";
            $booking = $database->query($query);
            if($booking){
                $booking = $booking->fetch_assoc();
            }
        ?>
         <h1 class="text-center mt-3">Ocene korisnika</h1>
         <?php 
                $query = "SELECT place_reviews.*,users.uname FROM place_reviews INNER JOIN users on place_reviews.user_id = users.id WHERE place_id = $booking_id";
                $results = $database->query($query);
            ?>

         <div class="reviews mb-5">
             <?php while($review = $results->fetch_assoc()):?>
             <div class="card">
                 <div class="card-header d-flex align-items-center justify-content-between">
                     <p class="m-0"><?php echo $review['uname']?></p>
                     <p class="m-0"><?php echo $review['grade']?> / 5</p>

                 </div>
                 <div class="card-body">
                     <p class="card-text"><?php echo $review['review']?></p>
                 </div>
             </div>
             <?php endwhile?>
         </div>



         <?php if(!isset($_SESSION['user_id'])):?>
         <h3 class="text-center">Morate imati kreiran nalog da biste ostavili ocenu.</h3>
         <?php endif?>
         <?php if(!$rated && isset($_SESSION['user_id']) && isset($booking['end_date']) && date_create($booking['end_date']) < date_create(date('m/d/Y'))) :?>
         <h1 class="text-center">Vaša ocena</h1>
         <form method="post" action="details.php?id=<?php echo $place_id?>">
             <div class="form-group">
                 <label for="rate">Ocena(1-5)</label>
                 <input class="form-control" id="rate" min = 1 max = 5 type="number" name="rate">
             </div>
             <div class="form-group">
                 <label for="review">Komentar</label>
                 <textarea name="comment" id="review" class="form-control"></textarea>
             </div>
             <button class="btn btn-primary w-100">Postavi ocenu</button>
             <input type="hidden" name="submit_review">
             <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
         </form>
         <?php elseif($rated == 1 && isset($_SESSION['user_id'])  && date_create($booking['end_date']) < date_create(date('m/d/Y')) && isset($booking['end_date'])):?>
         <h1 class="text-center">Vaša ocena</h1>
         <?php $preview = $preview->fetch_assoc();?>
         <form method="post" action="details.php?id=<?php echo $place_id?>">
             <div class="form-group">
                 <label for="rate">Ocena(1-5)</label>
                 <input class="form-control" id="rate" type="number" min = 1 max = 5 name="rate" value="<?php echo $preview['grade']?>">
             </div>
             <div class="form-group">
                 <label for="review">Komentar</label>
                 <textarea name="comment" id="review" class="form-control"><?php echo $preview['review']?></textarea>
             </div>
             <button class="btn btn-warning w-50" style="margin-left:25%;">Ažuriraj ocenu</button>
             <input type="hidden" name="review_id" value="<?php echo $preview['id']?>">
             <input type="hidden" name="edit_review">
         </form>
         <?php endif?>
     </div>

     <div class="container my-5">
         <h1 class="text-center">Rezerviši</h1>
         <?php if(isset ($_SESSION['user_id'])):?>
         <form id="reservation-form" action="details.php?id=<?php echo $place_id?>" method="post">
             <div class="form-row">
                 <div class="form-group col-md-6">
                     <label for="start">Datum pocetka rezervacije</label>
                     <input type="date" id="start" class="form-control" name="start">
                 </div>
                 <div class="form-group col-md-6">
                     <label for="end">Datum zavrsetka rezervacije</label>
                     <input type="date" id="end" class="form-control" name="end">
                 </div>
                 <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                 <div class="row w-100">
                     <p id="price" class="mx-auto d-block text-center"></p>
                 </div>
                 <div class="row w-100">
                     <p id="status" class="d-block text-center mx-auto"></p>
                 </div>
                 <div class="row w-100 mb-3">
                     <h5 class="text-center w-100 mt-3"><strong>Placanje</strong></h5>
                     <div class="form-check mx-auto">
                         <input class="form-check-input cash-choice" type="radio" name="exampleRadios"
                             id="exampleRadios1" value="option1" checked>
                         <label class="form-check-label cash-choice" for="exampleRadios1">
                             Kes
                         </label>
                     </div>
                     <div class="form-check mx-auto">
                         <input class="form-check-input card-choice" type="radio" name="exampleRadios"
                             id="exampleRadios2" value="option2">
                         <label class="form-check-label card-choice" for="exampleRadios2">
                             Kartica
                         </label>
                     </div>
                     <div class="container" id='card'>
                         <div class="form-group row">
                             <div class="col-md-6">
                                 <label for="owner">Vlasnik kartice</label>
                                 <input class="form-control" id="owner">
                             </div>
                             <div class="col-md-6">
                                 <label for="cnum">Broj kartice</label>
                                 <input class="form-control" id="cnum">
                             </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-md-6">
                                 <label for="expire">Datum isticanja</label>
                                 <input class="form-control" id="expire" type = "date" placeholder = "MM/YY">
                             </div>
                             <div class="col-md-6">
                                 <label for="cvv">CVV broj</label>
                                 <input class="form-control" id="cvv">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row w-100">
                     <div class="col-md-6">
                         <button type="button" class="btn btn-warning w-100" onclick="checkAvailability()">Proveri
                             dostupnost</button>
                     </div>
                     <div class="col-md-6">
                         <button type="button" class="btn btn-success w-100" onclick="createReservation()" id="reserve"
                             disabled>Rezervisi</button>
                     </div>
                 </div>
             </div>
             <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
             <input type="hidden" name="create_reservation" value="1">
         </form>
         <?php else:?>
         <h3 class="text-center">Morate biti ulogovani za kreiranje rezervacije</h3>
         <?php endif?>

     </div>
     <script src="https://code.jquery.com/jquery-3.5.1.js"
         integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
     <script>
         $(document).ready(function () {
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;
             $("#card").hide()
             $("#expire").attr({
                 'min': today
             })
             $(".card-choice").click(function () {
                 $("#card").slideDown();
             })
             $(".cash-choice").click(function () {
                 $("#card").slideUp();
             })
         })

         function checkAvailability() {
             let date_start = new Date(document.getElementById('start').value);
             let date_end = new Date(document.getElementById('end').value);
             console.log(date_start)
             if (isNaN(date_start.getTime()) || isNaN(date_end.getTime())) {
                 $("#status").text("Molimo odaberite datum kako biste mogli da kreirate rezervaciju")
                 $("#status").css('color', 'red')
                 return;
             }
             if (date_start > date_end) {
                 $("#status").text("Datum dolaska ne sme biti kasniji od datuma odlaska")
                 $("#status").css('color', 'red')

                 $("#reserve").attr('disabled', true);
                 return;
             } else if (date_start == date_end) {
                 $("#status").text("Datum dolaska ne sme biti isti kao datum odlaska")
                 $("#reserve").attr('disabled', true);
                 $("#status").css('color', 'red')

                 return;

             } else if (date_start < Date.now()) {
                 $("#status").text("Datum dolaska ne sme biti raniji od danasnjeg datuma")
                 $("#reserve").attr('disabled', true);
                 $("#status").css('color', 'red')

                 return;

             }
             let t = date_end.getTime() - date_start.getTime();
             let d = t / (1000 * 3600 * 24);
             let price = parseInt(document.getElementById('price_per_day').innerText);
             console.log(price);
             if (d < 0) {
                 alert("Greska pri odabiru datuma. Zavrsni datum ne sme biti veci od pocetnog datuma");
             } else {
                 let priceElement = document.getElementById('price')
                 console.log(priceElement)
                 priceElement.innerText = "Cena: " + d + " * " + price + "= " + d * price + ".00rsd";
             }
             console.log(d);
             let offer_id = $("#offer_id").val();
             let data = {
                 'offer_id': offer_id,
                 'get_dates': 1
             };
             console.log(data)
             let available = true;
             $.ajax({
                 method: 'post',
                 url: 'details.php?id=' + offer_id,
                 data: data,
                 success: function (response) {
                     let response_data = JSON.parse(response)
                     console.log(response_data)
                     for (let i = 0; i < response_data.length; i++) {
                         let start_date_db = new Date(response_data[i].start_date);
                         let end_date_db = new Date(response_data[i].end_date);
                         if ((date_start <= end_date_db) && (start_date_db <= date_end)) {
                             available = false;
                             break;
                         }
                     }
                     console.log(available)
                     if (!available) {
                         $("#status").text(
                             "Nije moguce napraviti rezervaciju u ovom trenutku. Molimo promenite datum"
                         )
                         $("#status").css('color', 'red')
                         $("#reserve").attr('disabled', true)

                     }
                     if (available) {
                         $("#status").text("Moguce je napraviti rezervaciju u ovom intervalu")
                         $("#status").css('color', 'green')
                         $("#reserve").removeAttr('disabled')
                     }
                 }
             })
         }
         $("#reserve").click(function () {
            let cardDate = new Date($("#expire").val());
            console.log(cardDate);
            let minDate = new Date($("#expire").attr('min'));
            console.log(minDate)
            if(cardDate < minDate){
                alert("Kartica je istekla, probajte sa nekom drugom.")
            }
            else{
                $("#reservation-form").submit();
            }

         })
     </script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
     </script>
 </body>

 </html>