<?php
include "functions.php";
include "class/ClientList.php";

$list_client = new ClientList();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Page Catalogue</title>
</head>
<body>
<?php include "header.php" ?>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code postal</th>
            <th scope="col">Ville</th>
        </tr>
        </thead>
        <tbody>
        <?php
            displayAllClient($list_client->getListClient());
        ?>
        </tbody>
    </table>


    <a type="button" href="catalogue.php" class="btn btn-primary float-right " style="margin: 50px 0 100px 0">Retour</a>
</div>


<?php include "footer.php" ?>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
