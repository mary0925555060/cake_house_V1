<?php
session_start();
$id = $_GET['CartID'];
unset($_SESSION['Cart']);


header('Location: my_cart.php');
?>
