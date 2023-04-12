<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("Location:countPeopleVisit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
        a {
            text-decoration: none;
            color: black;
        }

        #f1 {
            /*padding-top: 50px;*/
            text-align: center;

        }

        img {
            width: 300px;
            height: 200px;
        }

        #submitChoice {
            margin: 3%;
        }

        .abc {
            display: block;
            }

        .def {
            display: inline-block;
            margin-top: 3%;

        }

        h1 {
            text-align: center;
        }

    </style>
</head>
<body>
<?php
if (!isset($_SESSION['ordered'])) {
    setcookie("visited", "You visited", time() + 5000);
    ?>
    <h1>Choose Your Coffee Type</h1>
    <form action="Choice.php" name="customerOrder" id="f1" method="post">
        <div class="abc">
            <div class="def">
                <input type="radio" name="coffee" id="Latte" value="Latte" checked>Latte
            </div>
            <div>
                <label for="Latte"><img src="./picture/photo1.jpg"></label>
            </div>
        </div class="def">
        <div class="abc">
            <div class="def">
                <input type="radio" name="coffee" id="Cappuccino" value="Cappuccino">Cappuccino
            </div>
            <div>
                <label for="Cappuccino"><img src="./picture/photo3.jpg"></label>
            </div>

        </div>
        <br>
        <input type="submit" id="submitChoice" value="submit">
        <button type="reset"><a href="countPeopleVisit.php">Cancel</a></button>
    </form>
    <?php
} else {
    header("Location:queue.php");
}

?>
</body>
</html>