<?php
session_start();
require 'validation.php';

$conn = mysqli_connect("localhost","root","","crud_basic");
if(!$conn){
    echo "connect error " . mysqli_connect_error($conn);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_GET['id'];

    if(requireInput($_POST['name']) || requireInput($_POST['email'])) {
        $_SESSION['error'] = "This Field Is Require";
        header("location:../edit.php?id=$id");
        die;
    }

    $name = trim(htmlspecialchars(htmlentities($_POST['name'])));
    $email = trim(htmlspecialchars(htmlentities($_POST['email'])));


    if(minInput($name,3) || minInput($email,3)){
        $_SESSION['error'] = "This Field must be greater than 3 chars,numbers ";
        header("location:../edit.php");
        die; 
    }

    if(maxInput($name,25) || maxInput($email,25)){
        $_SESSION['error'] = "This Field must be less than 50 chars,numbers "; 
        header("location:../edit.php");
        die;
    }

    if(emailInput($email)){
        $_SESSION['error'] = "This Field must be require Email Address"; 
        header("location:../edit.php");
        die;
    }

    if(empty($_SESSION['error'])){
        $sql = "UPDATE `users` SET `name`='$name',`email`='$email' WHERE `id`=$id ";
        $result = mysqli_query($conn,$sql);


           if($result ){
            $_SESSION['success'] = "data updated succefully";
        }
    }else{
        header("location:../edit.php?id=$id");
        die;
    }


    // redirection 
    header("location:../index.php");
   
}