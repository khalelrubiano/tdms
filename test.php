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
    <title>Test</title>

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
    <div class="main" style="margin-bottom: 20%;">
        <div class="container" style="margin-bottom: 2%;">
            <p class="title" id="arrayLengthHidden">sample</p>
            <p class="title" id="test_indicator">Test</p>
            <p class="title" id="indicator">Live Search Indicator</p>
            <button class="button is-rounded mr-4 is-info" onclick="openAdd()"> <i class="fa-solid fa-user-plus mr-3"></i>Register Client</button>

            <div class="select is-rounded is-hidden" id="selectSortDiv">
                <select id="selectSort">
                    <option value="client.client_name" selected>Sort By Client Name</option>
                </select>
            </div>

            <div class="field" id="searchBarForm">
                <p class="control has-icons-right">
                    <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
                    <span class="icon is-small is-right">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </p>
            </div>

        </div>

        <div class="container" id="ancestorTile">


        </div>

    </div>

    <!-- ADD MODAL -->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-primary">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-plus mr-3"></i>Register Client</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Client Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter client name here" class="input is-rounded" name="clientNameAdd" id="clientNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="clientNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Client Address</label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Enter location here" name="clientAddressAdd" id="clientAddressAdd" style="resize: none;"></textarea>
                    </div>
                    <p class="help" id="clientAddressAddHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
                        <i class="fas fa-paper-plane mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitAddFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/test.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    clientViewListBtn.classList.add("is-active");
</script>

</html>