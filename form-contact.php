<!DOCTYPE html>
<html lang="la">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    <title>AsesoresT24</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="//api.bitrix24.com/api/v1/dev/"></script>
</head>

<body>
    <?php
    require_once(__DIR__ . '/crest.php');

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    ?>
</body>