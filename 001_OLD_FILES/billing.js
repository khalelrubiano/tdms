//GENERATING DATATABLE
var billingDatatable = $('#billingTable').DataTable({
  "ajax": {
    "url": "classes/load-billing.class.php",
    "dataSrc": ""
  },
  "columns": [
    { "data": "billingInvoiceNumber", "width": "10%" },
    { "data": "client", "width": "10%" },
    { "data": "billingStatus", "width": "10%" },
    { "data": "createdAt", "width": "10%" },
    {
      "data": null, "width": "10%", "render": function (s_data, s_type, s_row) {

        return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openEdit(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-edit"></i> </button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openDelete(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-trash-alt"></i> </button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openInvoice(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-file-alt"></i></button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openBilledShipment(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-list"></i> </button>';

      }
    }
  ],
  columnDefs: [
    {
      className: 'dt-right'
    }
  ]
});



//MANIPULATING MODALS
const invoiceModal = document.getElementById('invoiceModal');
const billedShipmentModal = document.getElementById('billedShipmentModal');
const deleteModal = document.getElementById('deleteModal');
const editModal = document.getElementById('editModal');

function openInvoice(invoiceVal) {
  invoiceModal.classList.add('is-active');
  invoiceAjax(invoiceVal);
}

function closeInvoice() {
  invoiceModal.classList.remove('is-active');
}

function openBilledShipment(billedShipmentVal) {
  billedShipmentModal.classList.add('is-active');
  billedShipmentAjax(billedShipmentVal);
}

function closeBilledShipment() {
  billedShipmentModal.classList.remove('is-active');
  $("#billedShipmentTable").dataTable().fnDestroy();
}
var deleteVar;
function openDelete(deleteVal) {
  deleteModal.classList.add('is-active');
  deleteVar = deleteVal;
  return deleteVar;
}

function closeDelete() {
  deleteModal.classList.remove('is-active');
}

var editVar;
function openEdit(editVal) {
  editModal.classList.add('is-active');
  editVar = editVal;
  return editVar;
}

function closeEdit() {
  clearEditFormHelp();
  //clearEditFormInput();
  editModal.classList.remove('is-active');
}

function refreshTable() {
  billingDatatable.ajax.reload();
}

//INVOICE MODAL
let invoiceNumberInvoice = document.getElementById('invoiceNumberInvoice');
let clientInvoice = document.getElementById('clientInvoice');
let truckRateInvoice = document.getElementById('truckRateInvoice');
let dropFeeInvoice = document.getElementById('dropFeeInvoice');
let parkingFeeInvoice = document.getElementById('parkingFeeInvoice');
let demurrageInvoice = document.getElementById('demurrageInvoice');
let otherChargesInvoice = document.getElementById('otherChargesInvoice');
let subtotalInvoice = document.getElementById('subtotalInvoice');
let valueAddedTaxInvoice = document.getElementById('valueAddedTaxInvoice');
let lessPenaltiesInvoice = document.getElementById('lessPenaltiesInvoice');
let totalTruckingChargesInvoice = document.getElementById('totalTruckingChargesInvoice');

function invoiceAjax(invoiceNumberData) {
  //clearInfo();

  $.post("./classes/load-billing-detail.class.php", {
    billingInvoiceNumber: invoiceNumberData
  }, function (data) {
    var jsonArray = JSON.parse(data);

    invoiceNumberInvoice.innerHTML = "Invoice Number: " + jsonArray[0][0];
    clientInvoice.innerHTML = "Client: " + jsonArray[0][1];
    truckRateInvoice.innerHTML = "Truck Rate: " + jsonArray[0][2];
    dropFeeInvoice.innerHTML = "Drop Fee: " + jsonArray[0][3];
    parkingFeeInvoice.innerHTML = "Parking Fee: " + jsonArray[0][4];
    demurrageInvoice.innerHTML = "Demurrage: " + jsonArray[0][5];
    otherChargesInvoice.innerHTML = "Other Charges: " + jsonArray[0][6];
    lessPenaltiesInvoice.innerHTML = "Less Penalties: " + jsonArray[0][7];

    var subtotalVar = parseFloat(jsonArray[0][2]) + parseFloat(jsonArray[0][3]) + parseFloat(jsonArray[0][4]) + parseFloat(jsonArray[0][5]) + parseFloat(jsonArray[0][6]);

    var valueAddedTaxVar = subtotalVar * 0.12;
    var totalTruckingChargesVar = (subtotalVar + valueAddedTaxVar) - parseFloat(jsonArray[0][7])

    subtotalInvoice.innerHTML = "<strong> Subtotal: " + Number((subtotalVar).toFixed(2)) + "</strong>";
    valueAddedTaxInvoice.innerHTML = "12% VAT: " + Number((valueAddedTaxVar).toFixed(2));
    totalTruckingChargesInvoice.innerHTML = "<strong> Total Trucking Charges: " + Number((totalTruckingChargesVar).toFixed(2)) + "</strong>";
  });
}

//BILLED SHIPMENT MODAL

function billedShipmentAjax(billedShipmentData) {
  var billedShipmentDatatable = $('#billedShipmentTable').DataTable({
    "ajax": {
      "url": "classes/load-billed-shipment.class.php?billedShipmentData=" + billedShipmentData,
      "dataSrc": ""
    },
    "columns": [
      { "data": "shipmentNumber", "width": "10%" },
      { "data": "vehiclePlateNumber", "width": "10%" },
      { "data": "dateOfDelivery", "width": "10%" },
      { "data": "areaRate", "width": "10%" }
    ]
  });

}

//DELETE AJAX
let submitDeleteForm = document.getElementById('submitDeleteForm');

function deleteInvoiceAjax() {
  $.post("./classes/delete-invoice-controller.class.php", {
    billingInvoiceNumberDelete: deleteVar
  }, function (data) {
    refreshTable();
  });
  refreshTable();
}

submitDeleteForm.addEventListener('click', (e) => {
  deleteInvoiceAjax();
  refreshTable();
  deleteModal.classList.remove('is-active');
  refreshTable();
})

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button

let billingStatusEdit = document.getElementById('billingStatusEdit');

let billingStatusEditHelp = document.getElementById('billingStatusEditHelp');

function editInvoiceAjax() {
  $.post("./classes/edit-invoice-controller.class.php", {
    billingInvoiceNumberEdit: editVar,
    billingStatusEdit: billingStatusEdit.value
  }, function (data) {

    $("#submitEditFormHelp").html(data);
    $("#submitEditFormHelp").attr('class', 'help is-success');
    /*
    clearEditFormHelp();
    clearEditFormInput();
    */
    refreshTable();
  });
  refreshTable();
}

submitEditForm.addEventListener('click', (e) => {
  /*
      clearEditFormHelp();
  
      let shipmentStatusEditMessages = []
  
      //Shipment Status Validation
      if (shipmentStatusEdit.value === "" || shipmentStatusEdit.value == null) {
      shipmentStatusEdit.className = "input is-danger is-rounded"
      shipmentStatusEditHelp.className = "help is-danger"
      shipmentStatusEditMessages.push('Shipment status is required!')
      }
  
      //Messages
      if (shipmentStatusEditMessages.length > 0) {
      e.preventDefault()
      shipmentStatusEditHelp.innerText = shipmentStatusEditMessages.join(', ')
      }
      if(
          shipmentStatusEditMessages.length <= 0
          ){
              editInvoiceAjax();
          }
      //shipmentDatatable.ajax.reload();
    */
  editInvoiceAjax();
  refreshTable();
})


function clearEditFormHelp() {
  //RESETTING FORM ELEMENTS
  billingStatusEdit.className = "select is-rounded"
  submitEditFormHelp.className = "help"
  submitEditFormHelp.innerText = ""
}