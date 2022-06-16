<?php
session_start();
include 'navbar.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<section class="hero has-background-white">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-6">

        
        <form id="infoForm" class="box has-background-white-ter">
        <div class="field">
          <label for="" class="label"><i class="fas fa-truck-loading mr-3"></i>Shipment Number:</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter shipment number here" class="input is-rounded" name="shipmentNumber" id="shipmentNumber">
            <span class="icon is-small is-left">
            <i class="fas fa-hashtag"></i>
            </span>
          </div>
          <p class="help" id="shipmentNumberHelp"></p>
        </div>

        <div class="field">
      <label for="" class="label"><i class="fas fa-building mr-3"></i>Company Name:</label>
        <div class="control">
          <div class="select is-rounded" id="companyNameSelectDiv">
            <select id="companyNameSelect" name="companyNameSelect">
            </select>
          </div>
        </div>
        <p class="help" id="companyNameSelectHelp"></p>
        </div>

        <div class="field">
        <button class="button has-background-link has-text-white is-rounded" name="submitShipmentForm" id="submitShipmentForm">
          <i class="fa-solid fa-magnifying-glass mr-3"></i>View
          </button>
        </div>

        </form>

        </div>
      </div>
    </div>
  </div>
</section>

 <!-- INFO MODAL -->
 <div class="modal" id="infoModal">
  <div class="modal-background" id="infoModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-link">
      <p class="modal-card-title has-text-white"><i class="fas fa-truck-loading mr-3"></i>Shipment Details</p>
      <button class="delete" aria-label="close" onclick="closeInfo()"></button>
    </header>

    <section class="modal-card-body">
    <h4 class="subtitle is-5" id="shipmentNumberInfo">Shipment Number:</h4>
    <h4 class="subtitle is-5" id="shipmentStatusInfo">Shipment Status:</h4>
    <h4 class="subtitle is-5" id="startingPointInfo">Starting Point:</h4>
    <h4 class="subtitle is-5" id="destinationInfo">Destination:</h4>
    <h4 class="subtitle is-5" id="callTimeInfo">Call Time:</h4>
    <h4 class="subtitle is-5" id="dateOfDeliveryInfo">Date of Delivery:</h4>
    <h4 class="subtitle is-5" id="vehiclePlateNumberInfo">Vehicle Plate Number:</h4>
    <h4 class="subtitle is-5" id="createdAtInfo">Date of Creation:</h4>
    </section>
  </div>
</div>
</body>

<script>
  const shipmentBtn = document.getElementById('shipmentBtn')
  const trackingBtn = document.getElementById('trackingBtn')
  const payslipBtn = document.getElementById('payslipBtn')
  const manageBtn = document.getElementById('manageBtn')
  const billingBtn = document.getElementById('billingBtn')
  const clientTrackingBtn = document.getElementById('clientTrackingBtn')
  const companyNameSelect = document.getElementById('companyNameSelect')
  
  if(<?php echo !isset($_SESSION["loggedin"])?>){
    shipmentBtn.className = "navbar-item is-hidden";
    trackingBtn.className = "navbar-item is-hidden";
    payslipBtn.className = "navbar-item is-hidden";
    manageBtn.className = "navbar-item is-hidden";
    billingBtn.className = "navbar-item is-hidden";
    clientTrackingBtn.className = "navbar-item";
  }

  function populateSelect(){
  $.post("./classes/load-company-select.class.php", {
    }, function(data1){
      
      var jsonArray1 = JSON.parse(data1);

      for(var i=0;i < jsonArray1.length;i++){
      var newOption = document.createElement("option");
      newOption.value = jsonArray1[i][0];
      newOption.innerHTML = jsonArray1[i][0];
      companyNameSelect.options.add(newOption);
      }

      //closeSelect();
    });
  }
populateSelect();

let shipmentNumber = document.getElementById('shipmentNumber');
let submitShipmentForm = document.getElementById('submitShipmentForm');

let shipmentNumberInfo = document.getElementById('shipmentNumberInfo');
let shipmentStatusInfo = document.getElementById('shipmentStatusInfo');
let startingPointInfo = document.getElementById('startingPointInfo');
let destinationInfo = document.getElementById('destinationInfo');
let callTimeInfo = document.getElementById('callTimeInfo');
let dateOfDeliveryInfo = document.getElementById('dateOfDeliveryInfo');
let vehiclePlateNumberInfo = document.getElementById('vehiclePlateNumberInfo');
let createdAtInfo = document.getElementById('createdAtInfo');

const infoModal = document.getElementById('infoModal');

function openInfo(infoVal1, infoVal2){
    infoModal.classList.add('is-active');
    infoAjax(infoVal1, infoVal2);
}

function closeInfo(){
    infoModal.classList.remove('is-active');
}

submitShipmentForm.addEventListener('click', (e) => {
  e.preventDefault();
  openInfo(shipmentNumber.value, companyNameSelect.value);
})


function infoAjax(){
    clearInfo();

    $.post("./classes/load-client-tracking.class.php", {
      shipmentNumber : shipmentNumber.value,
      companyName : companyNameSelect.value
    }, function(data){

      var jsonArray = JSON.parse(data);

      shipmentNumberInfo.innerHTML = "Shipment Number: " + jsonArray[0][0];
      shipmentStatusInfo.innerHTML = "Shipment Status: " + jsonArray[0][1];
      startingPointInfo.innerHTML = "Starting Point: " + jsonArray[0][2];
      destinationInfo.innerHTML = "Destination: " + jsonArray[0][3];
      callTimeInfo.innerHTML = "Call Time: " + jsonArray[0][5];
      dateOfDeliveryInfo.innerHTML = "Date of Delivery: " + jsonArray[0][6];
      vehiclePlateNumberInfo.innerHTML = "Vehicle Plate Number: " + jsonArray[0][9];
      createdAtInfo.innerHTML = "Created At: " + jsonArray[0][7];
    });
}
function clearInfo(){
  shipmentNumberInfo.innerHTML = "Shipment Number: ";
  shipmentStatusInfo.innerHTML = "Shipment Status: ";
  startingPointInfo.innerHTML = "Starting Point: ";
  destinationInfo.innerHTML = "Destination: ";
  callTimeInfo.innerHTML = "Call Time Info: "; 
  dateOfDeliveryInfo.innerHTML = "Date of Delivery: ";
  vehiclePlateNumberInfo.innerHTML = "Vehicle Plate Number: "; 
  createdAtInfo.innerHTML = "Created At: ";
}
</script>
</html>