//GENERATING DATATABLE
var logDatatable = $('#logTable').DataTable({
  "ajax": {
    "url": "classes/load-log.class.php",
    "dataSrc": ""
  },
  "columns": [
    { "data": "log_description", "width": "10%" },
    { "data": "created_at", "width": "10%" }
  ]
});


function refreshTable() {
  logDatatable.ajax.reload();
}

function returnTo() {
  //logModal.classList.add('is-active');
  //populateSelect1();
  //populateUsernameAdd();
  window.history.back();
}

/*
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

}*/