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

include_once 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>

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
        .container {
            padding: 20px 40px;
            font-size: 14px;
        }

        .container ul {
            position: relative;
            list-style: none;
            padding: 0;
        }

        .container ul:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ddd;
            width: 3px;
            height: 100%;
        }

        .container ul li {
            padding: 30px 30px;
            position: relative;
        }

        .selected div {
            color: tomato;
        }

        .container li span {
            position: absolute;
            left: -45px;
            font-size: 12px;
            background-color: #fff;
            padding: 10px 0;
            top: 20px;
            color: #aaa;
        }

        .container li div {
            margin-left: 50px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <ul>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is the latest news</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is the second latest news</div>
                </li>
                <li>
                    <span>2022-07-20 03:35</span>
                    <div>This is the third latest news</div>
                </li>
                <li class="selected">
                    <span>2022-07-20 03:35</span>
                    <div>This is the third latest news</div>
                </li>
            </ul>
        </div>
        <textarea class="textarea" style="resize: none;" id="testarea"></textarea>
        <button class="button is-rounded mr-4 is-info" id="testBtn"> <i class="fa-solid fa-plus mr-3"></i>test</button>
    </div>
</body>

<!--EXTERNAL JAVASCRIPT
<script src="js/login.js"></script>
-->
<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");

    let testarea = document.getElementById("testarea");
    let testBtn = document.getElementById("testBtn");



    testBtn.addEventListener('click', () => {
        alert(testarea.value);
    });
</script>

</html>