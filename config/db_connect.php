<?php

// connect to database
$conn = mysqli_connect('localhost', 'root', 'negro', 'ninja_pizza');

// check connection
if (!$conn) {
    echo 'Connnection error: ' . mysqli_connect_error();
}
?>