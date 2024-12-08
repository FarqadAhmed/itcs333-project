<?php
try{
$db = new PDO('mysql:host=localhost;dbname=bookings;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex) {
    die ("ERROR :" .$ex->getMessage());
}
try{
    $db = new PDO('mysql:host=localhost;dbname=room;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex) {
        die ("ERROR :" .$ex->getMessage());
    }
    try{
        $db = new PDO('mysql:host=localhost;dbname=timeslots;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex) {
            die ("ERROR :" .$ex->getMessage());
        }
?>