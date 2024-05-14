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
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/Statist.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/pic/logo.png">
    <title>Order Statistics</title>
    <style>
        body {
            background-image: url(images/background.png);
            background-repeat: no-repeat;
            background-size: 2000px 610px;
        }

        table {
            border-collapse: #f2f2f2;
            width: 50%;
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <h2 class="logo">MILKY</h2>
        <nav>
            <ul class="nav_list">
                <li><a href="admin_page.php">Home</a></li>
                <li><a href="myproducts-admin.php">Our products</a></li>
                <li><a href="index.php">clients</a></li>
                <li><a href="statistiques.php">Statistics</a></li>
                

                <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
                ?>

                <li><a href="product1.php"><i
                            class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a></li>
                <li><a href="prof-admin.php">profile</a></li>
                <li><a href="logout.php">logout</a></li>


            </ul>
        </nav>
    </header>
    <?php

    $sql = "SELECT name, DATE(order_date) AS order_date, total_price 
        FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $total_profit = array();

        echo "<table>";
        echo "<tr><th>Nom</th><th>Order Date</th><th>Total Price</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["order_date"] . "</td><td>" . $row["total_price"] . "</td></tr>";

            $order_date = $row["order_date"];
            $total_profit[$order_date] = isset($total_profit[$order_date]) ? $total_profit[$order_date] + $row["total_price"] : $row["total_price"];
        }
        echo "</table>";
        echo "<br><br>";
        echo "<h2>Profit Today</h2>";
        echo "<table>";
        echo "<tr><th>Order Date</th><th>Total Profit</th></tr>";
        $total_final_price = 0;
        foreach ($total_profit as $date => $profit) {
            echo "<tr><td>$date</td><td>$profit</td></tr>";
            $total_final_price += $profit;
        }
        echo "</table>";
        echo "<br>";
        echo "<h2>Total Final Price: $total_final_price</h2>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>

</html>