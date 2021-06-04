<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | Form Data</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/x-icon" href="assets/favics.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
<div class="alert alert-custom" role="alert">
  <center>Update Details</center>
</div>
<style>
        body {
        background-image: url('assets/plain.jpg');
        }
        .alert-custom{
            background-color:#212529;
            color: #FFFFFF;
            }
</style>
<?php
   

    //capture the id number
    //
    $id = $_GET['id'];
    //fetch the records 
    //require
    require('dbConnect.php');
    $sql = "SELECT * FROM form WHERE id=".$id;
    //execute
    $result = mysqli_query($conn,$sql);

    if($result){
        //get values
        $row = mysqli_fetch_assoc($result);
    }else{
        echo "<h3>No data available</h3>";
    }
?>


<div class="container">

    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputName" name="name" value=<?php echo$row['name'] ?>  type="text"/>
                                <label for="inputName">Full name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="email" value=<?php echo$row['email'] ?>  type="email"/>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPhone" name="phone" value=<?php echo$row['phone'] ?>  type="tel" />
                                <label for="inputPhone">Phone number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="inputMessage" name="message" value=<?php echo$row['message'] ?> type="text"  style="height: 10rem"></textarea>
                                <label for="inputMessage">Message</label>
                            </div>
                            <div class="d-grid"><button class="btn btn-primary btn-xl" name="update" type="submit">Update Data</button></div>
                        </form>
                    </div>
    </div>


<?php

require('dbConnect.php');

if(isset($_POST['update'])){
    //capture the data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
   

    //cpature
    //save to the database?
    
    /**
     * connection-
     * go database operation
     * insert
     * read 
     * 
     * 
     */

     //insert
     $sql = "UPDATE `form` SET `name`=?,`email`=?,`phone`=?,`message`=? WHERE id=".$id;
     //insert - SQL INJECTION
     //check valid of the query
     $stmt = mysqli_prepare($conn,$sql);
     if($stmt){
         //bind param
         mysqli_stmt_bind_param($stmt,'ssss',$param_name,$param_email,$param_phone,$param_message);
         //bind
         $param_name = $name;
         $param_email = $email;
         $param_phone = $phone;
         $param_message = $message;
    

         //excute the query
         if(mysqli_stmt_execute($stmt)){
             echo "Client $name details updated successfully!";

             //redirect to show formdata
             //header
             header('location:newform.php');
         }else{
            echo "Student $name not updated.Try again ".mysqli_error($conn);
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