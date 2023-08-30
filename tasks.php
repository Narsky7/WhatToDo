<?php
session_start();
require'./config/db_connect.php';
require'./components/head.php';
if(!isset($_SESSION['name'])){
echo'<span class="login-message">you dont have permision to see this site, log in first</span>';
} else{
   $user = $_SESSION['name'];

    $sqlDaily = "SELECT * FROM tasks WHERE created_by = '$user' AND type ='daily' ";
$resultDaily = mysqli_query($conn, $sqlDaily);
$dailyTasks = mysqli_fetch_all($resultDaily);
mysqli_free_result($resultDaily);

$sqlAllTime = "SELECT * FROM tasks WHERE created_by = '$user' AND type ='alltime' ";
$resultAllTime = mysqli_query($conn, $sqlAllTime);
$allTimeTasks = mysqli_fetch_all($resultAllTime);
mysqli_free_result($resultAllTime);

if(isset($_POST['taskdone'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sqlDelete = "DELETE FROM tasks WHERE ID = '$id_to_delete'";

    if(mysqli_query($conn,$sqlDelete)){
        header("location: tasks.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php  ?>
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



    <h1 class="greetings">HELLO, <?= $_SESSION['name']?></h1>

    <div class="all-tasks">

        <div class="task-section"><h2>DAILY TASKS</h2>
    <?php 
    foreach($dailyTasks as $dailyTask){ ?>
<div class="task-obj">
    <div class="text-content">
<span>Title: <?=$dailyTask[1];?></span>
<span>Description: <?=$dailyTask[2];?> </span>
</div>
<form action="tasks.php" class="done-form" method="post">
    <input type="hidden" id="hidden" name="id_to_delete" value="<?=$dailyTask[0];?>">
    <input type="submit" class="done-btn" name="taskdone" value="done">
</form>
</div>
  <?php  }
    ?>
    </div>

        <div class="task-section"><h2>ALL-TIME TASKS</h2>
       
       <?php 
    foreach($allTimeTasks as $allTimeTask){ ?>
<div class="task-obj">
    <div class="text-content">
<span>Title: <?=$allTimeTask[1];?></span>
<span>Description: <?=$allTimeTask[2];?> </span>
</div>
<form action="tasks.php" class="done-form" method="post">
<input type="hidden" id="hidden" name="id_to_delete" value="<?=$allTimeTask[0];?>">
    <input type="submit" class="done-btn" name="taskdone" value="done">
</form>
</div>
  <?php  }
    ?>
    </div>

    </div>
</body>
</html>
<?php }?>