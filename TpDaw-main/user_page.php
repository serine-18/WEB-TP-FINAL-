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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home-page.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/pic/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>MILKY</title>
</head>

<body>
     <!--  Milk<-->
  <div class="slide1">
    <header>
        <h2 class="logo">MILKY</h2>
        <nav>
         <ul class="nav_list">
            <li><a href="user_page.php">Home</a></li>
            <li><a href="myproducts.php">Our products</a></li>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
                ?>

                <li><a href="product.php"><i
                            class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a></li>
      
            <li><a href="prof.php">profile</a></li>
            <li><a href="logout.php" class="btn">logout</a></li>
         </ul>
      </nav>
   </header>
 
   <div class="page1">
     <div class="discription1">
      <h1 id="h11">MILK</h1>
      <p id="p1">Experience the nourishing power of milk!<br>Packed with essential nutrients like calcium and protein,<br> our farm-fresh milk supports strong bones and muscles.<br> Elevate your health and wellness with every sip. <br>
       Discover the goodness today!</p>
     </div>
     <div class="milk-image1"> <img src="images/Design_sans_titre__2_-removebg-preview__1_-removebg-preview (2)(1).png" width="600" alt=""></div>
   </div>
   <a href= "myproducts.php"><button class="btn-1">Buy Now</button></a>
    </div>

   <!-- Strawberry Milk<-->

   <div class="slide2">
   <div class="page2">

   <div class="milk-image2"> <img src="images/Premium_PSD___Strawberry_milk__background_template_3d_render-removebg-preview.png" width="550" alt=""></div>
     <div class="discription2">
     <h1 id="h12">Strawberry Milk</h1>
      <p id="p2">Indulge in the sweet delight of our Strawberry Milk!<br> Made with the finest strawberries and farm-fresh milk,<br> it's a refreshing blend packed with flavor and nutrients. <br>Savor the goodness in every sip. <br>Try it today!</p>
     </div>
    
   </div>
   <a href= "myproducts.php"><button class="btn-2">Buy Now</button></a>
    </div>
   
   
   </div>
   
   <!-- Banana Milk<-->
   <div class="slide3">
   <div class="page3">

     <div class="discription3">
     <h1 id="h13">Banana Milk</h1>
      <p id="p3">"Experience a tropical twist with our Banana Milk!<br> Crafted with ripe bananas and creamy milk,<br> it's a delicious fusion of flavor and nutrition.<br> Elevate your taste buds with every sip.<br> Taste the richness today!</p>
     </div>
     <div class="milk-image3"> <img src="images/bananaMilk.png" width="480" alt=""></div>

   </div>
   <a href= "myproducts.php"><button class="btn-3">Buy Now</button></a>
    </div>
   </div>
   
   <!-- blueberry Milk<-->
   <div class="slide4">
   <div class="page4">

   <div class="milk-image4"> <img src="images/blueberryMilk.png" width="480" alt=""></div>

     <div class="discription4">
     <h1 id="h14">BlueBerry Milk</h1>
      <p id="p4">Discover the vibrant taste of our Blueberry Milk!<br> Bursting with the goodness of ripe blueberries and creamy milk,<br> it's a delightful blend that's both refreshing and nutritious.<br> Experience the essence of blueberries in every sip.<br> Try it now!</p>
     </div>

   </div>
    <a href= "myproducts.php"><button class="btn-4">Buy Now</button></a>
    </div>
   </div>
 </body>

</html>