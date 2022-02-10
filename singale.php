<!DOCTYPE html>

    <?php 
    include_once "./autolode.php";
        $user_id = $_GET['user_id'] ?? false;
        if($user_id){
           $data = connect() -> query("SELECT * FROM users WHERE id='$user_id'");
           $user_data = $data -> fetch_object();
           if($user_data -> fristname == ''){
            header('location:users.php');
           }
        }else{
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
    <title><?php echo $user_data -> fristname ;?></title>
</head>
</body>

<style>
    .single-page{
    width: 400px;
    margin: 100px auto 0;
    text-align: center;
}
.single-page img{
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;

}

</style>

<div class="single-page">
    <img src="upload/<?php echo $user_data -> photo ;?>" alt="">
    <h1><?php echo $user_data -> fristname ;?></h1>
    <h2><?php echo $user_data -> lastname ;?></h2>
    <h3><?php echo $user_data -> email ;?></h3>
    <a class="btn btn-primary" href="./users.php">back</a>

</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>