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
        html {
            background-color: #f4faff;
        }

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

            #createBtn {
                padding-top: 10px;
                padding-bottom: 10px;
                width: 100%;
                margin-bottom: 5%;
            }

            #selectSortDiv {
                margin-bottom: 10%;
            }

            #firstContainer {
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    <div class="main" style="margin-bottom: 20%;">
        <div class="container" style="margin-bottom: 2%;" id="firstContainer">
            <p class="title is-hidden" id="arrayLengthHidden">sample</p>
            <p class="title is-hidden" id="test_indicator">Test</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <p class="title is-hidden" id="editVarHidden"></p>

            <div class="field" id="searchBarForm">
                <p class="control has-icons-right">
                    <input class="input is-rounded" type="text" placeholder="Search" id="searchBarInput">
                    <span class="icon is-small is-right">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </p>
            </div>

            <button class="button is-rounded mr-4 is-info" onclick="openAdd()" id="createBtn"> <i class="fa-solid fa-user-plus mr-3"></i>Create Account</button>

            <div class="select is-rounded" id="selectSortDiv">
                <select id="selectSort">
                    <option value="employee.first_name" selected>Sort By Name</option>
                    <option value="permission.role_name">Sort By Role</option>
                </select>
            </div>



        </div>

        <div class="container">

            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
        </div>

    </div>

    <!-- ADD MODAL -->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-plus mr-3"></i>Create Account</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Employee Number</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter number here" class="input is-rounded" name="employeeNumberAdd" id="employeeNumberAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-hashtag"></i>
                        </span>
                    </div>
                    <p class="help" id="employeeNumberAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Username</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter username here" class="input is-rounded" name="usernameAdd" id="usernameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="usernameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Password</label>
                    <div class="control has-icons-left">
                        <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordAdd" id="passwordAdd">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <p class="help" id="passwordAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Confirm Password</label>
                    <div class="control has-icons-left">
                        <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordAdd" id="confirmPasswordAdd">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <p class="help" id="confirmPasswordAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">First Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter first name here" class="input is-rounded" name="firstNameAdd" id="firstNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="firstNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Middle Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter middle name here" class="input is-rounded" name="middleNameAdd" id="middleNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="middleNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Last Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter last name here" class="input is-rounded" name="lastNameAdd" id="lastNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="lastNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Role</label>
                    <div class="control">
                        <div class="select is-rounded" id="roleNameAddDiv">
                            <select id="roleNameAdd" name="roleNameAdd">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="roleNameAddHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitAddFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal" id="editModal">
        <div class="modal-background" id="editModalBg"></div>
        <div class="modal-card p-4">

            <header class="modal-card-head has-background-light">
                <p class="modal-card-title has-text-black"><i class="fa-solid fa-pen-to-square mr-3"></i>Edit Account</p>
                <button class="delete" aria-label="close" onclick="closeEdit()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Password</label>
                    <div class="control has-icons-left">
                        <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordEdit" id="passwordEdit">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <p class="help" id="passwordEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Confirm Password</label>
                    <div class="control has-icons-left">
                        <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordEdit" id="confirmPasswordEdit">
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <p class="help" id="confirmPasswordEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">First Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter first name here" class="input is-rounded" name="firstNameEdit" id="firstNameEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="firstNameEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Middle Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter middle name here" class="input is-rounded" name="middleNameEdit" id="middleNameEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="middleNameEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Last Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter last name here" class="input is-rounded" name="lastNameEdit" id="lastNameEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="lastNameEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Role</label>
                    <div class="control">
                        <div class="select is-rounded" id="roleNameEditDiv">
                            <select id="roleNameEdit" name="roleNameEdit">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="roleNameEditHelp"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-dark has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitEditFormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <p class="is-hidden" id="access1"><?php echo $_SESSION['shipmentAccess'] ?></p>
    <p class="is-hidden" id="access2"><?php echo $_SESSION['employeeAccess'] ?></p>
    <p class="is-hidden" id="access3"><?php echo $_SESSION['subcontractorAccess'] ?></p>
    <p class="is-hidden" id="access4"><?php echo $_SESSION['clientAccess'] ?></p>
    <p class="is-hidden" id="access5"><?php echo $_SESSION['billingAccess'] ?></p>
    <p class="is-hidden" id="access6"><?php echo $_SESSION['payrollAccess'] ?></p>
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/employee-view-list.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    employeeViewListBtn.classList.add("is-active");

    let access1 = document.getElementById('access1');

    let access3 = document.getElementById('access3');
    let access4 = document.getElementById('access4');
    let access5 = document.getElementById('access5');
    let access6 = document.getElementById('access6');

    if (access1.innerHTML == 'false') {
        shipmentBtn.classList.add("is-hidden");
    }

    if (access3.innerHTML == 'false') {
        subcontractorBtn.classList.add("is-hidden");
    }
    if (access4.innerHTML == 'false') {
        clientBtn.classList.add("is-hidden");
    }
    if (access5.innerHTML == 'false') {
        billingBtn.classList.add("is-hidden");
    }
    if (access6.innerHTML == 'false') {
        payrollBtn.classList.add("is-hidden");
    }
</script>

</html>