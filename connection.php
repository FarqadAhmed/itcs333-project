<?php

$host ='localhost';
$db = 'db';
$user = 'root';
$pass = "";

try {
    $pdo = new PDO('mysql:host=$host;dbname=$db;charset=utf8', $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = null;
} 


catch(PDOException $v) {
    echo "Error occured!"; 
    die ($ex->getMessage());
    }
}
?>