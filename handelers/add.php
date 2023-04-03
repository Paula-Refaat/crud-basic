<?php 
session_start();
require_once "./validation.php";

$conn = mysqli_connect("localhost","root","","crud_basic");

    if(!$conn){
        echo "Error : " . mysqli_connect_error($conn);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(requireInput($_POST['name']) || requireInput($_POST['email']) || requireInput($_POST['password'])) {
        $_SESSION['error'] = "This Field Is Requir";
        header("location:../add.php");
        die;
    }

    $name = trim(htmlspecialchars(htmlentities($_POST['name'])));
    $email = trim(htmlspecialchars(htmlentities($_POST['email'])));
    $password = sha1(trim(htmlspecialchars(htmlentities($_POST['password']))));

    if(minInput($name,3) || minInput($email,3) || minInput($password,3)){
        $_SESSION['error'] = "This Field must be greater than 3 chars,numbers ";
        header("location:../add.php");
        die; 
    }

    if(maxInput($name,25) || maxInput($email,25) || maxInput($password,50)){
        $_SESSION['error'] = "This Field must be less than 50 chars,numbers "; 
        header("location:../add.php");
        die;
    }

    if(emailInput($email)){
        $_SESSION['error'] = "This Field must be require Email Address"; 
        header("location:../add.php");
        die;
    }


    $sql = "INSERT INTO `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')";
    $result = mysqli_query($conn,$sql);

    header("location:../index.php");
}