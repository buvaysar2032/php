<?php
include_once('connect.php');

$id = $_GET['id'];

$pdoStatement = $pdo->prepare("
    DELETE FROM `users` WHERE id=$id    
");

if ($pdoStatement->execute()) {
    header('location: index.php');
}
