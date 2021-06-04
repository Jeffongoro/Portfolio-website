<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/favics.png" />
</head>
<body>


<div class="alert alert-custom" role="alert">
  <center>Administrator Panel</center>
</div>
<div class="container">
    <div class="row">
        <div class="col">
        <img src="assets/sec.jpg" alt="" >
        <style>
        .alert-custom{
            background-color:#212529;
            color: #FFFFFF;
            }
        img {
            border-radius: 8px;
            height: 350px;
            width: 600px; 
            }
        .form-control:focus {
        border-color: #FF5841;
        
    } 
        
        </style>
        </div>

        <div class="col">
        <form style="margin-top:70px;" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
        
            <button type="submit" name="login" class="btn btn-secondary">Login</button>
            
            <p>
            Forgot Password ? <a href="register.php">Register</a> Now
            </p>
           
            </form>
        
        </div>

        <?php

        require('dbConnect.php');

        if(isset($_POST['login'])){
            //capture the data
            $username = $_POST['username'];
            $password = $_POST['password'];

            //select from the user table - where the email -> 
            //get the password - verify
            $sql = "SELECT * FROM `users` WHERE `username` = ?";


            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                //bind param
                mysqli_stmt_bind_param($stmt,'s',$param_username);
                //bind
                $param_username = $username;
       
                //excute the query
                if(mysqli_stmt_execute($stmt)){
                   //get the results
                   $result = mysqli_stmt_get_result($stmt);
                   if($result){
                    $numrows = mysqli_num_rows($result);
                    if($numrows>0){
                        //match
                        //fetch the records 
                        //verify the password
                        //successfully logined in

                        $row = mysqli_fetch_assoc($result);
                        $passwordHashedFromDb = $row['password'];
                        //verify the password
                        $verifyPassword = password_verify($password,$passwordHashedFromDb);
                        if($verifyPassword){
                            //logined successfulll
                            //output("Welcome -- dear ".$row['username']);
                            //
                            header('location:newform.php');
                            //session
                            //name
                            //id
                            session_start();
                            //set values
                            $_SESSION['name']=$row['name'];
                            $_SESSION['id']=$row['id'];
                            
                        }else{
                            output("Oops! Invalid email or password.Try again");
                        }

                       
    
                    }else{
                        //no
                        output("Invalid email address.Check and try again");
                    }
                }else{
                    output("Something went wrong".mysqli_error($conn));
                }

                }else{
                 output("Something went wrong ".mysqli_error($conn));
                }
       
       
            }else{
                output("Something wrong with the query".mysqli_error($conn));
            }
            
        }

        function output($message){
            echo"<h3>$message</h3>";
        }

        ?>
    </div>
</div>
<?php require_once('footer.php') ?> 
</body>
</html>