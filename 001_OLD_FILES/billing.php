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
    <title>Billing</title>

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
                    <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fas fa-money-check"></i> Manage Billing </h1>
                        <table id="billingTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Client</th>
                                    <th>Billing Status</th>
                                    <th>Date of Creation</th>
                                    <th>Modify</th>
                                    
                                </tr>
                            </thead>
                        </table>
                        <button class="button is-success is-rounded mt-6" onclick="refreshTable()"> <i class="fas fa-redo mr-3"></i>Refresh </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- INVOICE MODAL -->
<div class="modal" id="invoiceModal">
  <div class="modal-background" id="invoiceModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Billing Invoice</p>
      <button class="delete" aria-label="close" onclick="closeInvoice()"></button>
    </header>

    <section class="modal-card-body">
    <h4 class="subtitle is-5" id="invoiceNumberInvoice"> Invoice Number: </h4>
    <h4 class="subtitle is-5" id="clientInvoice"> Client: </h4>
    <h4 class="subtitle is-5" id="truckRateInvoice"> Truck Rate: </h4>
    <h4 class="subtitle is-5" id="dropFeeInvoice"> Drop Fee: </h4>
    <h4 class="subtitle is-5" id="parkingFeeInvoice"> Parking Fee: </h4>
    <h4 class="subtitle is-5" id="demurrageInvoice"> Demurrage: </h4>
    <h4 class="subtitle is-5" id="otherChargesInvoice"> Other Charges: </h4>
    <h4 class="subtitle is-5" id="subtotalInvoice"> Subtotal: </h4>
    <h4 class="subtitle is-5" id="valueAddedTaxInvoice"> 12% VAT: </h4>
    <h4 class="subtitle is-5" id="lessPenaltiesInvoice"> Less Penalties: </h4>
    <h4 class="subtitle is-5" id="totalTruckingChargesInvoice"> Total Trucking Charges: </h4>
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
                    <th>Shipment Number</th>
                    <th>Vehicle Plate Number</th>
                    <th>Dispatch Date</th>
                    <th>Trucking Cost</th>
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
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Delete Invoice</p>
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

<script src="js/billing.js"></script>

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