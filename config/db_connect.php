<?php 
//standard db connect 
$conn = mysqli_connect('removed');

if(!$conn){
    echo 'connection error' . mysqli_connect_error();
};
?>