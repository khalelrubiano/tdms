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
    <title>Group</title>

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
            <p class="title is-hidden" id="arrayLengthHidden">sample</p>
            <p class="title is-hidden" id="indicator">Live Search Indicator</p>
            <button class="button is-rounded mr-4 is-info" onclick="openAdd()"> <i class="fa-solid fa-user-group mr-3"></i>Create Group</button>

            <div class="select is-rounded" id="selectSortDiv">
                <select id="selectSort">
                    <option value="ownergroup.group_name" selected>Sort By Group Name</option>
                    <option value="subcontractor.first_name">Sort By Owner Name</option>
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

        <div class="container">
            <div class="tile is-ancestor is-vertical" id="ancestorTile">

            </div>
        </div>

    </div>

    <!-- ADD MODAL -->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-user-group mr-3"></i>Create Group</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">
                <div class="field">
                    <label for="" class="label">Group Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter group name here" class="input is-rounded" name="groupNameAdd" id="groupNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="groupNameAddHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Group Owner</label>
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

    <!-- EDIT MODAL -->
    <div class="modal" id="editModal">
        <div class="modal-background" id="editModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white" id="editHeader"><i class="fa-solid fa-user-group mr-3"></i></p>
                <p class="modal-card-title has-text-white is-hidden" id="editHeader2"></p>
                <button class="delete" aria-label="close" onclick="closeEdit()"></button>
            </header>

            <section class="modal-card-body">
                <div class="field">
                    <label for="" class="label">Group Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter group name here" class="input is-rounded" name="groupNameEdit" id="groupNameEdit">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="groupNameEditHelp"></p>
                </div>

                <div class="field">
                    <label for="" class="label">Group Owner</label>
                    <div class="control">
                        <div class="select is-rounded" id="groupOwnerEditDiv">
                            <select id="groupOwnerEdit" name="groupOwnerEdit">
                            </select>
                        </div>
                    </div>
                    <p class="help" id="groupOwnerEditHelp"></p>
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
    
</body>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/subcontractor-group.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
    userBtn.classList.remove("is-hidden");
    subcontractorGroupBtn.classList.add("is-active");
</script>

</html>