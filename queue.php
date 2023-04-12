<?php 
//if order session not set, return to order page
session_start();

if(!isset($_SESSION['ordered'])){
  header('Location:countPeopleVisit.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Coffee Queue</title>
</head>
<style type="text/css">
  #queueList {
    height: 300px;
    width: 300px;
    background-color: LemonChiffon;
    margin: auto;
    text-align: center;
    border: 1px solid white;
    box-shadow: 2px 2px 10px grey;

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

  h1 {
    background-color: mediumaquamarine;
    color: white;
    border-bottom: 2px solid white;
  }

  h3 {
    font-size: 5em;
  }


  h1,
  h3 {
    padding: 20px;
    margin: 0px;
  }
  h4 {
    display: inline-block;
  }
  
  #cancelOrder{
     text-align: center;
    margin: auto;
  }
  #finish{
    text-align: center;
    margin: auto;

  }
  a{
    font-size: 25px;
    color: darkviolet;
  }

</style>
<script src="jquery/jquery-2.1.4.js"></script>
<script type="text/javascript">

  function get_update() { //ajax function, get lastest update from database
  
    $.ajax(   //get the number of people line before you

      {
        type: 'GET',
        url: "queueBeforeCount.php", 
        dataType: "json", 
        success: function(result) { 

          document.getElementById('before').innerHTML = "<br>";


          for (i = 0; i < result.length; i++) {
            resultJson = `${result[i].lineBefore}`

              if(resultJson.length==1&&resultJson!=0){
                  resultJson="0"+resultJson;
              }

            if(resultJson==0){ // if no one line before you, go make coffee page
              document.getElementById('finish').innerHTML = `<button onclick="location.href = 'orderFinish.php';" id="finishButton">Finish</button>`;
              //location:complete.php  to reminder user to get the coffee
              //change page, update status here or update in next section
             // $id = $_SESSION['id'];
             // mysqli_query($connection, "UPDATE `queue` SET `status` = 1 WHERE `queueID` = `$id`);
            }
            document.getElementById('before').innerHTML = resultJson;
            document.getElementById('time').innerHTML = ((resultJson) * 1.2).toFixed(1);



          }



        }

      }

    )



      $.ajax( //get the queue list before the id

      {
        type: 'GET',
        url: "queueList.php", 
        dataType: "json",

        success: function(result) { 


          document.getElementById('queueList').innerHTML = "<h1>Queue before you: </h1><br>";


            //declare variable
            var queueText="";
            var lineBreak="";
            var count = 0 ;

          for (i = 1; i < result.length+1; i++) { //want to i start from 1, so the length have to +1 and result have to -1
            resultJson = `${result[i-1].queueID}`


              if(resultJson.length==1){         //if the number is one place
                  resultJson="0"+resultJson;    //add a zero, eg 1 -> 01
              }

            if(i%10==0){                        //if printed 10 number, then skip lines
                lineBreak="<br><br>";
            }else{
                lineBreak="";
            }

            if (i != result.length ) {  //if is not the last number, end with ,

                if (count%2==0) {       // see if the line we need to bold it
                    queueText += "<b>"+resultJson+"</b>" + ", "+lineBreak;
                }else{
                    queueText += resultJson + ", "+lineBreak;
                }
            } else {        //if is not the last number, end with nothing

                if (count%2==0) { // see if the line we need to bold it
                    queueText += "<b>"+resultJson+"</b>"+ ""+lineBreak;
                }else{
                    queueText += resultJson + ""+lineBreak;
                }

            }

              if(i%10==0){   // update the count to see if we need to bold line
                  count++;
              }




          }//document.getElementById('queueList').innerHTML += resultJson + "";
            document.getElementById('queueList').innerHTML +=queueText;

        }

      }

    )
  }
  setInterval(get_update, 3000);    //call the function every 3 sec
</script>

<body onload="get_update()">  <!-- get a update when page load-->
  <?php   //print the status



  if (isset($_SESSION['id'])) { //if set session then not make a new session file

    include "conn.php";
    $conn = getDBconnection();

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM queue where queueID= $id";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");

    $queueID = "";
    while ($rec = mysqli_fetch_assoc($rs)) {
      extract($rec);
      $queueID = $queueID;
      $time = date('H:i:s');
      echo "<div class='wrapper'><h1>Your ID:</h1> <h3>" . $queueID . "</h3>Order time: " . $orderTime . "<br><br>";
    }

    $sql = "SELECT count(*) as lineLegth  FROM queue where queueID<$id and status=false";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");
    while ($rec = mysqli_fetch_assoc($rs)) {
      extract($rec);
      echo "There are <a id='before'></a> person line before you, <br>estimate waiting time  is <a id='time'></a> mins.</div>";
    }
  } else {    //if set session then make a new session file and insert data to database
    date_default_timezone_set('Asia/Hong_Kong');

    include "conn.php";
    $conn = getDBconnection();
    $date = date('Y-m-d H:i:s');
    $orderID = $_SESSION['orderID'];
    $sql = "INSERT INTO queue(orderTime,`orderID`) VALUES ('$date',$orderID)";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");

    $sql = "SELECT * FROM queue ORDER BY queueID DESC LIMIT 1;";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");

    $queueID = "";
    while ($rec = mysqli_fetch_assoc($rs)) {
      extract($rec);
      $queueID = $queueID;

      echo "<div class='wrapper'><h1>Your ID:</h1> <h3>" . $queueID . "</h3>Order time: " . $orderTime . "<br><br>";
    }

    $sql = "SELECT count(*) as lineLegth  FROM queue where queueID<$queueID and status=false";
    $rs = mysqli_query($conn, $sql) or die('<div class ="error"> SQL command fails : <br>' . mysqli_error($conn) . "</div>");
    while ($rec = mysqli_fetch_assoc($rs)) {
      extract($rec);
      echo "There is <a id='before'></a> person line before you, <br>estimate waiting time  is <a id='time'></a> mins.</div>";
    }


    $_SESSION["id"] = $queueID;
  }


  ?>
  <br>
<!--
 <div id="queueList">
    <h1>Queue before you: </h1>
  </div>

-->



<script src="jquery/jquery-2.1.4.js"></script>
<script type="text/javascript">
    if(document.getElementById('queueList').style.lineHeight%2==0){
        document.getElementById('queueList').style.lineHeight
    }
</script>


  <br>
  <br>
<!--  for customer to cancel order-->\
 <div id ="cancelOrder">
  <form action="cancelOrder.php" name="removeOrder" method="post">
    <input type="submit" value="cancelOrder">
  </form>
  <br>
  </div>
  <div id="finish"></div>

</body>

</html>