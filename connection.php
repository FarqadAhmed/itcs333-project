<?php
try{
$db = new PDO('mysql:host=localhost;dbname=project_itcs333;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex) {
    die ("ERROR :" .$ex->getMessage());
}
?>