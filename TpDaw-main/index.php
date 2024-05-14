<?php
include 'config.php';


$search = '';


if (isset($_POST['search'])) {
  $search = mysqli_real_escape_string($conn, $_POST['search']);
}

$sql = "SELECT id, name,  email, created_at, user_type FROM prof";

if (!empty($search)) {

  $sql .= " WHERE `name` LIKE '%$search%'";
}


$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">

 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poetsen+One&display=swap" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/pic/logo.png">
  <link rel="stylesheet" href="css/clients.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>MILKY</title>
</head>
<style>
   body{
      background-image: url(images/background.png) ;
        background-repeat:no-repeat;
        background-size: 1280px 610px;
   }
</style>
<body>

  <header>
    <h2 class="logo">MILKY</h2>
    <nav>
        <ul class="nav_list">
            <li><a href="admin_page.php">Home</a></li>
            <li><a href="myproducts-admin.php">Our products</a></li>
            <li><a href="index.php">clients</a></li>
            <li><a href="Statistiques.php">Statistics</a></li>
            <li><a href="prof-admin.php">profile</a></li>
            <li><a href="logout.php" >logout</a></li>
        </ul>
    </nav>
  </header>
  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <!-- Search form -->
    <form method="post" class="mb-3">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search by name" name="search"
          value="<?php echo $search; ?>">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">email</th>
          <th scope="col">created_at</th>
          <th scope="col">User Type</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["created_at"] ?></td>
                <td><?php echo $row["user_type"] ?></td>

                <td>
                  <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i
                      class="fa-solid fa-trash fs-5"></i></a>
                </td>
              </tr>
              <?php
            }
          } else {
            echo "0 results";
          }
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</body>

</html>