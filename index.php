<?php 
    session_start();
    $db = mysqli_connect('localhost','root','','airbnb');
    
    if(isset($_POST['register'])){
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $uname = $_POST['username'];
        $email = $_POST['email'];
        $uname = $_POST['username'];
        $role = $_POST['role'];
        $password = md5($_POST['password']);
        $errors = [];
        $_SESSION['errors'] = array();
        if($fname == ""){
            array_push($_SESSION['errors'],'Ime je obavezno');
        }
        if($lname == ""){
            array_push($_SESSION['errors'],'Prezime je obavezno');
        }
        if($uname == ""){
            array_push($_SESSION['errors'],'Korisnicko ime je obavezno');
        }
        if($email == ""){
            array_push($_SESSION['errors'],'Email adresa je obavezna');
        }
        if($password == ""){
            array_push($_SESSION['errors'],'Lozinka je obavezna');
        }
        if($role == ""){
            array_push($_SESSION['errors'],'Uloga je obavezna');
        }
        if(!empty($_SESSION['errors'])){
            header("location: register.php");
        }
        else{
            $query = "SELECT * FROM users where uname = '$uname' OR email = '$email'";
            $users = $db->query($query);
            if(mysqli_num_rows($users) == 0){
                $query = "INSERT INTO 
                    users(fname,lname,uname,email,password,role)
                    VALUES('$fname','$lname','$uname','$email','$password','$role')
                ";
                if($db->query($query) === TRUE){
                    if(!isset($_POST['admin_register'])){
                        $_SESSION['username'] = $uname;
                        $_SESSION['role'] = $role;
                        $_SESSION['user_id'] = $db->insert_id;
                        if($role == 'user'){
                            header("location: home_page.php");
                        }
                        else{
                            header("location: seller_dashboard.php");
                        }
                    }
                    else{
                        header('location: admin.php');
                    }

                }
                else{
                    echo $db->error;
                }
            }
            else{
                array_push($_SESSION['errors'],'Korisnik sa ovom email adresom ili korisničkim imenom već postoji');
                header("location: register.php");
            }
        }
    }
    else if(isset($_POST['login'])){
        $uname = $_POST['username'];
        $password = md5($_POST['password']);
        $_SESSION['errors'] = array();
        if($uname == ""){
            array_push($_SESSION['errors'],'Korisničko ime je obavezno');
        }
        if($_POST['password'] == ""){
            array_push($_SESSION['errors'],'Lozinka je obavezna');
        }
        if(empty($_SESSION['errors'])){
            $query = "SELECT * FROM users where (uname = '$uname' OR email = '$uname') AND password = '$password'";
            $result = $db->query($query);
            if(mysqli_num_rows($result) > 0){
               
                $user = $result->fetch_assoc();
                $_SESSION['username'] = $user['uname'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];
                var_dump($_SESSION);
                if($_SESSION['role'] == 'user'){
                    header("location: home_page.php");
                }
                if($_SESSION['role'] == 'seller'){
                    header("location: seller_dashboard.php");
                }
                if($_SESSION['role'] == 'admin'){
                    header("location: admin.php");
                }
            }
            else{
                array_push($_SESSION['errors'],'Neuspešno logovanje. Proverite unete podatke i pokušajte ponovo');
                header("location:login.php");
            }
        }
        else{
            header("location: login.php");
        }
    }
    else if(!isset($_SESSION['username'])){
        header("location: home_page.php");
    }
    else if(isset($_SESSION['username'])){
        header("location: home_page.php");
    }

?>