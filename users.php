<!DOCTYPE html>

    <?php 
    include_once "./autolode.php";

    /**
     * delete user id
     */
        $delete_id = $_GET['delete_id'] ?? false;
        if($delete_id){
            connect() -> query(" DELETE FROM users WHERE id='$delete_id' ");
            header('location:users.php');
        }

    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>CRUDS</title>
</head>
<body>

<style>
    /* td a {
    float: right;
    margin-left: 6px;
} */
</style>
<div class="wrap-table w-75">

    <a class="btn btn-primary" href="./index.php">Add New Studant</a>
    <br>
    <br>
    <div class="card shadow">
        <div class="card-body">
            <h1>All Data</h1>
            <table class="table table-striped">
               <thead>
                   <tr>
                       <th>#</th>
                       <th>Fristname</th>
                       <th>Lastname</th>
                       <th>Email</th>
                       <th>Password</th>
                       <th>Gender</th>
                       <th>Education</th>
                       <th>photo</th>
                       <th>Agree</th>
                       <th style="text-align:center">Action</th>
                   </tr>
               </thead>
               <tbody>

                <?php
                $sn = 1;
                    $data = connect() -> query("SELECT * FROM users");
                    while( $forms = $data -> fetch_object() ) :
                ?>
                   <tr>
                       <td><?php echo $sn++;?></td>
                       <td><?php echo $forms -> fristname;?></td>
                       <td><?php echo $forms -> lastname;?></td>
                       <td><?php echo $forms -> email;?></td>
                       <td><?php echo $forms -> password;?></td>
                       <td><?php echo $forms -> gender;?></td>
                       <td><?php echo $forms -> education;?></td>
                       <td> <img style=" max-width: 50px; max-height:50px" src="upload/<?php echo $forms -> photo;?>" alt=""> </td>
                       <td><?php echo $forms -> agree;?></td>
                       <td>
                       <a class="btn btn-sm btn-info" href="./singale.php?user_id=<?php echo $forms -> id?>">view</a>
                           <a class="btn btn-sm btn-warning" href="./edit.php?edit_id=<?php echo $forms -> id?>">edit</a>
                           <a id="delete_btn" class="btn btn-sm btn-danger" href="?delete_id=<?php echo $forms -> id;?>">delete</a>
                       </td>
                   </tr>
                    <?php endwhile;?>
               </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $('#delete_btn').click(function(){
        let conf = confirm('Are You Sure ?');
        if(conf){
            return true;
        }else{
            return false;
        }
    });
</script>

</body>
</html>