<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = " SELECT * FROM prof WHERE email = '$email' && password = '$pass' ";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      if ($row['user_type'] == 'admin') {

         $_SESSION['user_id'] = $row['id'];
         header('location:prof-admin.php');

      } elseif ($row['user_type'] == 'user') {

         $_SESSION['user_id'] = $row['id'];
         header('location:prof.php');

      }
   } else {
      $message[] = 'incorrect email or password!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MILKY</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

</head>
<style>
   body{
      background-image: url(images/picture.png) ;
        background-repeat:no-repeat;
        background-size: 1280px 610px;
   }
</style>
<body>

   <div class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>login now</h3>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="submit" name="submit" value="login now" class="btn">
         <p>don't have an account? <a href="register.php">regiser now</a></p>
      </form>

   </div>

</body>

</html>