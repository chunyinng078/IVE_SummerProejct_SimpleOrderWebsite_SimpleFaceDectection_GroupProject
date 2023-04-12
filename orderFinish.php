<?php 
//if order session not set, return to order page
session_start();

if(!isset($_SESSION['ordered'])){
  header('Location:countPeopleVisit.php');

}

include "conn.php";
    $conn = getDBconnection();

    $id = $_SESSION['id'];
    $sql = "UPDATE `queue` SET `status`=1 WHERE queueID = $id";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");
    $num = mysqli_affected_rows($conn);
    session_destroy();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Finish</title>
</head>
<style type="text/css">
  body {
    text-align: center;
    margin: auto;

  }
  </style>
<body>
<h1>Your Order is finished!</h1>
<img src="https://i.pinimg.com/originals/b9/2a/ed/b92aed64d74f836efdacc7653b794ab1.gif">
 <h2>You can close this tab <br><br> or</h2>
 <h2><a href="countPeopleVisit.php">  Order coffee again ~~!</a> </h2>
 

</body>
</html>