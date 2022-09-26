let returnBtn = document.getElementById('returnBtn');
let clientAdd = document.getElementById('clientAdd');
let shipmentTable = document.getElementById('shipmentTable');

let submitAddForm = document.getElementById('submitAddForm');
let submitAddFormHelp = document.getElementById('submitAddFormHelp');
let invoiceNumberAdd = document.getElementById('invoiceNumberAdd');
let invoiceDateAdd = document.getElementById('invoiceDateAdd');

function getClientShipment() {
    $.post("./classes/load-client-shipment-unbilled.class.php", {
        clientAdd: clientAdd.value
    }, function (data) {
        var jsonArray = JSON.parse(data);
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            //TR
            var newTr = document.createElement("tr");

            //TD
            var newTd = document.createElement("td");
            newTd.setAttribute("style", "text-align: left;");
            newTd.innerHTML = "<input type='checkbox' value=" + jsonArray[i][0] + " name='shipmentSelectRow1' class='mr-3 mt-4 mb-4'> Shipment #" + jsonArray[i][1] + " - Delivery Date: " + jsonArray[i][2];
            newTr.appendChild(newTd);

            //FINAL APPEND
            shipmentTable.appendChild(newTr);
        };
    });
}

function populateSelect1() {
    $.post("./classes/load-client-all.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            clientAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        getClientShipment();
        //closeSelect();
    });
}

function generateAjax() {
    var shipmentNumberArray = [];
    var shipmentNumberCheckbox = document.getElementsByName("shipmentSelectRow1");

    for (var i = 0; i < shipmentNumberCheckbox.length; i++) {
        if (shipmentNumberCheckbox[i].checked == true) {
            shipmentNumberArray.push(shipmentNumberCheckbox[i].value);
        }
    }

    $.post("./classes/generate-invoice-controller.class.php", {
        invoiceNumberAdd: invoiceNumberAdd.value,
        clientAdd: clientAdd.value,
        invoiceDateAdd: invoiceDateAdd.value,
        shipmentNumberArray: JSON.stringify(shipmentNumberArray)
    }, function (data) {
        /*
        $("#submitAddFormHelp").html("Successfully added a record!");
        $("#submitAddFormHelp").attr('class', 'help is-success');
        
        clearAddFormHelp();
        clearAddFormInput();
        */
        addBillingLog("Added", "Invoice #" + invoiceNumberAdd.value);
        window.location.href = "billing.php";
    });
    //shipmentDatatable.ajax.reload();
}

function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-billing-log-controller.class.php", {
        logDescription: logDescriptionVar,
        billingDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

submitAddForm.addEventListener('click', (e) => {
    generateAjax();
});

clientAdd.addEventListener('change', () => {
    shipmentTable.innerHTML = "";
    getClientShipment();
    //alert(clientAdd.value);
});

returnBtn.addEventListener('click', () => {
    window.location.href = "billing.php";
});

populateSelect1();