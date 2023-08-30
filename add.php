<?php
require './config/db_connect.php';
require'./components/head.php';
session_start();

if(!isset($_SESSION['name'])){
    echo'<span class="login-message">you dont have permision to see this site, log in first</span>';
} else {

if(isset($_POST['submit'])){
    $type = mysqli_real_escape_string($conn,$_POST['type']) ;
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if($description == ""){
        $description = "none";
    }
    $created_by = $_SESSION['name'];

    $sql = "INSERT INTO tasks(title,description,type,created_by) VALUES ('$title','$description','$type','$created_by')";
    if(mysqli_query($conn,$sql)){
        header("Location: tasks.php");
    } else{
        $error = mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
<div class="gradient-nav">
    <div class="navbar">
        <a id="logo" href="tasks.php">WhatToDo </a>
        <div class="links">
            <a href="tasks.php">my tasks</a>
            <a href="add.php">add task</a>
            <a href="index.php">log out</a>
        </div>
    </div>
    </div>

    <div class="add-section">
        <h1>ADD TASK</h1>
    <form action="add.php" class="add-form" method="post">
        <input type="text" required name="title" maxlength="254" placeholder="title">
        <textarea name="description" maxlength="254" placeholder="description"></textarea>

 <div class="radios">
 
<input type="radio" class="radio-input" name="type" value="daily" required>
<span>daily</span>
<input type="radio"  class="radio-input" name="type" value="alltime">
<span>all_time</span>

 </div>
        <input type="submit" id="add-btn" name="submit" value="add task">
        <span><?php if(isset($error)){echo $error;}?></span>
    </form>
    </div>
</body>
</html>
<?php }?>

