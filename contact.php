<?php

$conn = mysqli_connect('localhost', 'root', '', 'tropicals_db') or die('connection failed');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message already sent!';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'Message sent!';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php @include 'header.php'; ?>

<section class="headings" style="background:url(images/background_2.jpg) no-repeat">
    <h3>Contact Us</h3>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>send us a message!</h3>
        <input type="text" name="name" placeholder="Name" class="box" required>
        <input type="email" name="email" placeholder="Email" class="box" required>
        <input type="number" name="number" placeholder="Phone Number" class="box" required>
        <textarea name="message" class="box" placeholder="Message" required cols="30" rows="10"></textarea>
        <input type="submit" value="send message" name="send" class="btn">
    </form>
</section>

<?php @include 'footer.php';?>

<script src="js/script.js"></script>

</body>
</html>

