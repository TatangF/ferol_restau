<?php include('config/constants.php'); ?> 
<?php
date_default_timezone_set('Africa/Cameroun');
if($_SERVER["REQUEST_METHOD"]=="POST") // si l'utilisateur fait un post 
{
    if(isset($_POST['submit_message'])) //si le button submit_message est déclenché 
    {
        //recupération des variables nom, phone et corps du message
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $message_status = 'unread';
        $date = date("Y-m-d h:i:sa"); //recupération dynamique de la date : heure-minute-seconde du post message

        //insertion des eléments du message dans la table message
        $send_message = "INSERT INTO `message`(`name`, `phone`, `subject`, `message`, `message_status`, `date`) VALUES ('$name','$phone','$subject','$message','$message_status','$date')";
        $res_send_message = mysqli_query($conn, $send_message);

        if($res_send_message == true)
        {
            echo "<script>
                alert('Message Sent!'); 
                window.location.href='contact.php';
                </script>";
        }
        else
        {
            echo "<script>
                alert('Failed to send message'); 
                window.location.href='contact.php';
                </script>";
        }

    }   

}

