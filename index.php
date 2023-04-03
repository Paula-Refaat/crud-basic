<?php  include('inc/header.php'); ?>
<?php 
session_start();

$conn = mysqli_connect("localhost","root","","crud_basic");

    if(!$conn){
        echo "Error : " . mysqli_connect_error($conn);
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>
    <h1 class="text-center col-12 bg-primary py-3 text-white my-2">Home Page</h1>
    <div class="row">
        <div class="col-sm-12">
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
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'];?></th>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td>
                            <a class="btn btn-info" href="edit.php?id=<?php echo $row['id'];?>"> <i class="fa fa-edit"></i> </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="handelers/delete.php?id=<?php echo $row['id'];?>"><i class="fa fa-close"></i> </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php  include('inc/footer.php'); ?>

 
  