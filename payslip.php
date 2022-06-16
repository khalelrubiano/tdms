<?php
if ( !isset($_SESSION) ) {
  session_start();
}

include 'navbar.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SESSION["accessType"] != "Admin" && $_SESSION["accessType"] != "Full"){
  // Unset all of the session variables
  $_SESSION = array();
 
  // Destroy the session.
  session_destroy();
   
  // Redirect to login page
  header("location: login.php");
  exit;
}

//echo $_SESSION["accessType"];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.0.5/css/editor.dataTables.css">
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.0.5/js/dataTables.editor.js"></script>


</head>

<body>
    
    <section class="hero has-background-white">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-full">
                    <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fas fa-money-check"></i> Manage Payslip </h1>
                        <table id="payslipTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Payslip Number</th>
                                    <th>Date Issued</th>
                                    <th>Invoice Number</th>
                                    <th>Vehicle Plate Number</th>
                                    <th>Owner Username</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="button is-link is-rounded mt-6" onclick="openAdd()"> <i class="fas fa-plus mr-3"></i> Generate Payslip </button>
                        <button class="button is-success is-rounded mt-6" onclick="refreshTable()"> <i class="fas fa-redo mr-3"></i>Refresh </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- ADD MODAL -->
<div class="modal" id="addModal">
  <div class="modal-background" id="addModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-link">
      <p class="modal-card-title has-text-white"><i class="fas fa-plus mr-3"></i>Generate Payslip</p>
      <button class="delete" aria-label="close" onclick="closeAdd()"></button>
    </header>

    <section class="modal-card-body">

            <div class="field">
              <label for="" class="label">Payslip Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter payslip number here" class="input is-rounded" name="payslipNumberAdd" id="payslipNumberAdd">
                <span class="icon is-small is-left">
                <i class="fas fa-hashtag"></i>
                </span>
              </div>
              <p class="help" id="payslipNumberAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Date Issued</label>
              <div class="control has-icons-left">
                <input type="date" class="input is-rounded" name="dateIssuedAdd" id="dateIssuedAdd">
                <span class="icon is-small is-left">
                <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <p class="help" id="dateIssuedAddHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Vehicle Plate Number:</label>
            <div class="control">
              <div class="select is-rounded" id="vehiclePlateNumberAddDiv">
                <select id="vehiclePlateNumberAdd" name="vehiclePlateNumberAdd">
                </select>
              </div>
            </div>
            <p class="help" id="vehiclePlateNumberAddHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Billing Invoice Number:</label>
            <div class="control">
              <div class="select is-rounded" id="billingInvoiceNumberAddDiv">
                <select id="billingInvoiceNumberAdd" name="billingInvoiceNumberAdd">
                </select>
              </div>
            </div>
            <p class="help" id="billingInvoiceNumberAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Drop Off Fee</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter drop off fee here" class="input is-rounded" name="dropOffAdd" id="dropOffAdd">
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="dropOffAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Penalty</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter penalty here" class="input is-rounded" name="penaltyAdd" id="penaltyAdd">
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="penaltyAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Withholding Tax Rate</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter withholding tax rate here" class="input is-rounded" name="withholdingTaxAdd" id="withholdingTaxAdd">
                <span class="icon is-small is-left">
                <i class="fas fa-percent"></i>
                </span>
              </div>
              <p class="help" id="withholdingTaxAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Commission Rate</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter commission rate here" class="input is-rounded" name="commissionRateAdd" id="commissionRateAdd">
                <span class="icon is-small is-left">
                <i class="fas fa-percent"></i>
                </span>
              </div>
              <p class="help" id="commissionRateAddHelp"></p>
            </div>

            <div class="field">
              <button class="button is-link has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
              <i class="fas fa-paper-plane mr-3"></i>Submit
              </button>
              <p class="help" id="submitAddFormHelp"></p>
            </div>
    </section>
  </div>
</div>

<!-- PAYSLIP MODAL -->
<div class="modal" id="payslipModal">
  <div class="modal-background" id="payslipModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Payslip Details</p>
      <button class="delete" aria-label="close" onclick="closePayslip()"></button>
    </header>

    <section class="modal-card-body">
    <h4 class="subtitle is-5" id="truckRatePayslip"> Truck Rate: </h4>
    <h4 class="subtitle is-5" id="dropOffPayslip"> Drop Off Fee: </h4>
    <h4 class="subtitle is-5" id="penaltyPayslip"> Penalty: </h4>
    <h4 class="subtitle is-5" id="subtotalPayslip"> <strong> Subtotal: </strong> </h4>
    <h4 class="subtitle is-5" id="withholdingTaxPayslip"> Withholding Tax: </h4>
    <h4 class="subtitle is-5" id="commissionRatePayslip"> Commission Rate: </h4>
    <h4 class="subtitle is-5" id="netPayPayslip"><strong> Net Pay: </strong> </h4>
    </section>
  </div>
</div>

<!-- BILLED SHIPMENT MODAL -->
<div class="modal" id="billedShipmentModal">
  <div class="modal-background" id="billedShipmentModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Billed Shipment</p>
      <button class="delete" aria-label="close" onclick="closeBilledShipment()"></button>
    </header>

    <section class="modal-card-body">
        <table id="billedShipmentTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Shipment Number</th>
                    <th>Destination</th>
                    <th>Rate</th>
                </tr>
            </thead>
        </table>
    </section>
  </div>
</div>

<!-- DELETE INVOICE MODAL -->
<div class="modal" id="deleteModal">
  <div class="modal-background" id="deleteModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Delete Payslip</p>
      <button class="delete" aria-label="close" onclick="closeDelete()"></button>
    </header>
    <section class="modal-card-body">
    <h1 class="is-size-4 mb-5" id="deleteheader">Are your sure you want to delete?</h1>
    <button class="button is-dark is-rounded" name="submitDeleteForm" id="submitDeleteForm"> <i class="fas fa-redo mr-3"></i> Confirm Delete </button>
    </section>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal" id="editModal">
  <div class="modal-background" id="editModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-edit mr-3"></i>Edit Billing Status</p>
      <button class="delete" aria-label="close" onclick="closeEdit()"></button>
    </header>

    <section class="modal-card-body">
      
            <div class="field">
            <label for="" class="label"> Billing Status</label>
              <div class="control">
                <div class="select is-rounded" id="billingStatusEditDiv">
                  <select id="billingStatusEdit" name="billingStatusEdit">
                    <option>Unpaid</option>
                    <option>Paid</option>
                  </select>
                </div>
              </div>
              <p class="help" id="billingStatusEditHelp"></p>
            </div>

            <div class="field">
              <button class="button has-background-grey-dark has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
              <i class="fas fa-check mr-3"></i>Save changes
              </button>
              <p class="help" id="submitEditFormHelp"></p>
            </div>
    </section>
  </div>
</div>

<script src="js/payslip.js"></script>

<script>
const logoutBtn = document.getElementById('logoutBtn')
const loginBtn = document.getElementById('loginBtn')
const signupBtn = document.getElementById('signupBtn')
const userBtn = document.getElementById('userBtn')

if(<?php echo isset($_SESSION["loggedin"])?> == true ){
    logoutBtn.className = "button has-background-dark is-rounded has-text-white";
    loginBtn.className = "button has-background-grey-lighter is-rounded is-hidden";
    signupBtn.className = "button is-link is-rounded is-hidden";
    userBtn.className = "navbar-item has-text-weight-bold";
}

</script>
</html>