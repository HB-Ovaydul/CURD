<?php include_once "./autolode.php";

    $edit_id = $_GET['edit_id'] ?? false;
    if($edit_id){
        $data = connect() -> query("SELECT * FROM users WHERE id='$edit_id'");
        $edit_id_data = $data -> fetch_object();
        if($edit_id_data -> fristname == ''){
            header('location:users.php');
        }
    }else{
        header('location:users.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <title><?php echo $edit_id_data -> fristname;?></title>
</head>
<body>

<div class="user-form w-25 mx-auto my-5">
<a class=" btn btn-primary" href="./users.php">Update</a>
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
    $data_updated_at = date('Y-m-d H-i-s');


    if( empty($fastname) || empty($lastname) || empty($email) || empty($password) || empty($gender) || empty( $select) || empty($agree)){
        $msg = alert('All Feild Are Requierd !' , 'danger');
    }else if(emailcheck($email)){
        $mass = "<span style=\"color:red\"> *Required </span>";
    }else{

        $updated_photo = '' ?? '';
        if( !empty($_FILES['new_photo']['name']) ){
            $updated_photo = fileupload($_FILES['new_photo'], 'upload/');

        }else{
            echo $updated_photo = $edit_id_data -> photo;
        }

        connect() -> query("UPDATE users SET fristname='$fastname',lastname='$lastname',email='$email',password='$password',gender='$gender',education='$select',photo='$updated_photo',updated_at='$data_updated_at' WHERE id=$edit_id");
        $data = connect() -> query("SELECT * FROM users WHERE id='$edit_id'");
        $edit_id_data = $data -> fetch_object();
        $msg = alert('Profile Updated Successful !' , 'success');
    }
}
?>
<div class="card shadow">
    <div class="card-header">
         <h1 style="font-size: 30px;" class="card-title"><?php echo $edit_id_data -> fristname ?> Update Your Profile</h1> 
    </div>
 <div class="card-body">
        <?php echo $msg ?? '';?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Frist Name</label>
            <input name="fastname" type="text" class="form-control" value="<?php echo $edit_id_data -> fristname;?>" value="<?php echo old('fastname') ;?>"  >
        </div>
        
        <div class="form-group">
            <label for="">last Name</label>
            <input name="lastname" type="text" class="form-control" value="<?php echo $edit_id_data -> lastname;?>" value="<?php echo old('lastname') ;?>"  >
        </div>
        
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="text" class="form-control" value="<?php echo $edit_id_data -> email;?>" value="<?php echo old('email') ;?>" >
            <?php echo $mass ?? '';?>
        </div>
        <div class="form-group">
            <label for="">password</label>
            <input name="password" type="text" class="form-control" value="<?php echo $edit_id_data -> password;?>" value="<?php echo old('password') ;?>" >
        </div>
        <div class="form-group my-1">
            <input name="gender" type="radio" <?php echo $edit_id_data -> gender == 'male' ? 'checked' : '';?> value="male" id="male"> <label for="male">Male</label>
            <input name="gender" type="radio" <?php echo $edit_id_data -> gender == 'female' ? 'checked' : '';?> value="female" id="female"> <label for="female">Female</label>
        </div>     
        <div class="form-group my-1">
           <select name="select" id="" class="form-select">
               <option <?php echo $edit_id_data -> education == '' ? 'selected' : '';?> value=""></option>
               <option  <?php echo $edit_id_data -> education == 'JSC' ? 'selected' : '';?>  value="JSC">JSC</option>
               <option  <?php echo $edit_id_data -> education == 'SSC' ? 'selected' : '';?> value="SSC">SSC</option>
               <option  <?php echo $edit_id_data -> education == 'HSC' ? 'selected' : '';?> value="HSC">HSC</option>
           </select>
        </div>
        <div class="form-group my-1">
       <label for="photo"><img style="max-width: 100%; " src="upload/<?php echo $edit_id_data -> photo;?>" alt=""></label>  <input  name="new_photo" type="file" class="form-control" >
        </div>
        <div class="form-group my-1">
          <input name="agree" type="checkbox" value="checked" <?php echo old('agree') == 'check' ? 'checked' : '';?> id="check" ><label for="check">I Agree With You</label>
        </div>
        <div class="form-group m-2">
          <input name="submit" type="submit" class="btn btn-primary" value="Update Now">
        </div>
        
        </form>
     </div>
  </div>
</div>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>