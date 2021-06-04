<?php
//include constants.php
include('dbConnect.php');
//1. get the ID of Admin to be delete
 $id = $_GET['id'];
//2. create SQL Query to Delete Admin
$sql = "DELETE FROM form WHERE id=$id ";
//Execute the Query
$result = mysqli_query($conn, $sql);
//Check whether the query executed or not
if($result==TRUE){
// echo "Admin deleted";
 //session variable to display session
 $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
 //redirect to manage admin page
 header("Location: newform.php");

} else{
 //echo "Failed to delete Admin";
 $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
 header(location:"newform.php");

}
//3.Redirect to  Admin page
?>