<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body class="main_page"></body>
<?php
require '../Vendor/vendor/autoload.php';
include '../Vendor/rest/mongo.php';
session_start();
$db = new db();
if (isset($_POST['computerSpeed']) && isset($_POST['ballSpeed'])) {
    $record = array('computerSpeed' => $_POST['computerSpeed'], 'ballSpeed' => $_POST['ballSpeed'], 'login' => $_SESSION['login']);
    $flag = $db->insert($record);
    echo "Saved parameters: <br>";
    echo "Computer speed = ".$_POST['computerSpeed']."<br>";
    echo "Ball speed = ".$_POST['ballSpeed']."<br>";
    echo '<p><form class="form" action="../index.php">
    <input type="submit" value="Home page" />
    </form></p>' ;
}
?>