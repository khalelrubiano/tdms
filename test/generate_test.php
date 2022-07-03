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
    <title>GENERATE TEST</title>

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
    <section class="section">
        <div class="container">

            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
            <p class="title" id="indicator">1</p>
        </div>
        <button class="button" id="loadBtn"> LOAD MORE</button>


        <div class="field">
            <p class="control has-icons-right">
                <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
                <span class="icon is-small is-right">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </p>
        </div>


    </section>


</body>

<script>
    let ancestorTile = document.getElementById('ancestorTile')
    let indicator = document.getElementById('indicator')
    let searchBarInput = document.getElementById('searchBarInput')

    /*
        function generateUserList(currentPageNumberVar) {
            $.post("./classes/load-user-all.class.php", {}, function(data) {

                var jsonArray = JSON.parse(data);
                var finalLength = Math.ceil(jsonArray.length / 4)


                for (var i = 1; i <= finalLength; i++) {

                    var parentTile = document.createElement("div");
                    parentTile.classList.add('tile');
                    parentTile.classList.add('is-parent');
                    ancestorTile.appendChild(parentTile);

                    i3 = (i - 1) * 4;



                    for (var i2 = 0; i2 < 4; i2++) {

                        var childTile = document.createElement("div");
                        childTile.classList.add('tile');
                        childTile.classList.add('is-child');
                        childTile.innerHTML = "entry number: " + jsonArray[i3 + i2][0];
                        parentTile.appendChild(childTile);



                        if (i2 == 4) {
                            break;
                        }
                    }

                }

            });
        }

        function generateUserList3() {
            $.post("./classes/load-user-all.class.php", {}, function(data) {
                var jsonArray = JSON.parse(data);
                var finalLength = Math.ceil(jsonArray.length / 4)
                indicator.innerHTML = finalLength;
            });
        }

        function generateUserList2(currentPageNumberVar) {
            $.post("./classes/load-user.class.php", {
                currentPageNumber: currentPageNumberVar
            }, function(data) {

                var jsonArray = JSON.parse(data);

                if (currentPageNumber <= indicator.innerHTML) {
                    var parentTile = document.createElement("div");
                    parentTile.classList.add('tile');
                    parentTile.classList.add('is-parent');
                    ancestorTile.appendChild(parentTile);

                    for (var i = 1; i <= jsonArray.length; i++) {

                        var childTile = document.createElement("div");
                        childTile.classList.add('tile');
                        childTile.classList.add('is-child');
                        childTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                        parentTile.appendChild(childTile);

                    }
                }
            });
        }

        let currentPageNumber = 0;

        generateUserList3();


        window.addEventListener('scroll', () => {
            let scrollable = document.documentElement.scrollHeight - window.innerHeight;
            let scrolled = window.scrollY;

            if (Math.ceil(scrolled) === scrollable) {
                currentPageNumber = currentPageNumber + 1;
                //indicator.innerHTML = currentPageNumber;
                generateUserList2(currentPageNumber);
            }

        });


        loadBtn.addEventListener('click', () => {
            currentPageNumber = currentPageNumber + 1;
            generateUserList2(currentPageNumber);
            indicator.innerHTML = currentPageNumber;
        });
        */

    function generateUserList3(searchTerm) {
        $.post("./classes/load-user-live-search.class.php", {}, function(data) {
            var jsonArray = JSON.parse(data);
            
            for (var i = 0; i < jsonArray.length; i++) {

                switch (searchTerm) {

                    case jsonArray[i][0]:
                        console.clear();
                        console.log("Username")
                        indicator.innerHTML = "Username";
                        break;

                    case jsonArray[i][1]:
                        console.clear();
                        console.log("First Name")
                        indicator.innerHTML = "First Name";
                        break;

                    case jsonArray[i][2]:
                        console.clear();
                        console.log("Middle Name")
                        indicator.innerHTML = "Middle Name";
                        return "Success";

                    case jsonArray[i][3]:
                        console.clear();
                        console.log("Last Name")
                        indicator.innerHTML = "Last Name";
                        break;

                    case jsonArray[i][1] + " " + jsonArray[i][2] + " " + jsonArray[i][3]:
                        console.clear();
                        console.log("Full Name")
                        indicator.innerHTML = "Full Name";
                        break;

                    case jsonArray[i][4]:
                        console.clear();
                        console.log("Role")
                        indicator.innerHTML = "Role";
                        break;
                }

            }

        });

    }
    //generateUserList3('sampleuser6');

    searchBarInput.addEventListener('input', () => {
        generateUserList3(searchBarInput.value);
    });
</script>

</html>