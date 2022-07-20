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
    <title>Group Profile</title>

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
            margin-bottom: 5%;

        }

        @media (min-width: 1000px) {
            #registerBtn {
                float: left;
            }

            #returnBtn {
                float: right;
            }

        }

        @media (max-width: 1000px) {

            #returnBtn {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            #registerBtn {
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }

        table {
            border: 1px solid #ccc;
            width: 100%;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table tr {
            border: 1px solid #ddd;
            padding: 5px;
            background: #fff;

        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table th {
            text-transform: uppercase;
            letter-spacing: 1px;
        }


        @media (max-width: 600px) {

            #card table {
                border: 0;
            }

            #card table thead {
                display: none;
            }

            #card table tr {
                margin-bottom: 20px;
                display: block;
                border-bottom: 2px solid #ddd;
                box-shadow: 2px 2px 1px #dadada;

            }

            #card table td {
                display: block;
                text-align: right;
                font-size: 13px;
                margin-top: 20px;
            }

            #card table td:last-child {
                border-bottom: 0;

            }

            #card table td::before {
                content: attr(data-label);
                float: left;
                text-transform: uppercase;
                font-weight: bold;
            }

            #card tbody {
                line-height: 0 !important;
            }

        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <p class="title is-hidden" id="arrayLengthHidden">sample</p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <button class="button is-rounded mb-5 is-info" id="registerBtn" onclick="openAdd()"><i class="fa-solid fa-plus mr-3"></i>Register Area & Rate</button>
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title has-text-centered is-3"><?php echo $_SESSION["clientName"] ?></p>
            <p class="title is-hidden" id="clientIdHidden"><?php echo $_SESSION["clientId"] ?></p>
            <p class="title is-hidden" id="areaIdHidden"></p>

        </div>

        <div class="container">
            <div id="card" class="mb-4 has-text-centered">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Area Name</th>
                            <th>Area Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableTbody">
                        <!--
                        <tr>
                        <td data-label="First Name"> John</td>
                        <td data-label="Last Name">Doe</td>
                        <td data-label="Address">123 Main Street</td>
                        <td data-label="City">Anytown</td>
                        <td data-label="State">MN</td>
                        <td data-label="Zip"> 12345</td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
            <nav class="pagination mt-6">
                <ul class="pagination-list">
                    <li>
                        <a class="pagination-link is-current" id="paginationIndicatorBtn">1</a>
                        <a class="pagination-link is-hidden" id="arrayLengthHidden"></a>
                    </li>
                </ul>
                <a class="pagination-previous is-disabled" id="paginationPreviousBtn">Previous</a>
                <a class="pagination-next" id="paginationNextBtn">Next page</a>
            </nav>
        </div>
    </div>

    <!-- ADD MODAL START-->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Register Area & Rate</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">
                <div class="field">
                    <label for="" class="label">Area Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter area name here" class="input is-rounded" name="areaNameAdd" id="areaNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="areaNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Area Rate</label>
                    <div class="control has-icons-left">
                        <input type=number min=0 max=999999 placeholder="0 - 999999" class="input is-rounded" name="areaRateAdd" id="areaRateAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="areaRateAddHelp"></p>
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
    <!-- ADD MODAL END-->
    <!-- EDIT MODAL START-->
    <div class="modal" id="editModal">
        <div class="modal-background" id="editModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Edit Area & Rate</p>
                <button class="delete" aria-label="close" onclick="closeEdit()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Area Rate</label>
                    <div class="control has-icons-left">
                        <input type=number min=0 max=999999 placeholder="0 - 999999" class="input is-rounded" name="areaRateEdit" id="areaRateEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="areaRateEditHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
                        <i class="fas fa-paper-plane mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitEditFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <!-- EDIT MODAL END-->
    <!-- EDIT MODAL START
    <div class="modal" id="editModal">
        <div class="modal-background" id="editModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Edit</p>
                <button class="delete" aria-label="close" onclick="closeEdit()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Commission Rate</label>
                    <div class="control has-icons-left">
                        <input type=number min=0 max=100 placeholder="0 - 100" class="input is-rounded" name="commissionRateEdit" id="commissionRateEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="commissionRateEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Driver</label>
                    <div class="control">
                        <div class="select is-rounded" id="driverEditDiv">
                            <select id="driverEdit" name="driverEdit">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="driverEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Helper</label>
                    <div class="control">
                        <div class="select is-rounded" id="helperEditDiv">
                            <select id="helperEdit" name="helperEdit">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="helperEditHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
                        <i class="fas fa-paper-plane mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitEditFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    -->
    <!-- EDIT MODAL END-->
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/client-profile.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    clientViewListBtn.classList.add("is-active");
</script>

</html>