<?php
require "./config/db_connect.php";
session_start();
session_destroy();

if(isset($_POST['submit'])){
    $name_passed = mysqli_real_escape_string($conn,$_POST['username']);
    $password_passed = mysqli_real_escape_string($conn,$_POST['password']);

    $sqlSelect = "SELECT username,password FROM users WHERE username = '$name_passed'";
    $result = mysqli_query($conn,$sqlSelect);
   
        $usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        if(empty($usernames)){
            $error = 'check your username';
        } else{
            $password_db = $usernames['0']['password'];
            if($password_passed != $password_db){
                $error = 'check your password';
            } else{
                session_start();
                $_SESSION['name'] = $name_passed;
                header('Location: tasks.php');
            }
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require'./components/head.php'; ?>
<body>
    <section class="logreg-page">
    <div class="gradient">
            <div class="login-section">
    <div class="login-container">
<h1>Log in</h1>
<form class="login-form" action="index.php" method="post">
<input required type="text" name="username" placeholder="username">
<input required type="password" name="password" placeholder="password">
<span><?php if(isset($error)){echo $error;}?></span>
<input id="submit-login" type="submit" name="submit" value="login">
</form>
<div>
<span>Don't have an account?</span>
<a href="register.php" id="login-link">Register Now</a>
</div>
    </div>
    </div>
    </div>
    <a class="creator" href="https://github.com/Narsky7">created by 𝖓𝖆𝖗𝖘𝖐𝖞</a>
    </section>
</body>
</html>