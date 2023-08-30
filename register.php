<?php
require "./config/db_connect.php";

$sqlSelect = "SELECT username FROM users";
$result = mysqli_query($conn,$sqlSelect);
$usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    foreach($usernames as $username){
        if ($name == $username['username']){
            $error = "nickname already taken";}
        } 
        
    if(!isset($error)){
            $sql = "INSERT INTO users(username,password) VALUES ('$name','$password')";

            if(mysqli_query($conn, $sql)){
                header("Location: index.php");
            } else {
                echo mysqli_error($conn);}};
        
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
<h1>Register</h1>
<form class="login-form" action="register.php" method="post">
<input type="text" required name="username" placeholder="username">
<input type="password" required name="password" placeholder="password">
<span><?php if(isset($error)){echo $error;}?></span>
<input id="submit-login" type="submit" name="submit" value="register">

</form>
<div>
<span>You already have an account?</span>
<a href="index.php" id="login-link">Log In</a>
</div>
        </div>
        </div>
        </div>
    <a class="creator" href="https://github.com/Narsky7">created by 𝖓𝖆𝖗𝖘𝖐𝖞</a>
    </section>
</body>
</html>