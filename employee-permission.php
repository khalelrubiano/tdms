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
    <title>Permission</title>

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
    <!--DATATABLES CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!--INTERNAL CSS-->
    <style>
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
            <button class="button is-rounded mb-6 is-info" onclick="openAdd()"> <i class="fa-solid fa-plus mr-3"></i>Add New Role</button>
            <div id="card" class="mb-4 has-text-centered">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Role</th>
                            <th>Shipment Access</th>
                            <th>Employee Access</th>
                            <th>Subcontractor Access</th>
                            <th>Client Access</th>
                            <th>Billing Access</th>
                            <th>Payroll Access</th>
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

    <!-- ADD MODAL -->
    <div class="modal" id="addModal">
        <div class="modal-background" id="addModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-plus mr-3"></i>Add New Role</p>
                <button class="delete" aria-label="close" onclick="closeAdd()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field mb-4">
                    <label for="" class="label">Role Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter role name here" class="input is-rounded" name="roleNameAdd" id="roleNameAdd">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="roleNameAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="shipmentAccessAdd"><strong>Shipment Access</strong></label>
                    </div>
                    <p class="help" id="shipmentAccessAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="employeeAccessAdd"><strong>Employee Access</strong></label>
                    </div>
                    <p class="help" id="employeeAccessAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="subcontractorAccessAdd"><strong>Subcontractor Access</strong></label>
                    </div>
                    <p class="help" id="subcontractorAccessAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="clientAccessAdd"><strong>Client Access</strong></label>
                    </div>
                    <p class="help" id="clientAccessAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="billingAccessAdd"><strong>Billing Access</strong></label>
                    </div>
                    <p class="help" id="billingAccessAddHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="payrollAccessAdd"><strong>Payroll Access</strong></label>
                    </div>
                    <p class="help" id="payrollAccessAddHelp"></p>
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
                <p class="modal-card-title has-text-white" id="editModalTitle"></p>
                <button class="delete" aria-label="close" onclick="closeEdit()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field mb-4 is-hidden">
                    <label for="" class="label">Role Name</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter role name here" class="input is-rounded" name="roleNameEdit" id="roleNameEdit" readonly>
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <p class="help" id="roleNameEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="shipmentAccessEdit"><strong>Shipment Access</strong></label>
                    </div>
                    <p class="help" id="shipmentAccessEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="employeeAccessEdit"><strong>Employee Access</strong></label>
                    </div>
                    <p class="help" id="employeeAccessEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="subcontractorAccessEdit"><strong>Subcontractor Access</strong></label>
                    </div>
                    <p class="help" id="subcontractorAccessEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="clientAccessEdit"><strong>Client Access</strong></label>
                    </div>
                    <p class="help" id="clientAccessEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="billingAccessEdit"><strong>Billing Access</strong></label>
                    </div>
                    <p class="help" id="billingAccessEditHelp"></p>
                </div>

                <div class="field">
                    <div class="control has-icons-left">
                        <label class="checkbox mr-3"> <input type="checkbox" class="mr-3" id="payrollAccessEdit"><strong>Payroll Access</strong></label>
                    </div>
                    <p class="help" id="payrollAccessEditHelp"></p>
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
<script src="js/employee-permission.js"></script>

<!--INTERNAL JAVASCRIPT-->
<script>
    logoutBtn.classList.remove("is-hidden");
    employeePermissionBtn.classList.add("is-active");
</script>

</html>