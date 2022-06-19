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
require_once "config.php";
//Load tracker ID
/*
$configObj = new Config();
$pdoVessel = $configObj->pdoConnect();
$sql = "SELECT trackerId FROM tracker WHERE companyName = :companyName";
$stmt = $pdoVessel->prepare($sql);
$stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
$paramCompanyName = $_SESSION["companyName"];

$stmt->execute();
$row = $stmt->fetchAll();
$json = json_encode($row);

//Load vehicle plate number
$configObj2 = new Config();
$pdoVessel2 = $configObj2->pdoConnect();
$sql2 = "SELECT vehiclePlateNumber FROM vehicle WHERE companyName = :companyName";
$stmt2 = $pdoVessel2->prepare($sql2);
$stmt2->bindParam(":companyName", $paramCompanyName2, PDO::PARAM_STR);
$paramCompanyName2 = $_SESSION["companyName"];

$stmt2->execute();
$row2 = $stmt2->fetchAll();
$json2 = json_encode($row2);
*/
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    
  </head>
  <body>

  <section class="hero has-background-white is-fullheight">
  <div class="hero-body">

    <div class="container">

      <div class="columns is-centered">
        <div class="column is-12 has-background-white">
          <h1 class="is-size-3 mb-5 has-text-weight-bold" id="trackerHeader"><i class="fa-solid fa-satellite-dish mr-3"></i> Tracker ID:  </h1>
          <h1 class="is-size-3 mb-5 has-text-weight-bold" id="vehicleHeader"><i class="fas fa-hashtag mr-3"></i> Vehicle Plate Number:  </h1>

          
          <div class="select is-rounded mb-3" id="displayNumberDiv">
            <select class="has-text-black" id="displayNumber" name="displayNumber">
            
            <option value="1">Latest</option>
            <option value="10">Last 10</option>
            <option value="100">All</option>
            </select>
          </div>

          <div class="box has-background-dark" style="height: 600px; width: 1345px">
          <div id="map" style="height: 100%; width: 100%"></div>
          </div>

          <button class="button is-link is-rounded" onclick="openSelect()"> <i class="fa-solid fa-location-arrow mr-3"></i>Select Tracker </button>

          <button class="button is-success is-rounded" onclick="refreshAjax()"> <i class="fas fa-redo mr-3"></i>Refresh Location </button>
          <button class="button is-danger is-rounded" onclick="deleteAjax()"> <i class="fa-solid fa-database mr-3"></i>Delete Tracker Data</button>

          <button class="button is-dark is-rounded" onclick="openTrackerAdd()"> <i class="fas fa-plus mr-3"></i>Register Tracker</button>

          <button class="button is-dark is-rounded" onclick="openTrackerEdit()"> <i class="fas fa-edit mr-3"></i>Edit Tracker Details</button>

          <button class="button is-dark is-rounded" onclick="openTrackerDelete()"> <i class="fas fa-trash-alt mr-3"></i>Delete Tracker </button>

          <!-- <p id="testParagraph"></p> -->
        
        </div>


        </div>

      </div>

    </div>

  </div>

</section>
  </body>

<!-- SELECT MODAL -->
<div class="modal" id="trackerSelectModal">
  <div class="modal-background" id="trackerSelectModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-link">
      <p class="modal-card-title has-text-white"><i class="fa-solid fa-location-arrow mr-3"></i>Select Tracker</p>
      <button class="delete" aria-label="close" onclick="closeSelect()"></button>
    </header>

    <section class="modal-card-body">

      <div class="field">
      <label for="" class="label">Tracker ID:</label>
        <div class="control">
          <div class="select is-rounded" id="trackerSelectDiv">
            <select id="trackerSelect" name="trackerSelect">
            </select>
          </div>
        </div>
        <p class="help" id="trackerSelectHelp"></p>
        </div>

        <div class="field">
          <button class="button is-link has-text-white is-rounded" name="submitSelectForm" id="submitSelectForm">
          <i class="fas fa-check mr-3"></i>Confirm
          </button>
        </div>
    </section>
  </div>
</div>

<!-- ADD TRACKER MODAL -->
<div class="modal" id="trackerAddModal">
  <div class="modal-background" id="trackerAddModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-plus mr-3"></i>Add Tracker</p>
      <button class="delete" aria-label="close" onclick="closeTrackerAdd()"></button>
    </header>

    <section class="modal-card-body">

      <div class="field">
      <label for="" class="label">Tracker ID:</label>
        <div class="control has-icons-left">
          
          <input type="text" placeholder="Enter tracker ID here" class="input is-rounded" name="trackerIdAdd" id="trackerIdAdd">
            <span class="icon is-small is-left">
            <i class="fas fa-hashtag"></i>
            </span>
     
        </div>
        <p class="help" id="trackerIdAddHelp"></p>
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
          <button class="button has-background-dark has-text-white is-rounded" name="submitTrackerAddForm" id="submitTrackerAddForm">
          <i class="fas fa-paper-plane mr-3"></i>Submit
          </button>
          <p class="help" id="submitTrackerAddFormHelp"></p>
        </div>

    </section>
  </div>
</div>

<!-- EDIT TRACKER MODAL -->
<div class="modal" id="trackerEditModal">
  <div class="modal-background" id="trackerEditModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-edit mr-3"></i>Edit Tracker</p>
      <button class="delete" aria-label="close" onclick="closeTrackerEdit()"></button>
    </header>

    <section class="modal-card-body">

    <div class="field">
      <label for="" class="label">Tracker ID:</label>
        <div class="control">
          <div class="select is-rounded" id="trackerIdEditDiv">
            <select id="trackerIdEdit" name="trackerIdEdit">
            </select>
          </div>
        </div>
        <p class="help" id="trackerIdEditHelp"></p>
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
          <button class="button has-background-dark has-text-white is-rounded" name="submitTrackerEditForm" id="submitTrackerEditForm">
          <i class="fas fa-check mr-3"></i>Save changes
          </button>
          <p class="help" id="submitTrackerEditFormHelp"></p>
        </div>

    </section>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal" id="trackerDeleteModal">
  <div class="modal-background" id="trackerDeleteModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-trash-alt mr-3"></i>Delete Tracker</p>
      <button class="delete" aria-label="close" onclick="closeTrackerDelete()"></button>
    </header>

    <section class="modal-card-body">

      <div class="field">
      <label for="" class="label">Tracker ID:</label>
        <div class="control">
          <div class="select is-rounded" id="trackerIdDeleteDiv">
            <select id="trackerIdDelete" name="trackerIdDelete">
            </select>
          </div>
        </div>
        <p class="help" id="trackerIdDeleteHelp"></p>
        </div>

        <div class="field">
          <button class="button has-background-dark has-text-white is-rounded" name="submitTrackerDeleteForm" id="submitTrackerDeleteForm">
          <i class="fas fa-exclamation mr-3"></i>Delete
          </button>
          <p class="help" id="submitTrackerDeleteFormHelp"></p>
        </div>
    </section>
  </div>
</div>

<script src="js/tracking.js"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMmVUCo3vEYVmOeyEwfcIwcGJTmaySyRc&callback=initMap"></script>

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

//SELECT FORM
const trackerSelectModal = document.getElementById('trackerSelectModal');
const trackerSelect = document.getElementById('trackerSelect');
const submitSelectForm = document.getElementById('submitSelectForm');
const displayNumber = document.getElementById('displayNumber');
const trackerHeader = document.getElementById('trackerHeader');
const vehicleHeader = document.getElementById('vehicleHeader');



function openSelect(){
    trackerSelectModal.classList.add('is-active');
    populateSelect();
}

function closeSelect(){
    trackerSelectModal.classList.remove('is-active');
    removeSelect(document.getElementById('trackerSelect'));
}

function populateSelect(){
  $.post("./classes/load-tracker-select.class.php", {
    }, function(data1){
      
      var jsonArray1 = JSON.parse(data1);

      for(var i=0;i < jsonArray1.length;i++){
      var newOption = document.createElement("option");
      newOption.value = jsonArray1[i][0];
      newOption.innerHTML = jsonArray1[i][0];
      trackerSelect.options.add(newOption);
      }

      //closeSelect();
    });
}

function removeSelect(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
      selectElement.remove(i);
   }
}


function selectAjax(displayNumberData){
    refreshVar = trackerSelect.value
    $.post("./classes/load-tracker.class.php", {
      trackerId : trackerSelect.value
    }, function(data3){
      vehiclePlateNumberAjax();
      var jsonArray3 = JSON.parse(data3);
      initMap(jsonArray3, displayNumberData);
      closeSelect();
      //$("#testParagraph").html("trackerId: " + trackerSelect.value);
    });
}


function refreshAjax(){
    $.post("./classes/load-tracker.class.php", {
      trackerId : refreshVar
    }, function(data4){
      
      var jsonArray4 = JSON.parse(data4);
      initMap(jsonArray4, displayNumber.value);
      closeSelect();
    });
}

function vehiclePlateNumberAjax(){
  $.post("./classes/load-vehicle-plate-number.class.php", {
    trackerId : trackerSelect.value
    }, function(data9){
      var jsonArray9 = JSON.parse(data9);
      vehicleHeader.innerHTML = '<i class="fas fa-hashtag mr-3"></i>' + "Vehicle Plate Number: " + jsonArray9[0][1];
    });
}

submitSelectForm.addEventListener('click', (e) => {
  //e.preventDefault()
  trackerHeader.innerHTML = '<i class="fa-solid fa-satellite-dish mr-3"></i>' + "Tracker ID: " + trackerSelect.value;
  selectAjax(1);
});

displayNumber.addEventListener("change", (e) => {
  refreshAjax(displayNumber.value);
});

//ADD TRACKER FORM
const trackerAddModal = document.getElementById('trackerAddModal');
const submitTrackerAddForm = document.getElementById('submitTrackerAddForm');
const vehiclePlateNumberAdd = document.getElementById('vehiclePlateNumberAdd');

const trackerIdAdd = document.getElementById('trackerIdAdd');
const trackerIdAddHelp = document.getElementById('trackerIdAddHelp');
const submitTrackerAddFormHelp = document.getElementById('submitTrackerAddFormHelp');

function openTrackerAdd(){
    trackerAddModal.classList.add('is-active');
    populateVehiclePlateNumberAdd();
}

function closeTrackerAdd(){
  trackerAddModal.classList.remove('is-active');
  removeVehiclePlateNumberAdd(document.getElementById('vehiclePlateNumberAdd'));
}

function populateVehiclePlateNumberAdd(){
  $.post("./classes/load-vehicle-select.class.php", {
    }, function(data2){
      
      var jsonArray2 = JSON.parse(data2);

      for(var i=0;i < jsonArray2.length;i++){
      var newOption2 = document.createElement("option");
      newOption2.value = jsonArray2[i][0];
      newOption2.innerHTML = jsonArray2[i][0];
      vehiclePlateNumberAdd.options.add(newOption2);
      }

      //closeSelect();
    });

}

function removeVehiclePlateNumberAdd(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
    selectElement.remove(i);
   }
}

function trackerAddAjax(){
    $.post("./classes/add-tracker-controller.class.php", {
      trackerIdAdd : trackerIdAdd.value,
      vehiclePlateNumberAdd : vehiclePlateNumberAdd.value
    }, function(data){
      //refreshAjax();
      $("#submitTrackerAddFormHelp").html(data);
      //closeTrackerAdd();
      
    });
}

var pattern1 = /^[0-9]+$/

  submitTrackerAddForm.addEventListener('click', (e) => {
  let trackerIdAddMessages = [];

  //Tracker ID Validation
  if (pattern1.test(trackerIdAdd.value) == false) {
    trackerIdAdd.className = "input is-danger is-rounded"
    trackerIdAddHelp.className = "help is-danger"
    trackerIdAddMessages.push('Tracker ID should only consist of numbers!')
  }

  if (trackerIdAdd.value === "" || trackerIdAdd.value == null) {
    trackerIdAdd.className = "input is-danger is-rounded"
    trackerIdAddHelp.className = "help is-danger"
    trackerIdAddMessages.push('Tracker ID is required!')
  }

  if (trackerIdAdd.value.length < 1) {
    trackerIdAdd.className = "input is-danger is-rounded"
    trackerIdAddHelp.className = "help is-danger"
    trackerIdAddMessages.push('Tracker ID must be longer than 1 character!')
  }

  if (trackerIdAdd.value.length > 255) {
    trackerIdAdd.className = "input is-danger is-rounded"
    trackerIdAddHelp.className = "help is-danger"
    trackerIdAddMessages.push('Tracker ID must be less than 255 characters!')
  }

  //Messages
  if (trackerIdAddMessages.length > 0) {
    e.preventDefault()
    trackerIdAddHelp.innerText = trackerIdAddMessages.join(', ')
  }
  if(trackerIdAddMessages.length <= 0){
    trackerAddAjax();
  }

});

//EDIT TRACKER FORM
const trackerEditModal = document.getElementById('trackerEditModal');
const submitTrackerEditForm = document.getElementById('submitTrackerEditForm');
const vehiclePlateNumberEdit = document.getElementById('vehiclePlateNumberEdit');

const trackerIdEdit = document.getElementById('trackerIdEdit');
const trackerIdEditHelp = document.getElementById('trackerIdEditHelp');
const submitTrackerEditFormHelp = document.getElementById('submitTrackerEditFormHelp');

function openTrackerEdit(){
    trackerEditModal.classList.add('is-active');
    populateTrackerIdEdit();
    populateVehiclePlateNumberEdit();
}

function closeTrackerEdit(){
  trackerEditModal.classList.remove('is-active');
  removeTrackerIdEdit(document.getElementById('trackerIdEdit'));
  removeVehiclePlateNumberEdit(document.getElementById('vehiclePlateNumberEdit'));
  
}

function populateVehiclePlateNumberEdit(){
  $.post("./classes/load-vehicle-select.class.php", {
    }, function(data6){
      
      var jsonArray6 = JSON.parse(data6);

      for(var i=0;i < jsonArray6.length;i++){
      var newOption6 = document.createElement("option");
      newOption6.value = jsonArray6[i][0];
      newOption6.innerHTML = jsonArray6[i][0];
      vehiclePlateNumberEdit.options.add(newOption6);
      }

      //closeSelect();
    });

}

function removeVehiclePlateNumberEdit(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
    selectElement.remove(i);
   }
}

function populateTrackerIdEdit(){
  $.post("./classes/load-tracker-select.class.php", {
    }, function(data5){
      
      var jsonArray5 = JSON.parse(data5);

      for(var i=0;i < jsonArray5.length;i++){
      var newOption = document.createElement("option");
      newOption.value = jsonArray5[i][0];
      newOption.innerHTML = jsonArray5[i][0];
      trackerIdEdit.options.add(newOption);
      }

      //closeSelect();
    });
}

function removeTrackerIdEdit(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
      selectElement.remove(i);
   }
}

function trackerEditAjax(){
    $.post("./classes/edit-tracker-controller.class.php", {
      trackerIdEdit : trackerIdEdit.value,
      vehiclePlateNumberEdit : vehiclePlateNumberEdit.value
    }, function(data6){
      //refreshAjax();
      $("#submitTrackerEditFormHelp").html(data6);
      //closeTrackerAdd();
    });
}

submitTrackerEditForm.addEventListener('click', (e) => {
  trackerEditAjax();
});

//DELETE TRACKER FORM
const trackerDeleteModal = document.getElementById('trackerDeleteModal');
const submitTrackerDeleteForm = document.getElementById('submitTrackerDeleteForm');

const trackerIdDelete = document.getElementById('trackerIdDelete');
const trackerIdDeleteHelp = document.getElementById('trackerIdDeleteHelp');
const submitTrackerDeleteFormHelp = document.getElementById('submitTrackerDeleteFormHelp');

function openTrackerDelete(){
    trackerDeleteModal.classList.add('is-active');
    populateTrackerIdDelete();
}

function closeTrackerDelete(){
    trackerDeleteModal.classList.remove('is-active');
    removeTrackerIdDelete(document.getElementById('trackerIdDelete'));
}

function populateTrackerIdDelete(){
  $.post("./classes/load-tracker-select.class.php", {
    }, function(data7){
      
      var jsonArray7 = JSON.parse(data7);

      for(var i=0;i < jsonArray7.length;i++){
      var newOption7 = document.createElement("option");
      newOption7.value = jsonArray7[i][0];
      newOption7.innerHTML = jsonArray7[i][0];
      trackerIdDelete.options.add(newOption7);
      }

      //closeSelect();
    });
}

function removeTrackerIdDelete(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
      selectElement.remove(i);
   }
}

function trackerDeleteAjax(){
    $.post("./classes/delete-tracker-controller.class.php", {
      trackerId : trackerIdDelete.value
    }, function(data8){
      //closeTrackerDelete();
      $("#submitTrackerDeleteFormHelp").html(data8);
    });
}

submitTrackerDeleteForm.addEventListener('click', (e) => {
  //e.preventDefault()
  trackerDeleteAjax();
});

//DELETE FORM
function deleteAjax(){
    $.post("./classes/delete-tracker-data-controller.class.php", {
      trackerId : refreshVar
    }, function(data4){
      //$("#testParagraph").html(data4);
      //window.location.reload(true);
    });
}

</script>

</html>