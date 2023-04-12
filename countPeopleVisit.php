<?php
session_start();

//connect to database
include "conn.php";
$connection = getDBconnection();

//adding new visitor
$visitor_ip = $_SERVER['REMOTE_ADDR'];
 //$visitor_ip = "127.0.0.10";

//checking if visitor is unique
$query = "SELECT * FROM count_table WHERE ip_address ='$visitor_ip'";
$result = mysqli_query($connection, $query);

//checking query error
if (!$result) {
  die("Retriving Query Error <br>".$query);
}

$total_visitors = mysqli_num_rows($result);

if ($total_visitors < 1) {
  $query = "INSERT INTO count_table(ip_address) VALUES('$visitor_ip')";
  $result = mysqli_query($connection, $query);
}


//retriving existing visitors
$query = "SELECT * FROM count_table";
$result = mysqli_query($connection, $query);

//checking query error
if (!$result) {
  die("Retriving Query Error <br>".$query);
}

$total_visitors = mysqli_num_rows($result);


// Save the Id in session
$query = "SELECT id FROM count_table WHERE ip_address ='$visitor_ip'";
$result = mysqli_query($connection, $query);
$rc = mysqli_fetch_assoc($result);
extract($rc);

$_SESSION['ID']= $id;

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <style type="text/css">
    a {
      text-decoration: none;
      font-size: 15px;
      font-family: Gabriola;
      text-align: center;
      margin: auto;
       }

    button {
      margin-top: 5%;
      background-color: sandybrown;
      border: 1px solid burlywood;
      
    }

    button:hover {
      background-color: saddlebrown;
    }

    .wrapper {
      height: 300px;
      width: 300px;
      background-color: aquamarine;
      margin-right: 5%;
      text-align: center;
      border: 1px solid white;
      box-shadow: 2px 2px 10px grey;
      display: inline-block;
    }

    h1 {
      background-color: mediumaquamarine;
      color: white;
      border-bottom: 2px solid white;
      font-family: Gabriola;
    }

    h3 {
      font-size: 5em;
    }

    h1,
    h3 {
      padding: 20px;
      margin: 0px;
    }

    #orderCoffee{
      font-size : 50px;
      width: 200%;
      height: 200px;
    }
    
    @media only screen and (min-width: 1px) {
      .flex-container{
        flex-wrap: wrap; 
        display: flex;
        margin-bottom: 3%;
      }
      button {
      margin-top: -1%;
      background-color: sandybrown;
      border: 1px solid burlywood;
    }
      .orderCoffeeChoice{
        text-align: center;
      }
      
    .wrapper {
      height: 350px;
      width: 300px;
      background-color: aquamarine;
      margin: auto;
      text-align: center;
      border: 1px solid white;
      box-shadow: 2px 2px 10px grey;
    }
  }
  </style>
  <title>Document</title>
</head>

<body>
<!--check online user-->
<!--参考网页 https://www.youtube.com/watch?v=9VVtUx3IaYI-->
<?php
$session = session_id();
$time = time();

$query = "SELECT * FROM onlinepeople WHERE session='$session'";
$result = mysqli_query($connection, $query);

$count = mysqli_num_rows($result);

if ($count == NULL) {
  mysqli_query($connection, "INSERT INTO onlinepeople (session,time) VALUES ('$session','$time')");

} else
  mysqli_query($connection, "UPDATE onlinepeople SET time='$time'WHERE session='$session'");
$count_user = mysqli_query($connection, "SELECT * From onlinepeople");
$count_user = mysqli_num_rows($count_user);

mysqli_query($connection, "DELETE FROM onlinepeople WHERE time  <  $time - 60*10");
?>
<!--


<div class="wrapper">
  <h1>Visitors Online</h1>
  <h3><?php echo $count_user; ?></h3>

</div>
<div class="wrapper">
  <h1>Visitor Count</h1>
  <h3><?php echo $total_visitors; ?></h3>
</div>



-->

<div class="flex-container">
  <div class="wrapper">
    <h1>People Queueing: </h1>

      <?php


      $sql = "SELECT COUNT(*) as count from queue where status = 0";
      $rs = mysqli_query($connection, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($connection) . "</div>");


      while ($rec = mysqli_fetch_assoc($rs)) {
        extract($rec);
          echo "<br><br><br><br>"."<h2 >".$count."</h2>";
      }


      ?>


  </div>
</div>
 <div class="flex-container">
  <div class="wrapper">
    <h1>Estimated time:</h1>

    <?php
    $sql = "SELECT COUNT(*) as count from queue where status = 0";
    $rs = mysqli_query($connection, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($connection) . "</div>");



      echo "<br><br><br><br>"."<h2>".($count*1.2)." mins</h2>";


    ?>

  </div>
</div>

<!--easy count easy go 1-->
<!--check online user-->
<?php
//$_SESSION["countPeopleVisit"] = $_SESSION["countPeopleVisit"] + 1;
////test
////echo "page views:".$_SESSION["countPeopleVisit"];
//?>
<!--<div class="wrapper">-->
<!--  <h1>Online Count</h1>-->
<!--  <h3>--><?php //echo $_SESSION["countPeopleVisit"]; ?>
<!--</h3>-->
<!---->
<!--</div>-->




<div class="orderCoffeeChoice">
  <button><a id="orderCoffee" href="Order.php">Order Coffee</a></button>
</div>

</body>
</html>
