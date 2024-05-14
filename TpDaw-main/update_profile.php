<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `prof` SET name = '$update_name', email = '$update_email', created_at=NOW() WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
      if ($update_pass != $old_pass) {
         $message[] = 'old password not matched!';
      } elseif ($new_pass != $confirm_pass) {
         $message[] = 'confirm password not matched!';
      } else {
         mysqli_query($conn, "UPDATE `prof` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/' . $update_image;

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image is too large';
      } else {
         $image_update_query = mysqli_query($conn, "UPDATE `prof` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if ($image_update_query) {
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/profile.css">
   <link rel="icon" type="image/png" sizes="32x32" href="./assets/pic/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poetsen+One&display=swap" rel="stylesheet">
    <title>MILKY</title>
   <!-- custom css file link  -->
   

</head>

<body class="UPD">

   <div class="update-profile">

      <?php
      $select = mysqli_query($conn, "SELECT * FROM `prof` WHERE id = '$user_id' LIMIT 1") or die('query failed');
      if (mysqli_num_rows($select) > 0) {
         $fetch = mysqli_fetch_assoc($select);
      }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <?php
         if ($fetch['image'] == '') {
            echo '<img src="images/default-avatar.png">';
         } else {
            echo '<img src="uploaded_img/' . $fetch['image'] . '">';
         }
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <div class="flex">
            <div class="inputBox">
               <span>Name :</span>
               <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
               <span>your email :</span>
               <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">

               <span>update your pic :</span>
               <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
               <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
               <span>old password :</span>
               <input type="password" name="update_pass" placeholder="enter previous password" class="box">
               <span>new password :</span>
               <input type="password" name="new_pass" placeholder="enter new password" class="box">
               <span>confirm password :</span>
               <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
            </div>
         </div>
         <input type="submit" value="update profile" name="update_profile" class="btn">
         <a href="prof.php" class="delete-btn">go back</a>
      </form>

   </div>

</body>

</html>