<?php
//SESSION START
if (!isset($_SESSION)) {
    session_start();
}

/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
    header("location: dashboard-default.php");
    exit;
}
*/



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!--AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--BULMA CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!--FONTAWESOME CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--NAVBAR CSS-->
    <link rel="stylesheet" href="navbar.css">

    <!--INTERNAL CSS-->
    <style>

    </style>
</head>

<body>
    <h1 class="title" id="titleId"><strong>SAMPLE</strong></h1>
</body>

<script>
    let titleId = document.getElementById('titleId');

    function myFunction() {
        $.post("test_function.php", {
            //companyId: "2"
        }, function(data) {
            var jsonArray = JSON.parse(data); //JSON ARRAY TO NORMAL JAVASCRIPT ARRAY

            titleId.innerHTML = jsonArray[1][0];

            for (let i = 0; i < jsonArray.length; i++) {
                titleId.innerHTML = titleId.innerHTML + "<br>" + jsonArray[i][0] + jsonArray[i][2] + "<br>";
            }

        });
    }

    myFunction(); //AJAX
</script>

</html>