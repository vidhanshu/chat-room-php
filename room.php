<!-- CODING ORDER INDEXES 5 -->

<?php
$roomname = $_GET["roomname"];
// echo $roomname;//checking purpose

//Connecting to the data base
include 'db_connect.php';

//Execute sqlto check wheather th room exists so that no on can come by making custome links into the rooms 
//any person can come only if room exist;

$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);

if ($result) {

    if (mysqli_num_rows($result) == 0) {
        echo "
        <script>
        alert('This room doesnt exist')
        window.location.href='http://localhost/chatroom/';
        </script>
        ";
    } else {
        // echo
        // "<script> alert('Welcome to the room $roomname 🏠') </script>";
    }
} else {
    echo "ERROR: " . mysqli_error($conn);
}
?>

<!-- CODING ORDER INDEXES 5 -->
<!DOCTYPE html>
<html>

<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='room.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <main>

        <h2>Chat Messages - <?php echo $roomname; ?> 🏠</h2>
        <div class="messages">

        </div>
        <div class="send-container">
            <input placeholder="Enter You Message Here..." type="text" name="usermsg" id="usermsg" class="form-control">
            <button id="btnmsg" name="btnmsg" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>


    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
<script>
    /*-- CODING ORDER INDEXES 8 --*/
    setInterval(runFunction, 1000); //calling the runFunction everytime to check if there any other message

    function runFunction() {
        $.post('htcon.php', {
            room: '<?php echo  $roomname ?>'
        }, function(data, status) {
            // console.log(data);
            document.querySelector(".messages").innerHTML = data;
        });
    }

    /*-- CODING ORDER INDEXES 8 ENDED --*/

    /*-- CODING ORDER INDEXES 6 --*/

    //the below code is just to make message send using enter button
    const input = document.getElementById("usermsg");

    input.addEventListener('keyup', (evt) => {

        event.preventDefault();

        if (evt.keyCode === 13) {

            document.getElementById("btnmsg").click(); //clicked by the js

        }
    })

    //after clicking the send button post request will be sent with the text, roomname , ip 
    $("#btnmsg").click(function() {
        if ((input.value).trim() === '') {
            //if the text box is empty but the client tried to send the message
            alert("Enter message!");
        } else {
            const messageSent = new Audio("sent.wav");
            messageSent.play();
            //sending post request usig jquery
            //redirecting to the postmsg.php
            //$.post methods takes three arguments 
            //#1. name of php file to post request is to be sent
            //#2. object having data which is to be sent as the request
            //#3. callback function which takes two arguments 'data' and the 'status';


            $.post('postmsg.php', {
                    message: input.value,
                    room: '<?php echo $roomname ?>',
                    ip: "<?php echo $_SERVER['REMOTE_ADDR'] ?>"
                },
                //this function simply recieves the echoed content in the postmsg.php as a data argument
                function(data, status) {
                    //setting the innerHTML of the div having class name message
                    document.querySelector(".messages").innerHTML = data;
                    return false;
                });
        }
        //afte sending the message clearing the input of message input
        input.value = "";
    });

    /*-- CODING ORDER INDEXES 6 ENDE --*/
</script>

</html>