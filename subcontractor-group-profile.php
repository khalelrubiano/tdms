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
            <button class="button is-rounded mb-5 is-info" id="registerBtn"><i class="fa-solid fa-plus mr-3"></i>Register Vehicle</button>
            <button class="button is-rounded mb-5 is-light" id="returnBtn"><i class="fa-solid fa-arrow-left mr-3"></i>Return</button>
            <p class="title has-text-centered is-3"><?php echo $_SESSION["groupName"] ?></p>
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
                    <option value="employee.first_name" selected>Sort By Name</option>
                    <option value="permission.role_name">Sort By Role</option>
                </select>
            </div>

            <p class="title mb-6 mt-6 is-4" id="vehicleHeader">Registered Vehicles:</p>
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child is-3 p-2">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    <i class="fa-solid fa-truck mr-3"></i>EFGH-456
                                </p>

                                <p class="card-header-icon has-text-danger">
                                    <i class="fa-solid fa-circle mr-3"></i>Inactive
                                </p>

                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <p class="title is-5 mb-6 has-text-centered">Driver: Jonas Adaoag</p>
                                    <p class="subtitle is-6 has-text-centered">Helper: Rod Torres</p>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item">Manage</a>
                            </footer>
                        </div>
                    </div>
                    <div class="tile is-child is-3 p-2">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    <i class="fa-solid fa-truck mr-3"></i>ABCD-123
                                </p>

                                <p class="card-header-icon has-text-primary">
                                    <i class="fa-solid fa-circle mr-3"></i>Available
                                </p>

                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <p class="title is-5 mb-6 has-text-centered">Driver: Adrian Lopez</p>
                                    <p class="subtitle is-6 has-text-centered">Helper: Joshua Corpuz</p>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item">Manage</a>
                            </footer>
                        </div>
                    </div>
                </div>
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
                        <input type="text" placeholder="Enter group name here" class="input is-rounded" name="groupNameAdd" id="groupNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="groupNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Vehicle Plate Number</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter group name here" class="input is-rounded" name="groupNameAdd" id="groupNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="groupNameAddHelp"></p>
                </div>
                
                <div class="field">
                    <label for="" class="label">Driver</label>
                    <div class="control">
                        <div class="select is-rounded" id="groupOwnerAddDiv">
                            <select id="groupOwnerAdd" name="groupOwnerAdd">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="groupOwnerAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Helper</label>
                    <div class="control">
                        <div class="select is-rounded" id="groupOwnerAddDiv">
                            <select id="groupOwnerAdd" name="groupOwnerAdd">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="groupOwnerAddHelp"></p>
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
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/subcontractor-group-profile.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    subcontractorGroupBtn.classList.add("is-active");
</script>

</html>