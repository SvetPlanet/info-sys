<?php session_start();
$_SESSION["authorized"] = "no";
$_SESSION['login'] = null;
header('Location: index.php');
?>