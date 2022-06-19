//GENERATING DATATABLE
var payslipDatatable = $('#payslipTable').DataTable({
    "ajax": {
        "url": "classes/load-payslip.class.php",
        "dataSrc": ""
    },
    "columns": [
        {"data": "payslipNumber", "width": "10%"},
        {"data": "dateIssued", "width": "10%"},
        {"data": "billingInvoiceNumber", "width": "10%"},
        {"data": "vehiclePlateNumber", "width": "10%"},
        {"data": "ownerUsername", "width": "10%"},
        {"data": null, "width": "10%","render": function(s_data, s_type, s_row){

            return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openPayslip(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-file-alt"></i></button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openBilledShipment(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-list"></i> </button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openDelete(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-trash-alt"></i> </button>';
        }}
    ]
});


//MANIPULATING MODALS
//const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');
const payslipModal = document.getElementById('payslipModal');
const billedShipmentModal = document.getElementById('billedShipmentModal');
const deleteModal = document.getElementById('deleteModal');


function openAdd(){
    addModal.classList.add('is-active');
    populateVehiclePlateNumberAdd();
    populateBillingInvoiceNumberAdd();
}

function closeAdd(){
    clearAddFormHelp();
    clearAddFormInput();
    
    addModal.classList.remove('is-active');
    removeSelectAdd(document.getElementById('vehiclePlateNumberAdd'));
    removeSelectAdd(document.getElementById('billingInvoiceNumberAdd'));
}

function openPayslip(payslipVal){
  payslipModal.classList.add('is-active');
  payslipAjax(payslipVal);
  //document.getElementById('truckRatePayslip').innerHTML = payslipVal;
}

function closePayslip(){
  payslipModal.classList.remove('is-active');
}

function openBilledShipment(billedShipmentVal){
  billedShipmentModal.classList.add('is-active');
  billedShipmentAjax(billedShipmentVal);
}

function closeBilledShipment(){
  billedShipmentModal.classList.remove('is-active');
  $("#billedShipmentTable").dataTable().fnDestroy();
}

/*
function openEdit(editVal1, editVal2){
    document.getElementById('payslipNumberEdit').setAttribute('value', editVal1);
    document.getElementById('shipmentNumberEdit').setAttribute('value', editVal2);
    editModal.classList.add('is-active');
}

function closeEdit(){
  clearEditFormHelp();
  clearEditFormInput();
  editModal.classList.remove('is-active');
}

function openDelete(deleteVal1, deleteVal2, deleteVal3, deleteVal4, deleteVal5, deleteVal6){
    document.getElementById('payslipNumberDelete').setAttribute('value', deleteVal1);
    document.getElementById('dateIssuedDelete').setAttribute('value', deleteVal2);
    document.getElementById('shipmentNumberDelete').setAttribute('value', deleteVal3);
    document.getElementById('areaRateDelete').setAttribute('value', deleteVal4);
    document.getElementById('commissionRateDelete').setAttribute('value', deleteVal5);
    document.getElementById('penaltyDelete').setAttribute('value', deleteVal6);
    deleteModal.classList.add('is-active');
}
function closeDelete(){
    deleteModal.classList.remove('is-active');
}

function openCalculate(){
  calculateModal.classList.add('is-active');
}
function closeCalculate(){
  clearCalculateFormHelp();
  clearCalculateFormInput();
  calculateModal.classList.remove('is-active');
}
*/
function refreshTable(){
  payslipDatatable.ajax.reload();
}

var deleteVar;

function openDelete(deleteVal){
  deleteModal.classList.add('is-active');
  deleteVar = deleteVal;
  return deleteVar;
}

function closeDelete(){
  deleteModal.classList.remove('is-active');
}

//DELETE AJAX
let submitDeleteForm = document.getElementById('submitDeleteForm');

function deletePayslipAjax(){
    $.post("./classes/delete-payslip-controller.class.php", {
        payslipNumberDelete : deleteVar
    }, function(data){
    });
    //shipmentDatatable.ajax.reload();
}

submitDeleteForm.addEventListener('click', (e) => {
    deletePayslipAjax();
    //shipmentDatatable.ajax.reload();
    //deleteModal.classList.remove('is-active');
})

//INVOICE MODAL
let truckRatePayslip = document.getElementById('truckRatePayslip');
let dropOffPayslip = document.getElementById('dropOffPayslip');
let penaltyPayslip = document.getElementById('penaltyPayslip');
let subtotalPayslip = document.getElementById('subtotalPayslip');
let withholdingTaxPayslip = document.getElementById('withholdingTaxPayslip');
let commissionRatePayslip = document.getElementById('commissionRatePayslip');
let netPayPayslip = document.getElementById('netPayPayslip');

function payslipAjax(payslipNumberData){
  //clearInfo();
  
  $.post("./classes/load-payslip-detail.class.php", {
    payslipNumber : payslipNumberData
  }, function(data){
    var jsonArray = JSON.parse(data);
    
    truckRatePayslip.innerHTML = "Truck Rate: " + jsonArray[0][0];
    dropOffPayslip.innerHTML = "Drop Off Fee: " + jsonArray[0][1];
    penaltyPayslip.innerHTML = "Penalty: " + jsonArray[0][2];

    var subtotalVar = parseFloat(jsonArray[0][0]) + parseFloat(jsonArray[0][1]) + parseFloat(jsonArray[0][2]);

    subtotalPayslip.innerHTML = "<strong> Subtotal: " + Number((subtotalVar).toFixed(2)) + "</strong>";

    var withholdingTaxVar = (parseFloat(jsonArray[0][3]) / 100) * subtotalVar;

    withholdingTaxPayslip.innerHTML = "Withholding Tax: " + Number((withholdingTaxVar).toFixed(2));

    var commissionRateVar = (parseFloat(jsonArray[0][4]) / 100) * subtotalVar;

    commissionRatePayslip.innerHTML = "Commission Rate: " + Number((commissionRateVar).toFixed(2));

    var netPayVar = subtotalVar - withholdingTaxVar - commissionRateVar;

    netPayPayslip.innerHTML = "<strong> Net Pay: " + Number((netPayVar).toFixed(2)) + "</strong>";

  })
}

//BILLED SHIPMENT MODAL
function billedShipmentAjax(payslipNumber){
  var billedShipmentDatatable = $('#billedShipmentTable').DataTable({
    "ajax": {
        "url": "classes/load-billed-shipment-payslip.class.php?payslipNumber=" + payslipNumber,
        "dataSrc": ""
    },
    "columns": [
        {"data": "dateOfDelivery", "width": "10%"},
        {"data": "shipmentNumber", "width": "10%"},
        {"data": "destination", "width": "10%"},
        {"data": "areaRate", "width": "10%"}
    ]
  });

}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let payslipNumberAdd = document.getElementById('payslipNumberAdd')
let dateIssuedAdd = document.getElementById('dateIssuedAdd')
let dropOffAdd = document.getElementById('dropOffAdd')
let penaltyAdd = document.getElementById('penaltyAdd')
let withholdingTaxAdd = document.getElementById('withholdingTaxAdd')
let commissionRateAdd = document.getElementById('commissionRateAdd')
let vehiclePlateNumberAdd = document.getElementById('vehiclePlateNumberAdd')
let billingInvoiceNumberAdd = document.getElementById('billingInvoiceNumberAdd')


let payslipNumberAddHelp = document.getElementById('payslipNumberAddHelp')
let dateIssuedAddHelp = document.getElementById('dateIssuedAddHelp')
let dropOffAddHelp = document.getElementById('dropOffAddHelp')
let penaltyAddHelp = document.getElementById('penaltyAddHelp')
let withholdingTaxAddHelp = document.getElementById('withholdingTaxAddHelp')
let commissionRateAddHelp = document.getElementById('commissionRateAddHelp')
let vehiclePlateNumberAddHelp = document.getElementById('vehiclePlateNumberAddHelp')
let billingInvoiceNumberAddHelp = document.getElementById('billingInvoiceNumberAddHelp')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[0-9]+$/
var pattern5 = /^[a-zA-Z0-9]+$/


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

function populateBillingInvoiceNumberAdd(){
  $.post("./classes/load-billing-invoice-number-select.class.php", {
    }, function(data1){
      
      var jsonArray1 = JSON.parse(data1);

      for(var i=0;i < jsonArray1.length;i++){
      var newOption1 = document.createElement("option");
      newOption1.value = jsonArray1[i][0];
      newOption1.innerHTML = jsonArray1[i][0];
      billingInvoiceNumberAdd.options.add(newOption1);
      }

      //closeSelect();
    });

}

function addAjax(){
    $.post("./classes/add-payslip-controller.class.php", {
      payslipNumberAdd : payslipNumberAdd.value,
      dateIssuedAdd : dateIssuedAdd.value,
      dropOffAdd : dropOffAdd.value,
      penaltyAdd : penaltyAdd.value,
      withholdingTaxAdd : withholdingTaxAdd.value,
      commissionRateAdd : commissionRateAdd.value,
      vehiclePlateNumberAdd : vehiclePlateNumberAdd.value,
      billingInvoiceNumberAdd : billingInvoiceNumberAdd.value
    }, function(data){
    
    $("#submitAddFormHelp").html("Successfully added a record!");
    $("#submitAddFormHelp").attr('class', 'help is-success');
    /*
    clearAddFormHelp();
    clearAddFormInput();
    addModal.classList.remove('is-active');
    */
    });
    refreshTable();
}

submitAddForm.addEventListener('click', (e) => {
  //addAjax();
  
  clearAddFormHelp();

  let payslipNumberAddMessages = []
  let dateIssuedAddMessages = []
  let dropOffAddMessages = []
  let penaltyAddMessages = []
  let withholdingTaxAddMessages = []
  let commissionRateAddMessages = []
  let billingInvoiceNumberAddMessages = []
  let vehiclePlateNumberAddMessages = []

  //Payslip Number Validation
  if (pattern2.test(payslipNumberAdd.value) == false) {
  payslipNumberAdd.className = "input is-danger is-rounded"
  payslipNumberAddHelp.className = "help is-danger"
  payslipNumberAddMessages.push('Payslip number should only consist of numbers!')
  }

  if (payslipNumberAdd.value === "" || payslipNumberAdd.value == null) {
  payslipNumberAdd.className = "input is-danger is-rounded"
  payslipNumberAddHelp.className = "help is-danger"
  payslipNumberAddMessages.push('Payslip number is required!')
  }

  if (payslipNumberAdd.value.length < 1) {
  payslipNumberAdd.className = "input is-danger is-rounded"
  payslipNumberAddHelp.className = "help is-danger"
  payslipNumberAddMessages.push('Payslip number must be longer than 1 character!')
  }

  if (payslipNumberAdd.value.length > 255) {
  payslipNumberAdd.className = "input is-danger is-rounded"
  payslipNumberAddHelp.className = "help is-danger"
  payslipNumberAddMessages.push('Payslip number must be less than 255 characters!')
  }

  //Date Issued Validation
  if (dateIssuedAdd.value === "" || dateIssuedAdd.value == null) {
  dateIssuedAdd.className = "input is-danger is-rounded"
  dateIssuedAddHelp.className = "help is-danger"
  dateIssuedAddMessages.push('Date Issued is required!')
  }

  //Vehicle Plate Number Validation

  if (vehiclePlateNumberAdd.value === "" || vehiclePlateNumberAdd.value == null) {
    vehiclePlateNumberAdd.className = "input is-danger is-rounded"
    vehiclePlateNumberAddHelp.className = "help is-danger"
    vehiclePlateNumberAddMessages.push('Vehicle plate number is required!')
  }

  //Invoice Number Validation

  if (billingInvoiceNumberAdd.value === "" || billingInvoiceNumberAdd.value == null) {
    billingInvoiceNumberAdd.className = "input is-danger is-rounded"
    billingInvoiceNumberAddHelp.className = "help is-danger"
    billingInvoiceNumberAddMessages.push('Invoice number is required!')
  }

  //Drop Off Validation
  if (pattern2.test(dropOffAdd.value) == false) {
    dropOffAdd.className = "input is-danger is-rounded"
    dropOffAddHelp.className = "help is-danger"
    dropOffAddMessages.push('Drop off fee should only consist of numbers!')
  }

  if (dropOffAdd.value === "" || dropOffAdd.value == null) {
    dropOffAdd.className = "input is-danger is-rounded"
    dropOffAddHelp.className = "help is-danger"
    dropOffAddMessages.push('Drop off fee is required!')
  }

  if (dropOffAdd.value.length < 1) {
    dropOffAdd.className = "input is-danger is-rounded"
    dropOffAddHelp.className = "help is-danger"
    dropOffAddMessages.push('Drop off fee must be longer than 1 character!')
  }

  if (dropOffAdd.value.length > 255) {
    dropOffAdd.className = "input is-danger is-rounded"
    dropOffAddHelp.className = "help is-danger"
    dropOffAddMessages.push('Drop off fee must be less than 255 characters!')
  }

  //Penalty Validation
  if (pattern2.test(penaltyAdd.value) == false) {
    penaltyAdd.className = "input is-danger is-rounded"
    penaltyAddHelp.className = "help is-danger"
    penaltyAddMessages.push('Penalty should only consist of numbers!')
  }

  if (penaltyAdd.value === "" || penaltyAdd.value == null) {
    penaltyAdd.className = "input is-danger is-rounded"
    penaltyAddHelp.className = "help is-danger"
    penaltyAddMessages.push('Penalty is required!')
  }

  if (penaltyAdd.value.length < 1) {
    penaltyAdd.className = "input is-danger is-rounded"
    penaltyAddHelp.className = "help is-danger"
    penaltyAddMessages.push('Penalty must be longer than 1 character!')
  }

  if (penaltyAdd.value.length > 255) {
    penaltyAdd.className = "input is-danger is-rounded"
    penaltyAddHelp.className = "help is-danger"
    penaltyAddMessages.push('Penalty must be less than 255 characters!')
  }
  //Withholding Tax Validation
  if (pattern2.test(withholdingTaxAdd.value) == false) {
    withholdingTaxAdd.className = "input is-danger is-rounded"
    withholdingTaxAddHelp.className = "help is-danger"
    withholdingTaxAddMessages.push('Withholding tax rate should only consist of numbers!')
  }

  if (withholdingTaxAdd.value === "" || withholdingTaxAdd.value == null) {
    withholdingTaxAdd.className = "input is-danger is-rounded"
    withholdingTaxAddHelp.className = "help is-danger"
    withholdingTaxAddMessages.push('Withholding tax rate is required!')
  }

  if (withholdingTaxAdd.value > 100) {
    withholdingTaxAdd.className = "input is-danger is-rounded"
    withholdingTaxAddHelp.className = "help is-danger"
    withholdingTaxAddMessages.push('Maximum withholding tax rate is 100%!')
  }
  //Commission Rate Validation
  if (pattern2.test(commissionRateAdd.value) == false) {
    commissionRateAdd.className = "input is-danger is-rounded"
    commissionRateAddHelp.className = "help is-danger"
    commissionRateAddMessages.push('Commission rate should only consist of numbers!')
  }

  if (commissionRateAdd.value === "" || commissionRateAdd.value == null) {
    commissionRateAdd.className = "input is-danger is-rounded"
    commissionRateAddHelp.className = "help is-danger"
    commissionRateAddMessages.push('Commission rate is required!')
  }

  if (commissionRateAdd.value > 100) {
    commissionRateAdd.className = "input is-danger is-rounded"
    commissionRateAddHelp.className = "help is-danger"
    commissionRateAddMessages.push('Maximum commission rate is 100%!')
  }
  
  
  //Messages
  if (payslipNumberAddMessages.length > 0) {
  e.preventDefault()
  payslipNumberAddHelp.innerText = payslipNumberAddMessages.join(', ')
  }

  if (dateIssuedAddMessages.length > 0) {
  e.preventDefault()
  dateIssuedAddHelp.innerText = dateIssuedAddMessages.join(', ');
  }

  if (vehiclePlateNumberAddMessages.length > 0) {
  e.preventDefault()
  vehiclePlateNumberAddHelp.innerText = vehiclePlateNumberAddMessages.join(', ')
  }

  if (billingInvoiceNumberAddMessages.length > 0) {
  e.preventDefault()
  billingInvoiceNumberAddHelp.innerText = billingInvoiceNumberAddMessages.join(', ')
  }
  if (dropOffAddMessages.length > 0) {
  e.preventDefault()
  dropOffAddHelp.innerText = dropOffAddMessages.join(', ')
  }

  if (penaltyAddMessages.length > 0) {
  e.preventDefault()
  penaltyAddHelp.innerText = penaltyAddMessages.join(', ')
  }
  if (withholdingTaxAddMessages.length > 0) {
  e.preventDefault()
  withholdingTaxAddHelp.innerText = withholdingTaxAddMessages.join(', ')
  }
  if (commissionRateAddMessages.length > 0) {
  e.preventDefault()
  commissionRateAddHelp.innerText = commissionRateAddMessages.join(', ')
  }
  if(
  payslipNumberAddMessages.length <= 0 && 
  dateIssuedAddMessages.length <= 0 && 
  vehiclePlateNumberAddMessages.length <= 0 && 
  billingInvoiceNumberAddMessages.length <= 0 && 
  dropOffAddMessages.length <= 0 && 
  penaltyAddMessages.length <= 0 && 
  withholdingTaxAddMessages.length <= 0 && 
  commissionRateAddMessages.length <= 0
  ){
  addAjax();
  }
  refreshTable();

})


function clearAddFormHelp(){
  //RESETTING FORM ELEMENTS
  payslipNumberAdd.className = "input is-rounded"
  payslipNumberAddHelp.className = "help"
  payslipNumberAddHelp.innerText = ""

  dateIssuedAdd.className = "input is-rounded"
  dateIssuedAddHelp.className = "help"
  dateIssuedAddHelp.innerText = ""

  vehiclePlateNumberAdd.className = "input is-rounded"
  vehiclePlateNumberAddHelp.className = "help"
  vehiclePlateNumberAddHelp.innerText = ""

  billingInvoiceNumberAdd.className = "input is-rounded"
  billingInvoiceNumberAddHelp.className = "help"
  billingInvoiceNumberAddHelp.innerText = ""

  dropOffAdd.className = "input is-rounded"
  dropOffAddHelp.className = "help"
  dropOffAddHelp.innerText = ""

  penaltyAdd.className = "input is-rounded"
  penaltyAddHelp.className = "help"
  penaltyAddHelp.innerText = ""

  commissionRateAdd.className = "input is-rounded"
  commissionRateAddHelp.className = "help"
  commissionRateAddHelp.innerText = ""

  withholdingTaxAdd.className = "input is-rounded"
  withholdingTaxAddHelp.className = "help"
  withholdingTaxAddHelp.innerText = ""

}

function clearAddFormInput(){
  payslipNumberAdd.value = null;
  dateIssuedAdd.value = null;
  vehiclePlateNumberAdd.value = null;
  billingInvoiceNumberAdd.value = null;
  dropOffAdd.value = null;
  penaltyAdd.value = null;
  withholdingTaxAdd.value = null;
  commissionRateAdd.value = null;
}