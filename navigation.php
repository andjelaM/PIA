
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
            <li class="nav-item active">
                <a class="nav-link" href="home_page.php">Pocetna <span class="sr-only">(current)</span></a>
            </li>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'):?>
            <li class="nav-item">
                <a class="nav-link" href="account-dashboard.php"><?php echo $_SESSION['username']?></a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'seller'):?>
            <li class="nav-item">
                <a class="nav-link" href="seller_dashboard.php"><?php echo $_SESSION['username']?></a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'):?>
            <li class="nav-item">
                <a class="nav-link" href="admin.php"><?php echo $_SESSION['username']?></a>
            </li>
            <?php endif?>
            <?php if(isset($_SESSION['username'])):?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Odjavi se</a>
            </li>
            <?php endif?>
            <?php if(!isset($_SESSION['username'])):?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Uloguj se</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Registruj se</a>
            </li>
            <?php endif?>

        </ul>
        <form class="form-inline my-2 my-lg-0" method = "get" action = "search.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name = "search" value = "<?php if(isset($_GET['search'])) echo $_GET['search'];?>">
            <input type = "hidden" name = "smoking" id = "smoking" value = "<?php echo (isset($_GET['smoking'])) ? $_GET['smoking'] : 1;?>">
            <input type="hidden" name = "parking" id = "parking" value = "<?php echo (isset($_GET['parking'])) ? $_GET['parking'] : 1;?>">
            <input type="hidden" name="internet" id = "internet" value = "<?php echo (isset($_GET['internet'])) ? $_GET['internet'] : 1;?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>
</nav>



