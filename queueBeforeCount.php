<?php
header('Content-Type:Application/json');
include "conn.php";


$conn = getDBconnection();
session_start();
$id=$_SESSION['id'];
$sql = "Select count(*)  as lineBefore from queue where status = 0 and queueID < '$id' ";
$rs = mysqli_query($conn,$sql) or die('<div class ="error"> SQL command fails : <br>'.mysqli_error($conn)."</div>");
$num = mysqli_num_rows($rs);

$queueCount=array();

while($rec = mysqli_fetch_assoc($rs)){
    extract($rec);
    $queueCount[]=$rec;
}

echo json_encode($queueCount,JSON_PRETTY_PRINT);

    
mysqli_free_result($rs);
mysqli_close($conn);
