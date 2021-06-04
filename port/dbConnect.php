<?php
/**
 * connection to mysql db
 * 
 * user - root
 * database
 * password
 * user,password - auth
 * server - localhost
 * database
 * 
 * function - called
 * mysqli_connect()
 * connection
 * 
 */

 $conn = mysqli_connect("localhost","root","","portfolio");
 /*if($conn){
     echo "Connection successfull";
 }else{
     echo"Failed to establish a connection.".mysqli_connect_error();
 }
*/
?>