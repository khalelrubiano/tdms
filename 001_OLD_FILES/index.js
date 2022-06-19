//GENERATING DATATABLE
var shipmentDatatable = $('#shipmentTable').DataTable({
    "ajax": {
        "url": "classes/load-shipment.class.php",
        "dataSrc": ""
    },
    "columns": [
        {"data": null , "render": function(s_data1, s_type1, s_row1){
            return '<input type="checkbox" name="shipmentSelectRow1" value="' + s_row1[0] + '">';
        }},
        {"data": "shipmentNumber"},
        {"data": "shipmentStatus"},
        {"data": "startingPoint"},
        {"data": "destination"},
        {"data": "areaRate"},
        {"data": "callTime"},
        {"data": "dateOfDelivery"},
        {"data": "vehiclePlateNumber"},
        {"data": "createdAt"},
        {"data": null, "width": "175px", "render": function(s_data, s_type, s_row){

            return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openEdit(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-edit"></i></button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openDelete(' + "'" + s_row[0] + "'" + ', ' + "'" + s_row[1] + "'" + ', ' + "'" + s_row[2] + "'" + ', ' + "'" + s_row[3] + "'" + ', ' + "'" + s_row[4] + "'" + ', ' + "'" + s_row[5] + "'" + ', ' + "'" + s_row[8] + "'" + ')"> <i class="fas fa-trash-alt"></i></button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openInfo(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-file-alt"></i></button>';
        }}
    ]
});

//MANIPULATING MODALS
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');
const deleteModal = document.getElementById('deleteModal');
const infoModal = document.getElementById('infoModal');
const generateModal = document.getElementById('generateModal');

function clearGenerateFormInput(){
    billingInvoiceNumberGenerate.value = null;
    clientGenerate.value = null;
    dropFeeGenerate.value = null; 
    parkingFeeGenerate.value = null; 
    demurrageGenerate.value = null; 
    otherChargesGenerate.value = null;
    lessPenaltiesGenerate.value = null;
}

function clearGenerateFormHelp(){
    //RESETTING FORM ELEMENTS
    billingInvoiceNumberGenerate.className = "input is-rounded"
    billingInvoiceNumberGenerateHelp.className = "help"
    billingInvoiceNumberGenerateHelp.innerText = ""

    clientGenerate.className = "input is-rounded"
    clientGenerateHelp.className = "help"
    clientGenerateHelp.innerText = ""

    dropFeeGenerate.className = "input is-rounded"
    dropFeeGenerateHelp.className = "help"
    dropFeeGenerateHelp.innerText = ""

    parkingFeeGenerate.className = "input is-rounded"
    parkingFeeGenerateHelp.className = "help"
    parkingFeeGenerateHelp.innerText = ""

    demurrageGenerate.className = "input is-rounded"
    demurrageGenerateHelp.className = "help"
    demurrageGenerateHelp.innerText = ""

    otherChargesGenerate.className = "input is-rounded"
    otherChargesGenerateHelp.className = "help"
    otherChargesGenerateHelp.innerText = ""

    lessPenaltiesGenerate.className = "input is-rounded"
    lessPenaltiesGenerateHelp.className = "help"
    lessPenaltiesGenerateHelp.innerText = ""

}

function clearEditFormInput(){

    startingPointEdit.value = null;
    destinationEdit.value = null;
    areaRateEdit.value = null;
    callTimeEdit.value = null; 
    dateOfDeliveryEdit.value = null; 
    vehiclePlateNumberEdit.value = null;
}

function clearEditFormHelp(){
    //RESETTING FORM ELEMENTS
    shipmentNumberEdit.className = "input is-rounded"
    shipmentNumberEditHelp.className = "help"
    shipmentNumberEditHelp.innerText = ""

    shipmentStatusEdit.className = "select is-rounded"
    shipmentStatusEditHelp.className = "help"
    shipmentStatusEditHelp.innerText = ""

    startingPointEdit.className = "input is-rounded"
    startingPointEditHelp.className = "help"
    startingPointEditHelp.innerText = ""

    destinationEdit.className = "input is-rounded"
    destinationEditHelp.className = "help"
    destinationEditHelp.innerText = ""

    areaRateEdit.className = "input is-rounded"
    areaRateEditHelp.className = "help"
    areaRateEditHelp.innerText = ""

    callTimeEdit.className = "input is-rounded"
    callTimeEditHelp.className = "help"
    callTimeEditHelp.innerText = ""

    dateOfDeliveryEdit.className = "input is-rounded"
    dateOfDeliveryEditHelp.className = "help"
    dateOfDeliveryEditHelp.innerText = ""

    vehiclePlateNumberEdit.className = "input is-rounded"
    vehiclePlateNumberEditHelp.className = "help"
    vehiclePlateNumberEditHelp.innerText = ""
}
function clearAddFormInput(){
    shipmentNumberAdd.value = null;
    startingPointAdd.value = null;
    destinationAdd.value = null;
    areaRateAdd.value = null; 
    callTimeAdd.value = null; 
    dateOfDeliveryAdd.value = null; 
    vehiclePlateNumberAdd.value = null;

}

function clearAddFormHelp(){
    //RESETTING FORM ELEMENTS
    shipmentNumberAdd.className = "input is-rounded"
    shipmentNumberAddHelp.className = "help"
    shipmentNumberAddHelp.innerText = ""

    shipmentStatusAdd.className = "select is-rounded"
    shipmentStatusAddHelp.className = "help"
    shipmentStatusAddHelp.innerText = ""

    startingPointAdd.className = "input is-rounded"
    startingPointAddHelp.className = "help"
    startingPointAddHelp.innerText = ""

    destinationAdd.className = "input is-rounded"
    destinationAddHelp.className = "help"
    destinationAddHelp.innerText = ""

    areaRateAdd.className = "input is-rounded"
    areaRateAddHelp.className = "help"
    areaRateAddHelp.innerText = ""

    callTimeAdd.className = "input is-rounded"
    callTimeAddHelp.className = "help"
    callTimeAddHelp.innerText = ""

    dateOfDeliveryAdd.className = "input is-rounded"
    dateOfDeliveryAddHelp.className = "help"
    dateOfDeliveryAddHelp.innerText = ""

    vehiclePlateNumberAdd.className = "input is-rounded"
    vehiclePlateNumberAddHelp.className = "help"
    vehiclePlateNumberAddHelp.innerText = ""
}
function openInfo(infoVal){
    infoModal.classList.add('is-active');
    infoAjax(infoVal);
}

function closeInfo(){
    infoModal.classList.remove('is-active');
}

function openEdit(editVal){
    document.getElementById('shipmentNumberEdit').setAttribute('value', editVal);
    editModal.classList.add('is-active');
    populateVehiclePlateNumberEdit();
}

function closeEdit(){
    clearEditFormHelp();
    clearEditFormInput();
    editModal.classList.remove('is-active');
}

function openAdd(){
    addModal.classList.add('is-active');
    populateVehiclePlateNumberAdd();
}

function closeAdd(){
    clearAddFormHelp();
    clearAddFormInput();
    addModal.classList.remove('is-active');
    removeSelectAdd(document.getElementById('vehiclePlateNumberAdd'));
}

function openGenerate(){
    generateModal.classList.add('is-active');
}

function closeGenerate(){
    clearGenerateFormHelp();
    clearGenerateFormInput();
    generateModal.classList.remove('is-active');
}

function openDelete(deleteVal1, deleteVal2, deleteVal3, deleteVal4, deleteVal5, deleteVal6, deleteVal7){
    document.getElementById('shipmentNumberDelete').setAttribute('value', deleteVal1);
    document.getElementById('shipmentStatusDelete').setAttribute('value', deleteVal2);
    document.getElementById('startingPointDelete').setAttribute('value', deleteVal3);
    document.getElementById('destinationDelete').setAttribute('value', deleteVal4);
    document.getElementById('callTimeDelete').setAttribute('value', deleteVal5);
    document.getElementById('dateOfDeliveryDelete').setAttribute('value', deleteVal6);
    document.getElementById('vehiclePlateNumberDelete').setAttribute('value', deleteVal7);

    deleteModal.classList.add('is-active');
}

function closeDelete(){
    deleteModal.classList.remove('is-active');
}

function refreshTable(){
    shipmentDatatable.ajax.reload();
}

let warehouseArrivalInfo = document.getElementById('warehouseArrivalInfo');
let startLoadingInfo = document.getElementById('startLoadingInfo');
let documentReleaseInInfo = document.getElementById('documentReleaseInInfo');
let departWarehouseInfo = document.getElementById('departWarehouseInfo');
let storeArrivalInfo = document.getElementById('storeArrivalInfo');
let startUnloadingInfo = document.getElementById('startUnloadingInfo');
let documentReleaseOutInfo = document.getElementById('documentReleaseOutInfo');
let storeOutInfo = document.getElementById('storeOutInfo');
let remarksInfo = document.getElementById('remarksInfo');



function infoAjax(shipmentNumberData){
    clearInfo();

    $.post("./classes/load-delivery-report.class.php", {
      shipmentNumber : shipmentNumberData
    }, function(data){
      var jsonArray = JSON.parse(data);

      var warehouseArrivalInfoVar = jsonArray[0][1];
      var startLoadingInfoVar = jsonArray[0][2];
      var documentReleaseInInfoVar = jsonArray[0][3];
      var departWarehouseInfoVar = jsonArray[0][4];
      var storeArrivalInfoVar = jsonArray[0][5];
      var startUnloadingInfoVar = jsonArray[0][6];
      var documentReleaseOutInfoVar = jsonArray[0][7];
      var storeOutInfoVar = jsonArray[0][8];
      var remarksInfoVar = jsonArray[0][9];

      if(warehouseArrivalInfoVar == 'null'){
        warehouseArrivalInfoVar = '';
      }
      if(startLoadingInfoVar == null){
        startLoadingInfoVar = '';
      }
      if(documentReleaseInInfoVar == null){
        documentReleaseInInfoVar = '';
      }
      if(departWarehouseInfoVar == null){
        departWarehouseInfoVar = '';
      }
      if(storeArrivalInfoVar == null){
        storeArrivalInfoVar = '';
      }
      if(startUnloadingInfoVar == null){
        startUnloadingInfoVar = '';
      }
      if(documentReleaseOutInfoVar == null){
        documentReleaseOutInfoVar = '';
      }
      if(storeOutInfoVar == null){
        storeOutInfoVar = '';
      }
      if(remarksInfoVar == null){
        remarksInfoVar = '';
      }

      warehouseArrivalInfo.innerHTML = "Warehouse Arrival: " + warehouseArrivalInfoVar;
      startLoadingInfo.innerHTML = "Start Loading: " + startLoadingInfoVar;
      documentReleaseInInfo.innerHTML = "First Document Release: " + documentReleaseInInfoVar;
      departWarehouseInfo.innerHTML = "Depart Warehouse: " + departWarehouseInfoVar;
      storeArrivalInfo.innerHTML = "Store Arrival: " + storeArrivalInfoVar;
      startUnloadingInfo.innerHTML = "Start Unloading: " + startUnloadingInfoVar;
      documentReleaseOutInfo.innerHTML = "Second Document Release: " + documentReleaseOutInfoVar;
      storeOutInfo.innerHTML = "Store Out: " + storeOutInfoVar;
      remarksInfo.innerHTML = "Remarks: " + remarksInfoVar;
    });
}

function clearInfo(){
    warehouseArrivalInfo.innerHTML = "Warehouse Arrival: ";
    startLoadingInfo.innerHTML = "Start Loading: ";
    documentReleaseInInfo.innerHTML = "First Document Release: ";
    departWarehouseInfo.innerHTML = "Depart Warehouse: ";
    storeArrivalInfo.innerHTML = "Store Arrival: ";
    startUnloadingInfo.innerHTML = "Start Unloading: ";
    startUnloadingInfo.innerHTML = "Second Document Release: ";
    documentReleaseOutInfo.innerHTML = "Finish Unloading:";
    storeOutInfo.innerHTML = "Store Out: ";
    remarksInfo.innerHTML = "Remarks: ";
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button

let shipmentNumberEdit = document.getElementById('shipmentNumberEdit');
let shipmentStatusEdit = document.getElementById('shipmentStatusEdit');
let startingPointEdit = document.getElementById('startingPointEdit');
let destinationEdit = document.getElementById('destinationEdit');
let areaRateEdit = document.getElementById('areaRateEdit');
let callTimeEdit = document.getElementById('callTimeEdit');
let dateOfDeliveryEdit = document.getElementById('dateOfDeliveryEdit');
let vehiclePlateNumberEdit = document.getElementById('vehiclePlateNumberEdit');

let shipmentNumberEditHelp = document.getElementById('shipmentNumberEditHelp');
let shipmentStatusEditHelp = document.getElementById('shipmentStatusEditHelp');
let startingPointEditHelp = document.getElementById('startingPointEditHelp');
let destinationEditHelp = document.getElementById('destinationEditHelp');
let areaRateEditHelp = document.getElementById('areaRateEditHelp');
let callTimeEditHelp = document.getElementById('callTimeEditHelp');
let dateOfDeliveryEditHelp = document.getElementById('dateOfDeliveryEditHelp');
let vehiclePlateNumberEditHelp = document.getElementById('vehiclePlateNumberEditHelp');

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only

function editAjax(){
    $.post("./classes/edit-shipment-controller.class.php", {
        shipmentNumberEdit : shipmentNumberEdit.value, 
        shipmentStatusEdit : shipmentStatusEdit.value, 
        startingPointEdit : startingPointEdit.value, 
        destinationEdit : destinationEdit.value,
        areaRateEdit : areaRateEdit.value,
        callTimeEdit : callTimeEdit.value, 
        dateOfDeliveryEdit : dateOfDeliveryEdit.value, 
        vehiclePlateNumberEdit : vehiclePlateNumberEdit.value
    }, function(data){
      $("#submitEditFormHelp").html(data);
      $("#submitEditFormHelp").attr('class', 'help is-success');
      clearEditFormHelp();
      clearEditFormInput();
      refreshTable();
    });
    refreshTable();
}

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();

    let shipmentNumberEditMessages = []
    let shipmentStatusEditMessages = []
    let startingPointEditMessages = []
    let destinationEditMessages = []
    let areaRateEditMessages = []
    let callTimeEditMessages = []
    let dateOfDeliveryEditMessages = []
    let vehiclePlateNumberEditMessages = []

  //Shipment Number Validation
    if (pattern4.test(shipmentNumberEdit.value) == false) {
    shipmentNumberEdit.className = "input is-danger is-rounded"
    shipmentNumberEditHelp.className = "help is-danger"
    shipmentNumberEditMessages.push('Shipment number should only consist of numbers!')
    }

    if (shipmentNumberEdit.value === "" || shipmentNumberEdit.value == null) {
    shipmentNumberEdit.className = "input is-danger is-rounded"
    shipmentNumberEditHelp.className = "help is-danger"
    shipmentNumberEditMessages.push('Shipment number is required!')
    }

    if (shipmentNumberEdit.value.length < 1) {
    shipmentNumberEdit.className = "input is-danger is-rounded"
    shipmentNumberEditHelp.className = "help is-danger"
    shipmentNumberEditMessages.push('Shipment number must be longer than 1 character!')
    }

    if (shipmentNumberEdit.value.length > 255) {
    shipmentNumberEdit.className = "input is-danger is-rounded"
    shipmentNumberEditHelp.className = "help is-danger"
    shipmentNumberEditMessages.push('Shipment number must be less than 255 characters!')
    }

    //Shipment Status Validation
    if (shipmentStatusEdit.value === "" || shipmentStatusEdit.value == null) {
    shipmentStatusEdit.className = "input is-danger is-rounded"
    shipmentStatusEditHelp.className = "help is-danger"
    shipmentStatusEditMessages.push('Shipment status is required!')
    }

    //Starting Point Validation
    if (pattern2.test(startingPointEdit.value) == false) {
    startingPointEdit.className = "input is-danger is-rounded"
    startingPointEditHelp.className = "help is-danger"
    startingPointEditMessages.push('Starting point should only consist of numbers and letters!')
    }

    if (startingPointEdit.value === "" || startingPointEdit.value == null) {
    startingPointEdit.className = "input is-danger is-rounded"
    startingPointEditHelp.className = "help is-danger"
    startingPointEditMessages.push('Starting point is required!')
    }

    if (startingPointEdit.value.length < 1) {
    startingPointEdit.className = "input is-danger is-rounded"
    startingPointEditHelp.className = "help is-danger"
    startingPointEditMessages.push('Starting point must be longer than 1 character!')
    }

    if (startingPointEdit.value.length > 255) {
    startingPointEdit.className = "input is-danger is-rounded"
    startingPointEditHelp.className = "help is-danger"
    startingPointEditMessages.push('Starting point must be less than 255 characters!')
    }

    //Destination Validation
    if (pattern2.test(destinationEdit.value) == false) {
    destinationEdit.className = "input is-danger is-rounded"
    destinationEditHelp.className = "help is-danger"
    destinationEditMessages.push('Destination should only consist of numbers and letters!')
    }

    if (destinationEdit.value === "" || destinationEdit.value == null) {
    destinationEdit.className = "input is-danger is-rounded"
    destinationEditHelp.className = "help is-danger"
    destinationEditMessages.push('Destination is required!')
    }

    if (destinationEdit.value.length < 1) {
    destinationEdit.className = "input is-danger is-rounded"
    destinationEditHelp.className = "help is-danger"
    destinationEditMessages.push('Destination must be longer than 1 character!')
    }

    if (destinationEdit.value.length > 255) {
    destinationEdit.className = "input is-danger is-rounded"
    destinationEditHelp.className = "help is-danger"
    destinationEditMessages.push('Destination must be less than 255 characters!')
    }

    //Area Rate Validation
    if (pattern4.test(areaRateEdit.value) == false) {
        areaRateEdit.className = "input is-danger is-rounded"
        areaRateEditHelp.className = "help is-danger"
        areaRateEditMessages.push('Area rate should only consist of numbers!')
    }

    if (areaRateEdit.value === "" || areaRateEdit.value == null) {
        areaRateEdit.className = "input is-danger is-rounded"
        areaRateEditHelp.className = "help is-danger"
        areaRateEditMessages.push('Area rate is required!')
    }

    if (areaRateEdit.value.length < 1) {
        areaRateEdit.className = "input is-danger is-rounded"
        areaRateEditHelp.className = "help is-danger"
        areaRateEditMessages.push('Area rate must be longer than 1 character!')
    }

    if (areaRateEdit.value.length > 255) {
        areaRateEdit.className = "input is-danger is-rounded"
        areaRateEditHelp.className = "help is-danger"
        areaRateEditMessages.push('Area rate must be less than 255 characters!')
    }

    //Call Time Validation
    if (callTimeEdit.value === "" || callTimeEdit.value == null) {
    callTimeEdit.className = "input is-danger is-rounded"
    callTimeEditHelp.className = "help is-danger"
    callTimeEditMessages.push('Call time is required!')
    }

    //Date of Delivery Validation
    if (dateOfDeliveryEdit.value === "" || dateOfDeliveryEdit.value == null) {
    dateOfDeliveryEdit.className = "input is-danger is-rounded"
    dateOfDeliveryEditHelp.className = "help is-danger"
    dateOfDeliveryEditMessages.push('Date of delivery is required!')
    }

    //Vehicle Plate Number Validation
    if (pattern1.test(vehiclePlateNumberEdit.value) == false) {
        vehiclePlateNumberEdit.className = "input is-danger is-rounded"
        vehiclePlateNumberEditHelp.className = "help is-danger"
        vehiclePlateNumberEditMessages.push('Vehicle Plate Number should only consist of numbers and letters!')
    }

    if (vehiclePlateNumberEdit.value === "" || vehiclePlateNumberEdit.value == null) {
        vehiclePlateNumberEdit.className = "input is-danger is-rounded"
        vehiclePlateNumberEditHelp.className = "help is-danger"
        vehiclePlateNumberEditMessages.push('Vehicle Plate Number is required!')
    }

    if (vehiclePlateNumberEdit.value.length < 1) {
        vehiclePlateNumberEdit.className = "input is-danger is-rounded"
        vehiclePlateNumberEditHelp.className = "help is-danger"
        vehiclePlateNumberEditMessages.push('Vehicle Plate Number must be longer than 1 character!')
    }

    if (vehiclePlateNumberEdit.value.length > 255) {
        vehiclePlateNumberEdit.className = "input is-danger is-rounded"
        vehiclePlateNumberEditHelp.className = "help is-danger"
        vehiclePlateNumberEditMessages.push('Vehicle Plate Number must be less than 255 characters!')
    }

    //Messages
    if (shipmentNumberEditMessages.length > 0) {
    e.preventDefault()
    shipmentNumberEditHelp.innerText = shipmentNumberEditMessages.join(', ')
    }
    if (shipmentStatusEditMessages.length > 0) {
    e.preventDefault()
    shipmentStatusEditHelp.innerText = shipmentStatusEditMessages.join(', ')
    }
    if (startingPointEditMessages.length > 0) {
    e.preventDefault()
    startingPointEditHelp.innerText = startingPointEditMessages.join(', ')
    }
    if (destinationEditMessages.length > 0) {
    e.preventDefault()
    destinationEditHelp.innerText = destinationEditMessages.join(', ')
    }
    if (areaRateEditMessages.length > 0) {
    e.preventDefault()
    areaRateEditHelp.innerText = areaRateEditMessages.join(', ')
    }
    if (callTimeEditMessages.length > 0) {
    e.preventDefault()
    callTimeEditHelp.innerText = callTimeEditMessages.join(', ')
    }
    if (dateOfDeliveryEditMessages.length > 0) {
    e.preventDefault()
    dateOfDeliveryEditHelp.innerText = dateOfDeliveryEditMessages.join(', ')
    }
    if (vehiclePlateNumberEditMessages.length > 0) {
    e.preventDefault()
    vehiclePlateNumberEditHelp.innerText = vehiclePlateNumberEditMessages.join(', ')
    }
    if(
        shipmentNumberEditMessages.length <= 0 && 
        shipmentStatusEditMessages.length <= 0 && 
        startingPointEditMessages.length <= 0 && 
        destinationEditMessages.length <= 0 &&
        areaRateEditMessages.length <= 0 &&
        callTimeEditMessages.length <= 0 && 
        dateOfDeliveryEditMessages.length <= 0 && 
        vehiclePlateNumberEditMessages.length <= 0 
        ){
            editAjax();
        }
    refreshTable();
})

function populateVehiclePlateNumberEdit(){
    $.post("./classes/load-vehicle-select.class.php", {
      }, function(data){
        
        var jsonArray = JSON.parse(data);
  
        for(var i=0;i < jsonArray.length;i++){
        var newOption = document.createElement("option");
        newOption.value = jsonArray[i][0];
        newOption.innerHTML = jsonArray[i][0];
        vehiclePlateNumberEdit.options.add(newOption);
        }
  
        //closeSelect();
      });
      
}
//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let shipmentNumberAdd = document.getElementById('shipmentNumberAdd');
let shipmentStatusAdd = document.getElementById('shipmentStatusAdd');
let startingPointAdd = document.getElementById('startingPointAdd');
let destinationAdd = document.getElementById('destinationAdd');
let areaRateAdd = document.getElementById('areaRateAdd');
let callTimeAdd = document.getElementById('callTimeAdd');
let dateOfDeliveryAdd = document.getElementById('dateOfDeliveryAdd');
let vehiclePlateNumberAdd = document.getElementById('vehiclePlateNumberAdd');

let shipmentNumberAddHelp = document.getElementById('shipmentNumberAddHelp');
let shipmentStatusAddHelp = document.getElementById('shipmentStatusAddHelp');
let startingPointAddHelp = document.getElementById('startingPointAddHelp');
let destinationAddHelp = document.getElementById('destinationAddHelp');
let areaRateAddHelp = document.getElementById('areaRateAddHelp');
let callTimeAddHelp = document.getElementById('callTimeAddHelp');
let dateOfDeliveryAddHelp = document.getElementById('dateOfDeliveryAddHelp');
let vehiclePlateNumberAddHelp = document.getElementById('vehiclePlateNumberAddHelp');

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only

function addAjax(){
    $.post("./classes/add-shipment-controller.class.php", {
        shipmentNumberAdd : shipmentNumberAdd.value, 
        shipmentStatusAdd : shipmentStatusAdd.value, 
        startingPointAdd : startingPointAdd.value, 
        destinationAdd : destinationAdd.value,
        areaRateAdd : areaRateAdd.value,
        callTimeAdd : callTimeAdd.value, 
        dateOfDeliveryAdd : dateOfDeliveryAdd.value, 
        vehiclePlateNumberAdd : vehiclePlateNumberAdd.value
    }, function(data){
    $("#submitAddFormHelp").html(data);
    $("#submitAddFormHelp").attr('class', 'help is-success');
    clearAddFormHelp();
    clearAddFormInput();
    refreshTable();
    });
    refreshTable();
    
}

submitAddForm.addEventListener('click', (e) => {
    clearAddFormHelp();

    let shipmentNumberAddMessages = []
    let shipmentStatusAddMessages = []
    let startingPointAddMessages = []
    let destinationAddMessages = []
    let areaRateAddMessages = []
    let callTimeAddMessages = []
    let dateOfDeliveryAddMessages = []
    let vehiclePlateNumberAddMessages = []

    //Shipment Number Validation
    if (pattern4.test(shipmentNumberAdd.value) == false) {
    shipmentNumberAdd.className = "input is-danger is-rounded"
    shipmentNumberAddHelp.className = "help is-danger"
    shipmentNumberAddMessages.push('Shipment number should only consist of numbers!')
    }

    if (shipmentNumberAdd.value === "" || shipmentNumberAdd.value == null) {
    shipmentNumberAdd.className = "input is-danger is-rounded"
    shipmentNumberAddHelp.className = "help is-danger"
    shipmentNumberAddMessages.push('Shipment number is required!')
    }

    if (shipmentNumberAdd.value.length < 1) {
    shipmentNumberAdd.className = "input is-danger is-rounded"
    shipmentNumberAddHelp.className = "help is-danger"
    shipmentNumberAddMessages.push('Shipment number must be longer than 1 character!')
    }

    if (shipmentNumberAdd.value.length > 255) {
    shipmentNumberAdd.className = "input is-danger is-rounded"
    shipmentNumberAddHelp.className = "help is-danger"
    shipmentNumberAddMessages.push('Shipment number must be less than 255 characters!')
    }

    //Shipment Status Validation
    if (shipmentStatusAdd.value === "" || shipmentStatusAdd.value == null) {
    shipmentStatusAdd.className = "input is-danger is-rounded"
    shipmentStatusAddHelp.className = "help is-danger"
    shipmentStatusAddMessages.push('Shipment status is required!')
    }

    //Starting Point Validation
    if (pattern2.test(startingPointAdd.value) == false) {
    startingPointAdd.className = "input is-danger is-rounded"
    startingPointAddHelp.className = "help is-danger"
    startingPointAddMessages.push('Starting point should only consist of numbers and letters!')
    }

    if (startingPointAdd.value === "" || startingPointAdd.value == null) {
    startingPointAdd.className = "input is-danger is-rounded"
    startingPointAddHelp.className = "help is-danger"
    startingPointAddMessages.push('Starting point is required!')
    }

    if (startingPointAdd.value.length < 1) {
    startingPointAdd.className = "input is-danger is-rounded"
    startingPointAddHelp.className = "help is-danger"
    startingPointAddMessages.push('Starting point must be longer than 1 character!')
    }

    if (startingPointAdd.value.length > 255) {
    startingPointAdd.className = "input is-danger is-rounded"
    startingPointAddHelp.className = "help is-danger"
    startingPointAddMessages.push('Starting point must be less than 255 characters!')
    }

    //Destination Validation
    if (pattern2.test(destinationAdd.value) == false) {
    destinationAdd.className = "input is-danger is-rounded"
    destinationAddHelp.className = "help is-danger"
    destinationAddMessages.push('Destination should only consist of numbers and letters!')
    }

    if (destinationAdd.value === "" || destinationAdd.value == null) {
    destinationAdd.className = "input is-danger is-rounded"
    destinationAddHelp.className = "help is-danger"
    destinationAddMessages.push('Destination is required!')
    }

    if (destinationAdd.value.length < 1) {
    destinationAdd.className = "input is-danger is-rounded"
    destinationAddHelp.className = "help is-danger"
    destinationAddMessages.push('Destination must be longer than 1 character!')
    }

    if (destinationAdd.value.length > 255) {
    destinationAdd.className = "input is-danger is-rounded"
    destinationAddHelp.className = "help is-danger"
    destinationAddMessages.push('Destination must be less than 255 characters!')
    }

    //Area Rate Validation
    if (pattern4.test(areaRateAdd.value) == false) {
        areaRateAdd.className = "input is-danger is-rounded"
        areaRateAddHelp.className = "help is-danger"
        areaRateAddMessages.push('Area rate should only consist of numbers!')
    }

    if (areaRateAdd.value === "" || areaRateAdd.value == null) {
        areaRateAdd.className = "input is-danger is-rounded"
        areaRateAddHelp.className = "help is-danger"
        areaRateAddMessages.push('Area rate is required!')
    }

    if (areaRateAdd.value.length < 1) {
        areaRateAdd.className = "input is-danger is-rounded"
        areaRateAddHelp.className = "help is-danger"
        areaRateAddMessages.push('Area rate must be longer than 1 character!')
    }

    if (areaRateAdd.value.length > 255) {
        areaRateAdd.className = "input is-danger is-rounded"
        areaRateAddHelp.className = "help is-danger"
        areaRateAddMessages.push('Area rate must be less than 255 characters!')
    }

    //Call Time Validation
    if (callTimeAdd.value === "" || callTimeAdd.value == null) {
    callTimeAdd.className = "input is-danger is-rounded"
    callTimeAddHelp.className = "help is-danger"
    callTimeAddMessages.push('Call time is required!')
    }

    //Date of Delivery Validation
    if (dateOfDeliveryAdd.value === "" || dateOfDeliveryAdd.value == null) {
    dateOfDeliveryAdd.className = "input is-danger is-rounded"
    dateOfDeliveryAddHelp.className = "help is-danger"
    dateOfDeliveryAddMessages.push('Date of delivery is required!')
    }

    //Vehicle Plate Number Validation
    if (pattern1.test(vehiclePlateNumberAdd.value) == false) {
        vehiclePlateNumberAdd.className = "input is-danger is-rounded"
        vehiclePlateNumberAddHelp.className = "help is-danger"
        vehiclePlateNumberAddMessages.push('Vehicle Plate Number should only consist of numbers and letters!')
    }

    if (vehiclePlateNumberAdd.value === "" || vehiclePlateNumberAdd.value == null) {
        vehiclePlateNumberAdd.className = "input is-danger is-rounded"
        vehiclePlateNumberAddHelp.className = "help is-danger"
        vehiclePlateNumberAddMessages.push('Vehicle Plate Number is required!')
    }

    if (vehiclePlateNumberAdd.value.length < 1) {
        vehiclePlateNumberAdd.className = "input is-danger is-rounded"
        vehiclePlateNumberAddHelp.className = "help is-danger"
        vehiclePlateNumberAddMessages.push('Vehicle Plate Number must be longer than 1 character!')
    }

    if (vehiclePlateNumberAdd.value.length > 255) {
        vehiclePlateNumberAdd.className = "input is-danger is-rounded"
        vehiclePlateNumberAddHelp.className = "help is-danger"
        vehiclePlateNumberAddMessages.push('Vehicle Plate Number must be less than 255 characters!')
    }

    //Messages
    if (shipmentNumberAddMessages.length > 0) {
    e.preventDefault()
    shipmentNumberAddHelp.innerText = shipmentNumberAddMessages.join(', ')
    }
    if (shipmentStatusAddMessages.length > 0) {
    e.preventDefault()
    shipmentStatusAddHelp.innerText = shipmentStatusAddMessages.join(', ')
    }
    if (startingPointAddMessages.length > 0) {
    e.preventDefault()
    startingPointAddHelp.innerText = startingPointAddMessages.join(', ')
    }
    if (destinationAddMessages.length > 0) {
    e.preventDefault()
    destinationAddHelp.innerText = destinationAddMessages.join(', ')
    }
    if (areaRateAddMessages.length > 0) {
    e.preventDefault()
    areaRateAddHelp.innerText = areaRateAddMessages.join(', ')
    }
    if (callTimeAddMessages.length > 0) {
    e.preventDefault()
    callTimeAddHelp.innerText = callTimeAddMessages.join(', ')
    }
    if (dateOfDeliveryAddMessages.length > 0) {
    e.preventDefault()
    dateOfDeliveryAddHelp.innerText = dateOfDeliveryAddMessages.join(', ')
    }
    if (vehiclePlateNumberAddMessages.length > 0) {
    e.preventDefault()
    vehiclePlateNumberAddHelp.innerText = vehiclePlateNumberAddMessages.join(', ')
    }
    if(
        shipmentNumberAddMessages.length <= 0 && 
        shipmentStatusAddMessages.length <= 0 && 
        startingPointAddMessages.length <= 0 && 
        destinationAddMessages.length <= 0 &&
        areaRateAddMessages.length <= 0 &&
        callTimeAddMessages.length <= 0 && 
        dateOfDeliveryAddMessages.length <= 0 && 
        vehiclePlateNumberAddMessages.length <= 0 
        ){
            addAjax();
        }
        refreshTable();
})

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

function removeSelectAdd(selectElement) {
var i, L = selectElement.options.length - 1;
for(i = L; i >= 0; i--) {
    selectElement.remove(i);
}
}

//DELETE
let submitDeleteForm = document.getElementById('submitDeleteForm');
let shipmentNumberDelete = document.getElementById('shipmentNumberDelete');

function deleteAjax(){
    $.post("./classes/delete-shipment-controller.class.php", {
        shipmentNumberDelete : shipmentNumberDelete.value
    }, function(data){
        refreshTable();
    });
    refreshTable();
}

submitDeleteForm.addEventListener('click', (e) => {
    deleteAjax();
    deleteModal.classList.remove('is-active');
    refreshTable();
})

//GENERATE AJAX CALLS WITH VALIDATION
let submitGenerateForm = document.getElementById('submitGenerateForm'); //save changes button

let billingInvoiceNumberGenerate = document.getElementById('billingInvoiceNumberGenerate');
let clientGenerate = document.getElementById('clientGenerate');
let dropFeeGenerate = document.getElementById('dropFeeGenerate');
let parkingFeeGenerate = document.getElementById('parkingFeeGenerate');
let demurrageGenerate = document.getElementById('demurrageGenerate');
let otherChargesGenerate = document.getElementById('otherChargesGenerate');
let lessPenaltiesGenerate = document.getElementById('lessPenaltiesGenerate');

let billingInvoiceNumberGenerateHelp = document.getElementById('billingInvoiceNumberGenerateHelp');
let clientGenerateHelp = document.getElementById('clientGenerateHelp');
let dropFeeGenerateHelp = document.getElementById('dropFeeGenerateHelp');
let parkingFeeGenerateHelp = document.getElementById('parkingFeeGenerateHelp');
let demurrageGenerateHelp = document.getElementById('demurrageGenerateHelp');
let otherChargesGenerateHelp = document.getElementById('otherChargesGenerateHelp');
let lessPenaltiesGenerateHelp = document.getElementById('lessPenaltiesGenerateHelp');


function generateAjax(){
    var shipmentNumberArray = [];
    var shipmentNumberCheckbox = document.getElementsByName("shipmentSelectRow1");

    for(var i = 0; i < shipmentNumberCheckbox.length; i++){
        if(shipmentNumberCheckbox[i].checked == true){
            shipmentNumberArray.push(shipmentNumberCheckbox[i].value);
        }
    }

    $.post("./classes/generate-invoice-controller.class.php", {
        billingInvoiceNumberGenerate : billingInvoiceNumberGenerate.value, 
        clientGenerate : clientGenerate.value, 
        dropFeeGenerate : dropFeeGenerate.value, 
        parkingFeeGenerate : parkingFeeGenerate.value, 
        demurrageGenerate : demurrageGenerate.value, 
        otherChargesGenerate : otherChargesGenerate.value, 
        lessPenaltiesGenerate : lessPenaltiesGenerate.value,
        shipmentNumberArray: JSON.stringify(shipmentNumberArray)
    }, function(data){
    
    $("#submitGenerateFormHelp").html("Successfully added a record!");
    $("#submitGenerateFormHelp").attr('class', 'help is-success');
    /*
    clearAddFormHelp();
    clearAddFormInput();
    */
    });
    //shipmentDatatable.ajax.reload();
}

submitGenerateForm.addEventListener('click', (e) => {
    clearGenerateFormHelp();

    let billingInvoiceNumberGenerateMessages = []
    let clientGenerateMessages = []
    let dropFeeGenerateMessages = []
    let parkingFeeGenerateMessages = []
    let demurrageGenerateMessages = []
    let otherChargesGenerateMessages = []
    let lessPenaltiesGenerateMessages = []

    //Invoice Number Validation
    if (pattern4.test(billingInvoiceNumberGenerate.value) == false) {
    billingInvoiceNumberGenerate.className = "input is-danger is-rounded"
    billingInvoiceNumberGenerateHelp.className = "help is-danger"
    billingInvoiceNumberGenerateMessages.push('Invoice number should only consist of numbers!')
    }

    if (billingInvoiceNumberGenerate.value === "" || billingInvoiceNumberGenerate.value == null) {
    billingInvoiceNumberGenerate.className = "input is-danger is-rounded"
    billingInvoiceNumberGenerateHelp.className = "help is-danger"
    billingInvoiceNumberGenerateMessages.push('Invoice number is required!')
    }

    if (billingInvoiceNumberGenerate.value.length < 1) {
    billingInvoiceNumberGenerate.className = "input is-danger is-rounded"
    billingInvoiceNumberGenerateHelp.className = "help is-danger"
    billingInvoiceNumberGenerateMessages.push('Invoice number must be longer than 1 character!')
    }

    if (billingInvoiceNumberGenerate.value.length > 255) {
    billingInvoiceNumberGenerate.className = "input is-danger is-rounded"
    billingInvoiceNumberGenerateHelp.className = "help is-danger"
    billingInvoiceNumberGenerateMessages.push('Invoice number must be less than 255 characters!')
    }

    //Client Validation
    if (pattern2.test(clientGenerate.value) == false) {
    clientGenerate.className = "input is-danger is-rounded"
    clientGenerateHelp.className = "help is-danger"
    clientGenerateMessages.push('Client should only consist of numbers and letters!')
    }

    if (clientGenerate.value === "" || clientGenerate.value == null) {
    clientGenerate.className = "input is-danger is-rounded"
    clientGenerateHelp.className = "help is-danger"
    clientGenerateMessages.push('Client is required!')
    }

    if (clientGenerate.value.length < 1) {
    clientGenerate.className = "input is-danger is-rounded"
    clientGenerateHelp.className = "help is-danger"
    clientGenerateMessages.push('Client must be longer than 1 character!')
    }

    if (clientGenerate.value.length > 255) {
    clientGenerate.className = "input is-danger is-rounded"
    clientGenerateHelp.className = "help is-danger"
    clientGenerateMessages.push('Client must be less than 255 characters!')
    }
    //Drop Fee Validation
    if (pattern4.test(dropFeeGenerate.value) == false) {
        dropFeeGenerate.className = "input is-danger is-rounded"
        dropFeeGenerateHelp.className = "help is-danger"
        dropFeeGenerateMessages.push('Drop fee should only consist of numbers!')
    }

    if (dropFeeGenerate.value === "" || dropFeeGenerate.value == null) {
        dropFeeGenerate.className = "input is-danger is-rounded"
        dropFeeGenerateHelp.className = "help is-danger"
        dropFeeGenerateMessages.push('Drop fee is required!')
    }

    if (dropFeeGenerate.value.length < 1) {
        dropFeeGenerate.className = "input is-danger is-rounded"
        dropFeeGenerateHelp.className = "help is-danger"
        dropFeeGenerateMessages.push('Drop fee must be longer than 1 character!')
    }

    if (dropFeeGenerate.value.length > 255) {
        dropFeeGenerate.className = "input is-danger is-rounded"
        dropFeeGenerateHelp.className = "help is-danger"
        dropFeeGenerateMessages.push('Drop fee must be less than 255 characters!')
    }
    //Parking Fee Validation
    if (pattern4.test(parkingFeeGenerate.value) == false) {
        parkingFeeGenerate.className = "input is-danger is-rounded"
        parkingFeeGenerateHelp.className = "help is-danger"
        parkingFeeGenerateMessages.push('Parking fee should only consist of numbers!')
    }

    if (parkingFeeGenerate.value === "" || parkingFeeGenerate.value == null) {
        parkingFeeGenerate.className = "input is-danger is-rounded"
        parkingFeeGenerateHelp.className = "help is-danger"
        parkingFeeGenerateMessages.push('Parking fee is required!')
    }

    if (parkingFeeGenerate.value.length < 1) {
        parkingFeeGenerate.className = "input is-danger is-rounded"
        parkingFeeGenerateHelp.className = "help is-danger"
        parkingFeeGenerateMessages.push('Parking fee must be longer than 1 character!')
    }

    if (parkingFeeGenerate.value.length > 255) {
        parkingFeeGenerate.className = "input is-danger is-rounded"
        parkingFeeGenerateHelp.className = "help is-danger"
        parkingFeeGenerateMessages.push('Parking fee must be less than 255 characters!')
    }
    //Demurrage Validation
    if (pattern4.test(demurrageGenerate.value) == false) {
        demurrageGenerate.className = "input is-danger is-rounded"
        demurrageGenerateHelp.className = "help is-danger"
        demurrageGenerateMessages.push('Demurrage should only consist of numbers!')
    }

    if (demurrageGenerate.value === "" || demurrageGenerate.value == null) {
        demurrageGenerate.className = "input is-danger is-rounded"
        demurrageGenerateHelp.className = "help is-danger"
        demurrageGenerateMessages.push('Demurrage is required!')
    }

    if (demurrageGenerate.value.length < 1) {
        demurrageGenerate.className = "input is-danger is-rounded"
        demurrageGenerateHelp.className = "help is-danger"
        demurrageGenerateMessages.push('Demurrage must be longer than 1 character!')
    }

    if (demurrageGenerate.value.length > 255) {
        demurrageGenerate.className = "input is-danger is-rounded"
        demurrageGenerateHelp.className = "help is-danger"
        demurrageGenerateMessages.push('Demurrage must be less than 255 characters!')
    }
    //Other Charges Validation
    if (pattern4.test(otherChargesGenerate.value) == false) {
        otherChargesGenerate.className = "input is-danger is-rounded"
        otherChargesGenerateHelp.className = "help is-danger"
        otherChargesGenerateMessages.push('Other charges should only consist of numbers!')
    }

    if (otherChargesGenerate.value === "" || otherChargesGenerate.value == null) {
        otherChargesGenerate.className = "input is-danger is-rounded"
        otherChargesGenerateHelp.className = "help is-danger"
        otherChargesGenerateMessages.push('Other charges is required!')
    }

    if (otherChargesGenerate.value.length < 1) {
        otherChargesGenerate.className = "input is-danger is-rounded"
        otherChargesGenerateHelp.className = "help is-danger"
        otherChargesGenerateMessages.push('Other charges must be longer than 1 character!')
    }

    if (otherChargesGenerate.value.length > 255) {
        otherChargesGenerate.className = "input is-danger is-rounded"
        otherChargesGenerateHelp.className = "help is-danger"
        otherChargesGenerateMessages.push('Other charges must be less than 255 characters!')
    }
    //Less Penalties Validation
    if (pattern4.test(lessPenaltiesGenerate.value) == false) {
        lessPenaltiesGenerate.className = "input is-danger is-rounded"
        lessPenaltiesGenerateHelp.className = "help is-danger"
        lessPenaltiesGenerateMessages.push('Less penalties should only consist of numbers!')
    }

    if (lessPenaltiesGenerate.value === "" || lessPenaltiesGenerate.value == null) {
        lessPenaltiesGenerate.className = "input is-danger is-rounded"
        lessPenaltiesGenerateHelp.className = "help is-danger"
        lessPenaltiesGenerateMessages.push('Less penalties is required!')
    }

    if (lessPenaltiesGenerate.value.length < 1) {
        lessPenaltiesGenerate.className = "input is-danger is-rounded"
        lessPenaltiesGenerateHelp.className = "help is-danger"
        lessPenaltiesGenerateMessages.push('Less penalties must be longer than 1 character!')
    }

    if (lessPenaltiesGenerate.value.length > 255) {
        lessPenaltiesGenerate.className = "input is-danger is-rounded"
        lessPenaltiesGenerateHelp.className = "help is-danger"
        lessPenaltiesGenerateMessages.push('Less penalties must be less than 255 characters!')
    }

    //Messages
    if (billingInvoiceNumberGenerateMessages.length > 0) {
    e.preventDefault()
    billingInvoiceNumberGenerateHelp.innerText = billingInvoiceNumberGenerateMessages.join(', ')
    }

    if (clientGenerateMessages.length > 0) {
    e.preventDefault()
    clientGenerateHelp.innerText = clientGenerateMessages.join(', ')
    }

    if (dropFeeGenerateMessages.length > 0) {
    e.preventDefault()
    dropFeeGenerateHelp.innerText = dropFeeGenerateMessages.join(', ')
    }

    if (parkingFeeGenerateMessages.length > 0) {
    e.preventDefault()
    parkingFeeGenerateHelp.innerText = parkingFeeGenerateMessages.join(', ')
    }

    if (demurrageGenerateMessages.length > 0) {
    e.preventDefault()
    demurrageGenerateHelp.innerText = demurrageGenerateMessages.join(', ')
    }

    if (otherChargesGenerateMessages.length > 0) {
    e.preventDefault()
    otherChargesGenerateHelp.innerText = otherChargesGenerateMessages.join(', ')
    }

    if (lessPenaltiesGenerateMessages.length > 0) {
    e.preventDefault()
    lessPenaltiesGenerateHelp.innerText = lessPenaltiesGenerateMessages.join(', ')
    }

    if(
        billingInvoiceNumberGenerateMessages.length <= 0 &&
        clientGenerateMessages.length <= 0 && 
        dropFeeGenerateMessages.length <= 0 && 
        parkingFeeGenerateMessages.length <= 0 && 
        demurrageGenerateMessages.length <= 0 && 
        otherChargesGenerateMessages.length <= 0 && 
        lessPenaltiesGenerateMessages.length <= 0
    ){
        generateAjax();
    }
    

})

/*
function generateInvoice(){
    var values1 = [];
    var values2 = [];
    var boxes1 = document.getElementsByName("shipmentSelectRow1");
    var boxes2 = document.getElementsByName("shipmentSelectRow2");
    for(var i = 0; i < boxes1.length; i++){
        if(boxes1[i].checked == true){
            values1.push(boxes1[i].value);
        }
    }
    alert(values1.toString());
}*/