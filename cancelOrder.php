<?php
session_start();
$orderID = $_SESSION['orderID'];

include "conn.php";
$connection = getDBconnection();

//remove the record in queue first, then remove the record in the orderlist
$query = "DELETE FROM `queue` WHERE orderID='$orderID';";
$result = mysqli_query($connection, $query);

$query2 = "DELETE FROM `orderlist` WHERE orderID='$orderID';";
$result2 = mysqli_query($connection, $query2);


session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
        a{
            text-decoration: none;
        }
        h1, h2{
            text-align: center;
        }

        #button{
            margin-left: 45%;
        }
    </style>
</head>
<body>
<h1>Your Order has been canceled!</h1>

<h2>You can close the website</h2>
<button type="button" id="button"><a href="countPeopleVisit.php"> Order coffee again </a></button>
</body>
</html>

