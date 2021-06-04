<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register || Admin</title>
    <link rel="icon" type="image/x-icon" href="assets/favics.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>


<div class="alert alert-custom" role="alert">
  <center>Add Administrator</center>
</div>

<div class="container">
    <div class="row">
        <div class="col">
        <img src="assets/admin.jpg" alt="" >
        <style>
        .alert-custom{
            background-color:#212529;
            color: #FFFFFF;
            }
        img {
            border-radius: 8px;
            height: 350px;
            width: 600px; 
            margin: auto;
            }
        .form-control:focus {
        border-color: #FF5841;
        
    } 
        
        </style>
        </div>

        <div class="col">
        <form style="margin-top:50px;" method="POST">
        
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
        
            <button name="register" type="submit" class="btn btn-primary">Register</button>

            <p>
            Already have an account? <a href="admin.php">Login</a> Now
            </p>
            </form>
        
        </div>
    </div>

    
<?php

require('dbConnect.php');

if(isset($_POST['register'])){
    //capture the data
    $username = $_POST['username'];
    $password = $_POST['password'];


    //hash our password
    //password_hash 
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);

     //insert
     $sql = "INSERT INTO `users`(`username`, `password`) VALUES (?,?)";
     //insert - SQL INJECTION
     //check valid of the query
     $stmt = mysqli_prepare($conn,$sql);
     if($stmt){
         //bind param
         mysqli_stmt_bind_param($stmt,'ss',$param_username,$param_password);
         //bind
         $param_username = $username;
         $param_password = $hashed_password;

         //excute the query
         if(mysqli_stmt_execute($stmt)){
             echo "User  registered successfully!";

             //redirect to admin login page
             //header
             header('location:admin.php');
         }else{
            echo "User  not registered.Try again ".mysqli_error($conn);
         }


     }else{
         echo "Something wrong with the query".mysqli_error($conn);
     }

}

?>
</div>
<?php require_once('footer.php') ?>
</body>
</html>