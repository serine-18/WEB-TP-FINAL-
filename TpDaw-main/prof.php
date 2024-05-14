<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}
;

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
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

<body>
   <header>
      <h2 class="logo">Milky</h2>
      <nav>
            <ul class="nav_list">
                <li><a href="user_page.php" class="style1">Home</a></li>
                <li><a href="myproducts.php">Our Products</a></li>
                <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
                ?>
                 <li><a href="product.php"><i
                            sclass="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a></li>
            
                <li><a href="prof.php" class="style1">profile</a></li>
                <li><a href="logout.php" class="style1">logout</a></li>
            </ul>
        </nav>
      </nav>
   </header>
   <div class="container">
   
      <div class="profile">
         <?php
         $select = mysqli_query($conn, "SELECT * FROM `prof` WHERE id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
         }
         if ($fetch['image'] == '') {
            echo '<img src="images/default-avatar.png">';
         } else {
            echo '<img src="uploaded_img/' . $fetch['image'] . '">';
         }
         ?>
         <h3>Full Name: <?php echo $fetch['name']; ?></h3>
         <h3>Email: <?php echo $fetch['email']; ?></h3>

         <a href="update_profile.php" class="btn">update profile</a>

      </div>

   </div>

</body>

</html>