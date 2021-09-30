<?php session_start()?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <a class="navbar-brand" href="home_page.php">
    <img src="img/logo.jpg" alt="logo" style="width:80px;">
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'):?>
            <?php endif?>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'seller'):?>
            <li class="nav-item">
                <a class="nav-link" href="seller_dashboard.php"><?php echo $_SESSION['username']?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="seller_add_booking.php">Dodaj nekretninu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="seller_reviews.php">Pregled ocena</a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['username'])):?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Odjavi se</a>
            </li>
            <?php endif?>
           

        </ul>
       
    </div>
</nav>