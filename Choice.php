<?php
session_start();
if(!isset($_SESSION['ID'] )){
  header("Location:countPeopleVisit.php");
  exit();
}
  
extract($_POST);
//var_dump($_POST);

  $choice= $coffee;
  $who = $_SESSION['ID'];
  
  include "conn.php";
  $conn = getDBconnection();
  $sql = "INSERT INTO orderlist (choices, orderByWho) VALUES ('$choice','$who');";
  $rs = mysqli_query($conn, $sql) or die('<div class= "error">SQL command fails :<br>'.mysqli_error($conn)."</div>");

  $num = mysqli_affected_rows($conn);
      if($num == 1){
        echo "<div class='form-msg'> A order is created successful<div>";
      // $msg = "A airwaybill is created successful";
      }else{
        echo "<div class='form-msg'>Order created unsuccessful</div>";
      }

  $_SESSION['ordered'] ="$choice";


  //
    $sql = "select max(orderID)  as orderID from orderlist where choices= '$choice' and orderByWho = '$who';";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");

    while ($rec = mysqli_fetch_assoc($rs)) {
        extract($rec);
        $_SESSION['orderID'] ="$orderID";
    }
    

  //



  mysqli_close($conn);
  header("Location:queue.php");

