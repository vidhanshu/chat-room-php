<?php

$room = $_POST['room'];


include 'db_connect.php';
$sql = "SELECT msg, stime, ip FROM messages WHERE room ='$room' ";
$res='';
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_assoc(($result))){

        $res.="<div class='container'>";
        $res.=$row['ip'];
        $res.=" says <p>".$row['msg']."</p>";
        $res.="<span class='time-right'>".$row['stime']."</span></div>";

    }
    echo $res;
}
