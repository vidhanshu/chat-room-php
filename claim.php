<!-- CODING ORDER INDEXES 2 -->






<?php


/* -----Getting the value of the post parameter from the index.php form----- */
$room = $_POST['chatroom'];

/* ------ROOM NAME VALIDATION START----- */

if (strlen($room) > 20 or strlen($room) < 1) {
    echo "
    <script>
    alert('Please Enter chatroom name b/w 1-20 chars!')
    window.location.href='http://localhost/chatroom/';
    </script>
    ";
} elseif (!ctype_alnum($room)) {
    echo "
    <script>
    alert('Please Enter chatroom name as alphanumeric chars ONLY!')
    window.location.href='http://localhost/chatroom/';
    </script>
    ";
} else {
    //connecting to the database
    include "db_connect.php";
}
/* ------ROOM NAME VALIDATION END----- */

/* -- CODING ORDER INDEXES 4 -- */

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if ($result) {

    //Don't use \n in the alert boxes it gives an error
    if (mysqli_num_rows($result) > 0) {
        echo "
        <script>
        alert('Please choose different chatroom name This is alredy in use!')
        window.location.href='http://localhost/chatroom/';
        </script>
        ";
    } else {
        $sql = "INSERT INTO `rooms` (`sno`, `roomname`, `stime`) VALUES ('','$room',current_timestamp())"; //give empty quotes for the values which will be auto generated
        if (mysqli_query($conn, $sql)) {
            echo   "
            <script>
            alert('You room is ready 😀 Go and chat!');
            window.location.href='http://localhost/chatroom/room.php?roomname=$room';
            </script>";
        }
    }
} else {
    //you can write if your data base crashes
    echo "Error: " . mysqli_error($conn);
}
