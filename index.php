<?php include_once "./autolode.php";?>
<!DOCTYPE html>
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

<div class="user-form w-25 mx-auto my-5">
<a class=" btn btn-primary" href="./users.php">All User</a>
    <br>
    <br>
<?php 
if( isset( $_POST['submit'] ) ){
    $fastname = $_POST['fastname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'] ?? '';
    $select = $_POST['select'];
    $agree = $_POST['agree'] ?? '';

    if( empty($fastname) || empty($lastname) || empty($email) || empty($password) || empty($gender) || empty( $select) || empty($agree)){
        $msg = alert('All Feild Are Requierd !' , 'danger');
    }else if(emailcheck($email)){
        $mass = "<span style=\"color:red\"> *Required </span>";
        $msg = alert('Please Check Your Email !' , 'warning');
    }else{
        //file upload?
       $file_name = fileupload($_FILES['image'], 'upload/');
        //database connection?
        connect() -> query("INSERT INTO users (fristname,lastname,email,password,gender,education,photo,agree) VALUES ('$fastname','$lastname','$email','$password','$gender','$select','$file_name','$agree')");

        $msg = alert('Data Stable' , 'success');
        clear();

    }
}
?>
<div class="card shadow">
    <div class="card-header">
         <h1 class="card-title">Sign Up</h1> 
    </div>
 <div class="card-body">
        <?php echo $msg ?? '';?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Frist Name</label>
            <input name="fastname" type="text" class="form-control" value="<?php echo old('fastname') ;?>"  >
        </div>
        
        <div class="form-group">
            <label for="">last Name</label>
            <input name="lastname" type="text" class="form-control" value="<?php echo old('lastname') ;?>"  >
        </div>
        
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="text" class="form-control" value="<?php echo old('email') ;?>" >
            <?php echo $mass ?? '';?>
        </div>
        <div class="form-group">
            <label for="">password</label>
            <input name="password" type="text" class="form-control" value="<?php echo old('password') ;?>" >
        </div>
        <div class="form-group my-1">
            <input name="gender" type="radio" <?php echo old('gender') == 'male' ? 'checked' : '';?> value="male" id="male"> <label for="male">Male</label>
            <input name="gender" type="radio" <?php echo old('gender') == 'female' ? 'checked' : '';?>  value="female" id="female"> <label for="female">Female</label>
        </div>     
        <div class="form-group my-1">
           <select name="select" id="" class="form-select">
                <option value="">-select-</option>
                <option <?php echo old('select') == 'JSC' ? 'selected' : '';?> value="JSC">JSC</option>
                <option <?php echo old('select') == 'SSC' ? 'selected' : '';?>  value="SSC">SSC</option>
                <option <?php echo old('select') == 'HSC' ? 'selected' : '';?>  value="HSC">HSC</option>
           </select>
        </div>
        <div class="form-group my-1">
            <img style="max-width: 100%;" id="preload" src="" alt="">
            <br>
         <input style="display: none;" name="image" type="file" class="form-control" id="photo" ><label for="photo"><img style="width: 50px; " src="./image/file.png" alt=""></label>
        </div>
        <div class="form-group my-1">
          <input name="agree" type="checkbox" value="checked" <?php echo old('agree') == 'check' ? 'checked' : '';?> id="check" ><label for="check">I Agree With You</label>
        </div>
        <div class="form-group m-2">
          <input name="submit" type="submit" class="btn btn-primary" value="Sign Up">
        </div>
        
        </form>
     </div>
  </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

    $('#photo').change(function(e){
        let url = URL.createObjectURL(e.target.files[0]);
        $('#preload').attr('src', url);
    });

</script>
</body>
</html>