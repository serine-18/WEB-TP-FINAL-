<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
;




if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/style2.css">

</head>

<body>
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
                <li><a href="logout.php">logout</a></li>


            </ul>
        </nav>
    </header>
    <section class="shopping-cart">

        <h1 class="title">products added</h1>

        <div class="box-container">

            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>
                    <div class="box">

                        <img src="milk/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
                        <div class="name"><?php echo $fetch_cart['name']; ?></div>
                        <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity"
                                class="qty">
                            <input type="submit" value="update" class="option-btn" name="update_quantity">
                        </form>
                        <div class="sub-total"> sub-total :
                            <span>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span>
                        </div>
                    </div>
                    <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">your cart is empty</p>';
            }
            ?>
        </div>

        <div class="cart-total">
            <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
            <a href="user_page.php" class="option-btn">continue shopping</a>
            <a href="order.php" class="btn  <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">proceed to checkout</a>
        </div>

    </section>


</body>

</html>