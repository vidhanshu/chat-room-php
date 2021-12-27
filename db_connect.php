<!-- CODING ORDER INDEXES 3 -->



<?php
$servername="localhost";
$username="root";
$password="";
$database="chatroom";

//Creating data base connection
$conn = mysqli_connect($servername,$username,$password,$database);
//Check connection
if(!$conn){
   die("Failed to connect".mysqli_connect_error()); 
}