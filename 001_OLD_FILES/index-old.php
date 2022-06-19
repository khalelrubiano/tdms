<?php

include 'navbar.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
/*
if($_SESSION["accessType"] != "Admin" && $_SESSION["accessType"] != "Full"){
  // Unset all of the session variables
  $_SESSION = array();
 
  // Destroy the session.
  session_destroy();
   
  // Redirect to login page
  header("location: login.php");
  exit;
}
*/
if($_SESSION["accessType"] == "Partial"){
  // Redirect to login page
  header("location:view-account.php");
  exit;
}

//echo $_SESSION["accessType"];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipments</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                    <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fas fa-truck-loading mr-3"></i>Manage Shipment </h1>
                        <table id="shipmentTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Select Row</th>
                                    <th>Shipment Number</th>
                                    <th>Shipment Status</th>
                                    <th>Starting Point</th>
                                    <th>Destination</th>
                                    <th>Area Rate</th>
                                    <th>Call Time</th>
                                    <th>Dispatch Date</th>
                                    <th>Vehicle Plate Number</th>
                                    <th>Date of Creation</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="button is-info is-rounded mt-6 has-text-white" onclick="openAdd()"> <i class="fas fa-plus mr-3"></i>Add Shipment</button>
                        <button class="button is-link is-rounded mt-6 has-text-white" onclick="openGenerate()"><i class="fas fa-plus mr-3"></i> Generate Invoice</button>
                        <button class="button is-success is-rounded mt-6 has-text-white" onclick="refreshTable()"> <i class="fas fa-redo mr-3"></i> Refresh</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- EDIT MODAL -->
<div class="modal" id="editModal">
  <div class="modal-background" id="editModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-edit mr-3"></i>Edit Shipment Details</p>
      <button class="delete" aria-label="close" onclick="closeEdit()"></button>
    </header>

    <section class="modal-card-body">
      <!-- Content ... 
      <form id="editForm" action="" class="box has-background-white-ter" method="POST">
-->
            <div class="field">
              <label for="" class="label">Shipment Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter shipment number here" class="input is-rounded" name="shipmentNumberEdit" id="shipmentNumberEdit" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-hashtag"></i>
                </span>
              </div>
              <p class="help" id="shipmentNumberEditHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label"> Shipment Status</label>
              <div class="control">
                <div class="select is-rounded" id="shipmentStatusEditDiv">
                  <select id="shipmentStatusEdit" name="shipmentStatusEdit">
                    <option>Pending</option>
                    <option>Completed</option>
                  </select>
                </div>
              </div>
              <p class="help" id="shipmentStatusEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Starting Point</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter starting point here" class="input is-rounded" name="startingPointEdit" id="startingPointEdit" >
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="startingPointEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Destination</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter destination here" class="input is-rounded" name="destinationEdit" id="destinationEdit" >
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="destinationEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Area Rate</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter area rate here" class="input is-rounded" name="areaRateEdit" id="areaRateEdit">
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="areaRateEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Call Time (00:00 AM/PM)</label>
              <div class="control has-icons-left">
                <input type="time" class="input is-rounded" name="callTimeEdit" id="callTimeEdit">
                <span class="icon is-small is-left">
                <i class="far fa-clock"></i>
                </span>
              </div>
              <p class="help" id="callTimeEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Date of Delivery</label>
              <div class="control has-icons-left">
                <input type="date" class="input is-rounded" name="dateOfDeliveryEdit" id="dateOfDeliveryEdit" >
                <span class="icon is-small is-left">
                <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <p class="help" id="dateOfDeliveryEditHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Vehicle Plate Number:</label>
            <div class="control">
              <div class="select is-rounded" id="vehiclePlateNumberEditDiv">
                <select id="vehiclePlateNumberEdit" name="vehiclePlateNumberEdit">
                </select>
              </div>
            </div>
            <p class="help" id="vehiclePlateNumberEditHelp"></p>
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

<!-- ADD MODAL -->
<div class="modal" id="addModal">
  <div class="modal-background" id="addModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-info">
      <p class="modal-card-title has-text-white"> <i class="fas fa-plus mr-3"></i>Add Shipment</p>
      <button class="delete" aria-label="close" onclick="closeAdd()"></button>
    </header>

    <section class="modal-card-body">
      <!-- Content ... 
      <form id="addForm" action="" class="box has-background-white-ter" method="POST">
-->
            <div class="field">
              <label for="" class="label">Shipment Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter shipment number here" class="input is-rounded" name="shipmentNumberAdd" id="shipmentNumberAdd">
                <span class="icon is-small is-left">
                <i class="fas fa-hashtag"></i>
                </span>
              </div>
              <p class="help" id="shipmentNumberAddHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label"> Shipment Status</label>
              <div class="control">
                <div class="select is-rounded" id="shipmentStatusAddDiv">
                  <select id="shipmentStatusAdd" name="shipmentStatusAdd">
                    <option>Pending</option>
                    <option>Completed</option>
                  </select>
                </div>
              </div>
              <p class="help" id="shipmentStatusAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Starting Point</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter starting point here" class="input is-rounded" name="startingPointAdd" id="startingPointAdd" >
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="startingPointAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Destination</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter destination here" class="input is-rounded" name="destinationAdd" id="destinationAdd" >
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="destinationAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Area Rate</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter area rate here" class="input is-rounded" name="areaRateAdd" id="areaRateAdd">
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="areaRateAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Call Time (00:00 AM/PM)</label>
              <div class="control has-icons-left">
                <input type="time" class="input is-rounded" name="callTimeAdd" id="callTimeAdd">
                <span class="icon is-small is-left">
                <i class="far fa-clock"></i>
                </span>
              </div>
              <p class="help" id="callTimeAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Date of Delivery</label>
              <div class="control has-icons-left">
                <input type="date" class="input is-rounded" name="dateOfDeliveryAdd" id="dateOfDeliveryAdd" >
                <span class="icon is-small is-left">
                <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <p class="help" id="dateOfDeliveryAddHelp"></p>
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
              <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
              <i class="fas fa-paper-plane mr-3"></i></i> Submit
              </button>
              <p class="help" id="submitAddFormHelp"></p>
            </div>
    </section>
  </div>
</div>

  <!-- DELETE MODAL -->
  <div class="modal" id="deleteModal">
  <div class="modal-background" id="deleteModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-trash-alt mr-3"></i>Delete Shipment</p>
      <button class="delete" aria-label="close" onclick="closeDelete()"></button>
    </header>

    <section class="modal-card-body">
      <!-- Content ... 
      <form id="deleteForm" action="" class="box has-background-white-ter" method="POST">
-->
            <div class="field">
              <label for="" class="label">Shipment Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter shipment number here" class="input is-rounded" name="shipmentNumberDelete" id="shipmentNumberDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-hashtag"></i>
                </span>
              </div>
              <p class="help" id="shipmentNumberDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Shipment Status</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter shipment status here" class="input is-rounded" name="shipmentStatusDelete" id="shipmentStatusDelete" readonly>
                <span class="icon is-small is-left">
                <i class="far fa-question-circle"></i>
                </span>
              </div>
              <p class="help" id="shipmentStatusDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Starting Point</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter starting point here" class="input is-rounded" name="startingPointDelete" id="startingPointDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="startingPointDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Destination</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter destination here" class="input is-rounded" name="destinationDelete" id="destinationDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="destinationDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Call Time (00:00 AM/PM)</label>
              <div class="control has-icons-left">
                <input type="time" class="input is-rounded" name="callTimeDelete" id="callTimeDelete" readonly>
                <span class="icon is-small is-left">
                <i class="far fa-clock"></i>
                </span>
              </div>
              <p class="help" id="callTimeDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Date of Delivery</label>
              <div class="control has-icons-left">
                <input type="date" class="input is-rounded" name="dateOfDeliveryDelete" id="dateOfDeliveryDelete" readonly>
                <span class="icon is-small is-left">
                <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <p class="help" id="dateOfDeliveryDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Vehicle Plate Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter username here" class="input is-rounded" name="vehiclePlateNumberDelete" id="vehiclePlateNumberDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-truck"></i>
                </span>
              </div>
              <p class="help" id="vehiclePlateNumberDeleteHelp"></p>
            </div>

            <div class="field">
              <button class="button has-background-grey-dark has-text-white is-rounded" name="submitDeleteForm" id="submitDeleteForm">
              <i class="fas fa-exclamation mr-3"></i>Delete
              </button>
              <p class="help" id="submitDeleteFormHelp"></p>
            </div>
            
    </section>
  </div>
</div>

  <!-- INFO MODAL -->
  <div class="modal" id="infoModal">
  <div class="modal-background" id="infoModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-file-alt mr-3"></i>Delivery Report</p>
      <button class="delete" aria-label="close" onclick="closeInfo()"></button>
    </header>

    <section class="modal-card-body">
    <h4 class="subtitle is-5" id="warehouseArrivalInfo">Warehouse Arrival:</h4>
    <h4 class="subtitle is-5" id="startLoadingInfo">Start Loading:</h4>
    <h4 class="subtitle is-5" id="documentReleaseInInfo">First Document Release:</h4>
    <h4 class="subtitle is-5" id="departWarehouseInfo">Depart Warehouse:</h4>
    <h4 class="subtitle is-5" id="storeArrivalInfo">Store Arrival:</h4>
    <h4 class="subtitle is-5" id="startUnloadingInfo">Start Unloading:</h4>
    <h4 class="subtitle is-5" id="documentReleaseOutInfo">Second Document Release:</h4>
    <h4 class="subtitle is-5" id="storeOutInfo">Store Out:</h4>
    <h4 class="subtitle is-5" id="remarksInfo">Remarks:</h4>
    </section>
  </div>
</div>

<!-- GENERATE MODAL -->
<div class="modal" id="generateModal">
  <div class="modal-background" id="generateModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-link">
      <p class="modal-card-title has-text-white"> <i class="fas fa-plus mr-3"></i>Generate Billing Invoice</p>
      <button class="delete" aria-label="close" onclick="closeGenerate()"></button>
    </header>

    <section class="modal-card-body">
      <!-- Content ... 
      <form id="addForm" action="" class="box has-background-white-ter" method="POST">
-->
            <div class="field">
              <label for="" class="label">Billing Invoice Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter billing invoice number here" class="input is-rounded" name="billingInvoiceNumberGenerate" id="billingInvoiceNumberGenerate">
                <span class="icon is-small is-left">
                <i class="fas fa-hashtag"></i>
                </span>
              </div>
              <p class="help" id="billingInvoiceNumberGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Client</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter client here" class="input is-rounded" name="clientGenerate" id="clientGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-user-tie"></i>
                </span>
              </div>
              <p class="help" id="clientGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Drop Fee</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter drop fee here" class="input is-rounded" name="dropFeeGenerate" id="dropFeeGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="dropFeeGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Parking Fee</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter parking fee here" class="input is-rounded" name="parkingFeeGenerate" id="parkingFeeGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="parkingFeeGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Demurrage</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter demurrage here" class="input is-rounded" name="demurrageGenerate" id="demurrageGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="demurrageGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Other Charges</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter other charges here" class="input is-rounded" name="otherChargesGenerate" id="otherChargesGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="otherChargesGenerateHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Less Penalties</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter less penalties here" class="input is-rounded" name="lessPenaltiesGenerate" id="lessPenaltiesGenerate" >
                <span class="icon is-small is-left">
                <i class="fa-solid fa-peso-sign"></i>
                </span>
              </div>
              <p class="help" id="lessPenaltiesGenerateHelp"></p>
            </div>

            <div class="field">
              <button class="button is-link has-text-white is-rounded" name="submitGenerateForm" id="submitGenerateForm">
              <i class="fas fa-paper-plane mr-3"></i></i> Submit
              </button>
              <p class="help" id="submitGenerateFormHelp"></p>
            </div>
            
    </section>
  </div>
</div>

<script src="js/index.js"></script>

<script>
const shipmentBtn = document.getElementById('shipmentBtn')
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