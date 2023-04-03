<?php
session_start();



if(isset($_GET['id'])){
    $conn = mysqli_connect("localhost","root","","crud_basic");

    if(!$conn){
        echo "Error : " . mysqli_connect_error($conn);
    }
}
 $id = $_GET['id'];
 $sql = "SELECT * FROM users WHERE id=$id";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_row($result);

 if(!$row){
    $_SESSION['error'] = "Data Not Exists";
    die;
 }

 else{
    $sql = "DELETE FROM users WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    $_SESSION['success'] = "item Deleted Successfully";
 }
 header("location:../index.php");
  
   


 
  