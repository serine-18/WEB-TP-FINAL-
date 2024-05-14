<?php

$conn = mysqli_connect('localhost', 'root', '', 'user_prof');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>