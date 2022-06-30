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
    <title>Employee</title>

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
        @media (min-width: 1000px) {
            #searchBarForm {
                float: right;
            }
        }

        @media (max-width: 1000px) {
            #searchBarForm {
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container" style="margin-bottom: 2%;">
            <p class="title" id="arrayLengthHidden">sample</p>
            <p class="title" id="test_indicator">Test</p>
            <div class="select">
                <select id="selectSort">
                    <option value="Name" selected>Sort By Name</option>
                    <option value="Role">Sort By Role</option>
                </select>
            </div>
            <form class="" id="searchBarForm">
                <div class="field">
                    <p class="control has-icons-right">
                        <input class="input is-rounded" type="text" placeholder="Search">
                        <span class="icon is-small is-right">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </p>
                </div>
            </form>
        </div>

        <div class="container">

            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
        </div>
    </div>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/employee-view-list.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    employeeViewListBtn.classList.add("is-active");
</script>

</html>