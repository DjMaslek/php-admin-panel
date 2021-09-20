<?php
include "config.php";

//if user isn't admin or signed in then redirect them on signup page
if($_SESSION['signed_user']['role'] == 'user' or (!isset($_SESSION['signed_user']))){
    header('Location: signup.php');
}

//delete selected user
$id = $_GET['id'];
$del = mysqli_query($conn,"DELETE FROM `users` WHERE id = '$id'");
if($del){
    header('Location: adminpanel.php');
    exit; 
} else {
    echo "An error occurred while deleting the user";
}
?>