<?php session_start(); 
 include('inc/header.php'); 

    if(isset($_GET['id'])){
        $conn = mysqli_connect("localhost","root","","crud_basic");

        if(!$conn){
            echo "Error : " . mysqli_connect_error($conn);
    }
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        $_SESSION['error'] = "data not exists !";
        header("location:index.php");
        die;
    }
}

?>

    <h1 class="text-center col-12 bg-primary py-3 text-white my-2">Edit Info About User</h1>
    <div class="col-md-6 offset-md-3">
    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['success']; ?>
                            <?php unset($_SESSION['success']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']) ?>
                        </div>
                    <?php endif; ?>
        <form  method="POST" action="handelers/edit.php?id=<?php echo $_GET['id'];?>" >
            <div class="form-group" >
                <label for="exampleInputName1">Full Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>"  class="form-control" id="exampleInputName1" >
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email address</label>
                <input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <!-- <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div> -->
         
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
   
<?php  include('inc/footer.php'); ?>

 
  