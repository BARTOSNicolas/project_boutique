<?php
include "functions.php";
global $item_1;

//Variables
$item_name = $item_1["name"];
$item_price = $item_1["price"];
$item_picture = $item_1["picture"];
$item_desc = $item_1["desc"];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Article </title>
</head>
<body>
<? include "header.php" ?>
<div class="container">
    <div class="card mb-3 d-flex .flex-column align-content-center">
        <div class="row no-gutters">
            <div class="col-2">
                <img src="img/<? echo $item_picture ?>" class="card-img-top" alt="Photo">
            </div>
            <div class="card-body col-8 p-2">
                <h5 class="card-title"><? echo $item_name ?></h5>
                <p class="card-text"><? echo $item_desc ?></p>
            </div>
            <div class="col-2 w-50 d-flex align-items-center">
                <a href="#" class="btn btn-primary w-100"><? echo $item_price ?> €</a>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
