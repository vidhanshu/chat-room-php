
<!-- CODING ORDER INDEXES 7 -->

<?php
include 'db_connect.php';//CONNECTING TO THE DATABASE
$message=$_POST['message'];//MESSAGE COMMING FROM THE ROOM.PHP FILE ENTERED BY THE USER
$roomName=$_POST['room'];//ROOMNAME COMING FROM THE ROOM.PHP FILE 
$ip=$_POST['ip'];//IP ADDRESS COMING FROM THE ROOM.PHP FILE 
$sql="INSERT INTO `messages` (`sno`, `msg`, `room`, `ip`, `stime`) VALUES ('', '$message', '$roomName', '$ip', current_timestamp())";//INSERTING INTO THE DATABASE->TABLE(NAMED message)
$result = mysqli_query($conn,$sql);//runnning the above query
if($result){
    //what to do if the query is successfully
}else{
    //what to do if the query failed to load
}
?>
<!-- CODING ORDER INDEXES 7 ENDED-->