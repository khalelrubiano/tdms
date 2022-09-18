let returnBtn = document.getElementById('returnBtn');
let listBtn = document.getElementById('listBtn');
let updateBtn = document.getElementById('updateBtn');
let billingIdHidden = document.getElementById('billingIdHidden');
let invoiceTitle = document.getElementById('invoiceTitle');
let statusHeader = document.getElementById('statusHeader');
let billingStatusHidden = document.getElementById('billingStatusHidden');
let invoiceNumberHidden = document.getElementById('invoiceNumberHidden');
let truckRateTD = document.getElementById('truckRateTD');
let dropFeeTD = document.getElementById('dropFeeTD');
let parkingFeeTD = document.getElementById('parkingFeeTD');
let demurrageTD = document.getElementById('demurrageTD');
let otherChargesTD = document.getElementById('otherChargesTD');
let subtotalTD = document.getElementById('subtotalTD');
let taxTD = document.getElementById('taxTD');
let penaltyTD = document.getElementById('penaltyTD');
let totalTD = document.getElementById('totalTD');

let listModal = document.getElementById('listModal');

const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')

//MODALS

function openList() {
    listModal.classList.add('is-active');
    //populateUsernameAdd();
}

function closeList() {
    /*
        clearAddFormHelp();
        clearAddFormInput();
    
        submitAddFormHelp.className = "help"
        submitAddFormHelp.innerText = ""
    */
    listModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}
/*
if (billingStatusHidden.innerHTML == "Settled") {
    statusHeader.classList.add("has-text-primary");
};

if (billingStatusHidden.innerHTML == "Unsettled") {
    statusHeader.classList.add("has-text-warning");
};
*/

function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-billing-log-controller.class.php", {
        logDescription: logDescriptionVar,
        billingDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

function generateShipmentListTable1() {
    $.post("./classes/load-billed-shipment.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {

        var jsonArray = JSON.parse(data);

        //alert(jsonArray[0][0] + "success");


        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 5); //1 is the number of results per page

        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}

function generateShipmentListTable2(currentPageNumberVar) {
    $.post("./classes/load-billed-shipment-pagination.class.php", {
        billingId: billingIdHidden.innerHTML,
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        tableTbody.innerHTML = "";


        for (var i = 0; i < jsonArray.length; i++) {
            //console.log(jsonArray[i][1]);

            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");

            var newTableData2 = document.createElement("td");

            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");

            newTableData1.setAttribute("data-label", "Shipment Number");

            newTableData2.setAttribute("data-label", "Area Rate");

            newTableData3.setAttribute("data-label", "Vehicle Plate Number");
            newTableData4.setAttribute("data-label", "Date Completed");

            newTableData1.innerHTML = jsonArray[i][1];
            newTableData2.innerHTML = jsonArray[i][0];
            newTableData3.innerHTML = jsonArray[i][2];
            newTableData4.innerHTML = jsonArray[i][3];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);


        }
    });
}

function populateTable() {
    $.post("./classes/load-billed-shipment-all.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert("Truck Rate: " + jsonArray[0][0]);

        let var1 = parseFloat(jsonArray[0][0]);
        let var2 = parseFloat(truckRateTD.innerHTML) + parseFloat(dropFeeTD.innerHTML) + parseFloat(parkingFeeTD.innerHTML) + parseFloat(demurrageTD.innerHTML) + parseFloat(otherChargesTD.innerHTML);
        let var3 = parseFloat(subtotalTD.innerHTML) * 0.12;
        let var4 = parseFloat(subtotalTD.innerHTML) + parseFloat(taxTD.innerHTML) + parseFloat(penaltyTD.innerHTML);

        truckRateTD.innerHTML = parseFloat(jsonArray[0][0]);
        subtotalTD.innerHTML = parseFloat(truckRateTD.innerHTML) + parseFloat(dropFeeTD.innerHTML) + parseFloat(parkingFeeTD.innerHTML) + parseFloat(demurrageTD.innerHTML) + parseFloat(otherChargesTD.innerHTML);
        taxTD.innerHTML = parseFloat(subtotalTD.innerHTML) * 0.12;
        totalTD.innerHTML = parseFloat(subtotalTD.innerHTML) + parseFloat(taxTD.innerHTML) + parseFloat(penaltyTD.innerHTML);
        /*
                for (var i = 0; i < jsonArray.length; i++) {
                    var newOption = document.createElement("option");
                    newOption.value = jsonArray[i][0];
                    newOption.innerHTML = jsonArray[i][1];
                    areaRateAdd.options.add(newOption);
                    //helperAdd.options.add(newOption);
                }
        */
        //closeSelect();
    });
}

function updateBillingStatus() {
    if (confirm("Mark this invoice as settled?")) {
        $.post("./classes/edit-billing-status-controller.class.php", {
            billingId: billingIdHidden.innerHTML
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            addBillingLog("Updated", "Invoice #" + invoiceNumberHidden.innerHTML);
            window.location.href = "billing.php";
        });
    }
}


generateShipmentListTable1();
generateShipmentListTable2(1);
populateTable();

let currentPageNumber = 1;

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != 1) {
        paginationPreviousBtn.classList.remove("is-disabled");
    }

});

paginationPreviousBtn.addEventListener('click', () => {

    if (currentPageNumber > 1) {
        currentPageNumber = currentPageNumber - 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});

returnBtn.addEventListener('click', () => {
    window.location.href = "billing.php";
});
