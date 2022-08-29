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

            #searchBarForm {
                float: right;
            }

            #selectSortDiv {
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

            #searchBarForm {
                padding-top: 10px;
                padding-bottom: 10px;
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
            <button class="button is-rounded mb-5 is-info" id="registerBtn" onclick="openAdd()"><i class="fa-solid fa-plus mr-3"></i>Register Vehicle</button>
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title has-text-centered is-3"><?php echo $_SESSION["groupName"] ?></p>
            <p class="title is-hidden" id="groupIdHidden"><?php echo $_SESSION["groupId"] ?></p>
            <p class="title is-hidden" id="vehicleIdHidden"></p>
            <p class="subtitle has-text-centered mb-6 is-5"><a class=""><?php echo $_SESSION["ownerFirstName"] . " " . $_SESSION["ownerLastName"] ?></a></p>

        </div>

        <div class="container">
            <div class="field" id="searchBarForm">
                <p class="control has-icons-right">
                    <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
                    <span class="icon is-small is-right">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </p>
            </div>

            <div class="select is-rounded mr-3" id="selectSortDiv">
                <select id="selectSort">
                    <option value="vehicle.plate_number" selected>Sort By Plate Number</option>
                    <option value="vehicle.vehicle_status">Sort By Status</option>
                </select>
            </div>

            <p class="title mb-6 mt-6 is-4" id="vehicleHeader">Registered Vehicles:</p>
            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
        </div>
    </div>

    <!-- ADD MODAL START-->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Register Vehicle</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">
                <div class="field">
                    <label for="" class="label">Vehicle Plate Number</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter vehicle plate number here" class="input is-rounded" name="plateNumberAdd" id="plateNumberAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="plateNumberAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Commission Rate</label>
                    <div class="control has-icons-left">
                        <input type=number min=0 max=100 placeholder="0 - 100" class="input is-rounded" name="commissionRateAdd" id="commissionRateAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="commissionRateAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Driver</label>
                    <div class="control">
                        <div class="select is-rounded" id="driverAddDiv">
                            <select id="driverAdd" name="driverAdd">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="driverAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Helper</label>
                    <div class="control">
                        <div class="select is-rounded" id="helperAddDiv">
                            <select id="helperAdd" name="helperAdd">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="helperAddHelp"></p>
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
    <!-- EDIT MODAL END-->
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/subcontractor-group-profile.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    subcontractorGroupBtn.classList.add("is-active");
</script>

</html>