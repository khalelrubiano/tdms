
/*
let returnBtn = document.getElementById('returnBtn');
let listBtn = document.getElementById('listBtn');
let updateBtn = document.getElementById('updateBtn');
//let billingIdHidden = document.getElementById('billingIdHidden');
let invoiceTitle = document.getElementById('invoiceTitle');
let statusHeader = document.getElementById('statusHeader');
let billingStatusHidden = document.getElementById('billingStatusHidden');
let invoiceNumberHidden = document.getElementById('invoiceNumberHidden');

let listModal = document.getElementById('listModal');


//MODALS

function openList() {
    listModal.classList.add('is-active');
    //populateUsernameAdd();
}

function closeList() {
    
        clearAddFormHelp();
        clearAddFormInput();
    
        submitAddFormHelp.className = "help"
        submitAddFormHelp.innerText = ""
    
    listModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

if (billingStatusHidden.innerHTML == "Settled") {
    statusHeader.classList.add("has-text-primary");
};

if (billingStatusHidden.innerHTML == "Unsettled") {
    statusHeader.classList.add("has-text-warning");
};




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
            newTableData4.setAttribute("data-label", "Delivery Date");

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
        
                for (var i = 0; i < jsonArray.length; i++) {
                    var newOption = document.createElement("option");
                    newOption.value = jsonArray[i][0];
                    newOption.innerHTML = jsonArray[i][1];
                    areaRateAdd.options.add(newOption);
                    //helperAdd.options.add(newOption);
                }
        
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

//populateTable();

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
*/

//COMPANY
let companyLogo = document.getElementById('companyLogo');
let companyNameTD = document.getElementById('companyNameTD');
let companyAddressTD = document.getElementById('companyAddressTD');
let companyTinTD = document.getElementById('companyTinTD');
let companyEmailTD = document.getElementById('companyEmailTD');
let companyNumberTD = document.getElementById('companyNumberTD');

//BILLING + CLIENT
let invoiceNumberTD = document.getElementById('invoiceNumberTD');
let coveredDateTD = document.getElementById('coveredDateTD');
let invoiceDateTD = document.getElementById('invoiceDateTD');
let clientTD = document.getElementById('clientTD');
let clientTinTD = document.getElementById('clientTinTD');
let clientAddressTD = document.getElementById('clientAddressTD');
let truckCostTD = document.getElementById('truckCostTD');
let dropFeeTD = document.getElementById('dropFeeTD');
let parkingFeeTD = document.getElementById('parkingFeeTD');
let tollFeeTD = document.getElementById('tollFeeTD');
let fuelChargeTD = document.getElementById('fuelChargeTD');
let extraHelperTD = document.getElementById('extraHelperTD');
let demurrageTD = document.getElementById('demurrageTD');
let miscFeeTD = document.getElementById('miscFeeTD');
let subtotalTD = document.getElementById('subtotalTD');
let vatTD = document.getElementById('vatTD');
let penaltyTD = document.getElementById('penaltyTD');
let totalTD = document.getElementById('totalTD');

let billingIdHidden = document.getElementById('billingIdHidden');
let invoiceNumberHidden = document.getElementById('invoiceNumberHidden');
let clientHidden = document.getElementById('clientHidden');
let invoiceStatusHidden = document.getElementById('invoiceStatusHidden');
let downloadBtn = document.getElementById('downloadBtn');
let companyLogoHidden = document.getElementById('companyLogoHidden');

let returnBtn = document.getElementById('returnBtn');
let updateBtn = document.getElementById('updateBtn');

const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')

let currentPageNumber = 1;

function populateTable1() {
    $.post("./classes/load-billed-shipment-all.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert("Truck Rate: " + jsonArray[0][0]);


        /*
        let var1 = parseFloat(jsonArray[0][0]);
        let var2 = parseFloat(truckRateTD.innerHTML) + parseFloat(dropFeeTD.innerHTML) + parseFloat(parkingFeeTD.innerHTML) + parseFloat(demurrageTD.innerHTML) + parseFloat(otherChargesTD.innerHTML);
        let var3 = parseFloat(subtotalTD.innerHTML) * 0.12;
        let var4 = parseFloat(subtotalTD.innerHTML) + parseFloat(taxTD.innerHTML) + parseFloat(penaltyTD.innerHTML);

        truckRateTD.innerHTML = parseFloat(jsonArray[0][0]);
        subtotalTD.innerHTML = parseFloat(truckRateTD.innerHTML) + parseFloat(dropFeeTD.innerHTML) + parseFloat(parkingFeeTD.innerHTML) + parseFloat(demurrageTD.innerHTML) + parseFloat(otherChargesTD.innerHTML);
        taxTD.innerHTML = parseFloat(subtotalTD.innerHTML) * 0.12;
        totalTD.innerHTML = parseFloat(subtotalTD.innerHTML) + parseFloat(taxTD.innerHTML) + parseFloat(penaltyTD.innerHTML);
        
                for (var i = 0; i < jsonArray.length; i++) {
                    var newOption = document.createElement("option");
                    newOption.value = jsonArray[i][0];
                    newOption.innerHTML = jsonArray[i][1];
                    areaRateAdd.options.add(newOption);
                    //helperAdd.options.add(newOption);
                }
        
        //closeSelect();
        */

        invoiceNumberTD.innerHTML = "<strong>BILLING INVOICE: </strong>" + jsonArray[0][1];
        invoiceNumberHidden.innerHTML = jsonArray[0][1];
        clientHidden.innerHTML = jsonArray[0][19];
        coveredDateTD.innerHTML = "<strong>COVERED DATE: </strong>" + jsonArray[0][3];
        invoiceDateTD.innerHTML = "<strong>INVOICE DATE: </strong>" + jsonArray[0][2];
        clientTD.innerHTML = "<strong>" + jsonArray[0][19] + "</strong>";
        clientTinTD.innerHTML = "TIN #: " + jsonArray[0][20];
        clientAddressTD.innerHTML = jsonArray[0][21];
        truckCostTD.innerHTML = parseFloat(jsonArray[0][7]);
        dropFeeTD.innerHTML = parseFloat(jsonArray[0][8]);
        parkingFeeTD.innerHTML = parseFloat(jsonArray[0][9]);
        tollFeeTD.innerHTML = parseFloat(jsonArray[0][10]);
        fuelChargeTD.innerHTML = parseFloat(jsonArray[0][11]);
        extraHelperTD.innerHTML = parseFloat(jsonArray[0][12]);
        demurrageTD.innerHTML = parseFloat(jsonArray[0][13]);
        miscFeeTD.innerHTML = parseFloat(jsonArray[0][14]);
        subtotalTD.innerHTML = parseFloat(jsonArray[0][7]) + parseFloat(jsonArray[0][8]) + parseFloat(jsonArray[0][9]) + parseFloat(jsonArray[0][10]) + parseFloat(jsonArray[0][11]) + parseFloat(jsonArray[0][12]) + parseFloat(jsonArray[0][13]) + parseFloat(jsonArray[0][14]);
        vatTD.innerHTML = parseFloat(subtotalTD.innerHTML) * 0.12;
        penaltyTD.innerHTML = parseFloat(jsonArray[0][15]);
        totalTD.innerHTML = parseFloat(subtotalTD.innerHTML) + parseFloat(vatTD.innerHTML) - parseFloat(penaltyTD.innerHTML);

    });
}

function populateTable2() {
    $.post("./classes/load-company-info.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {

        var jsonArray = JSON.parse(data);
        companyLogo.setAttribute('src', 'uploads/' + jsonArray[0][11]);
        companyLogoHidden.innerHTML = 'uploads/' + jsonArray[0][11];
        companyNameTD.innerHTML = "<strong>" + jsonArray[0][1] + "</strong>";
        companyAddressTD.innerHTML = "<strong>ADDRESS: </strong>" + jsonArray[0][5] + " " + jsonArray[0][9] + " " + jsonArray[0][8] + " " + jsonArray[0][7] + " " + jsonArray[0][6];
        companyTinTD.innerHTML = "<strong>VAT Reg. TIN: </strong>" + jsonArray[0][2];
        companyEmailTD.innerHTML = "<strong>EMAIL ADD: </strong>" + jsonArray[0][3];
        companyNumberTD.innerHTML = "<strong> CONTACT Nos.: </strong>" + jsonArray[0][4]; //11 SRC

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
        //alert(arrayLengthHidden.innerHTML);
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
            newTableData4.setAttribute("data-label", "Delivery Date");

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

function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-billing-log-controller.class.php", {
        logDescription: logDescriptionVar,
        billingDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
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

function dateValidator() {
    $.post("./classes/load-invoice-date.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {
        let currentDate = new Date();
        let cDay = ("0" + currentDate.getDate()).slice(-2);
        let cMonth = ("0" + (currentDate.getMonth() + 1)).slice(-2);
        let cYear = currentDate.getFullYear();
        let finalDate = cYear + "-" + cMonth + "-" + cDay;
        var jsonArray = JSON.parse(data);


        //alert("<b>" + cYear + "/" + cMonth + "/" + cDay + "</b>");
        if (finalDate > jsonArray[0][0] || finalDate == jsonArray[0][0]) {
            updateBillingStatus();
        } else {
            alert('This invoice cannot be marked settled before the invoice date!');
        }
    });


}

generateShipmentListTable1();
generateShipmentListTable2(1);

populateTable1();
populateTable2();

function redirectToPDF() {
    $.post("./classes/set-billing-session-variable2.class.php", {
        companyNameTD: companyNameTD.innerHTML,
        companyAddressTD: companyAddressTD.innerHTML,
        companyTinTD: companyTinTD.innerHTML,
        companyEmailTD: companyEmailTD.innerHTML,
        companyNumberTD: companyNumberTD.innerHTML,
        invoiceNumberTD: invoiceNumberTD.innerHTML,
        coveredDateTD: coveredDateTD.innerHTML,
        invoiceDateTD: invoiceDateTD.innerHTML,
        clientTD: clientTD.innerHTML,
        clientTinTD: clientTinTD.innerHTML,
        clientAddressTD: clientAddressTD.innerHTML,
        truckCostTD: truckCostTD.innerHTML,
        dropFeeTD: dropFeeTD.innerHTML,
        parkingFeeTD: parkingFeeTD.innerHTML,
        tollFeeTD: tollFeeTD.innerHTML,
        fuelChargeTD: fuelChargeTD.innerHTML,
        extraHelperTD: extraHelperTD.innerHTML,
        demurrageTD: demurrageTD.innerHTML,
        miscFeeTD: miscFeeTD.innerHTML,
        subtotalTD: subtotalTD.innerHTML,
        vatTD: vatTD.innerHTML,
        penaltyTD: penaltyTD.innerHTML,
        totalTD: totalTD.innerHTML,
        companyLogoHidden: companyLogoHidden.innerHTML,
        invoiceNumberHidden: invoiceNumberHidden.innerHTML,
        clientHidden: clientHidden.innerHTML
    }, function (data) {
        //alert(data);
        window.location.href = "invoice-pdf.php";
    });
}


returnBtn.addEventListener('click', () => {
    window.location.href = "billing.php";
});

downloadBtn.addEventListener('click', () => {
    redirectToPDF();
    //alert(invoiceNumberHidden.innerHTML + ' ' + clientHidden.innerHTML);
});

/*
var var1 = 'SAMPLE';

var samplehtml = '<html><head><style>.parentDiv {display: flex;justify-content: center;} .parentDiv2 {display: flex;} .parentDiv3 {display: flex;justify-content: space-around;} img {height: 75px;margin-right: 50px;} h1 {font-size: 12px;} .companyh1 {font-size: 12px;} table {width: 100%;table-layout: fixed;} table,th,td {border: 1px solid black;border-collapse: collapse;} td {text-align: center;padding-top: 5px;padding-bottom: 5px;} </style></head>'
    + '<body><div id="pdfbody">'
    + '<h1 style="text-align: center; font-size: 20px;">' + var1 + '</h1>'
    + '<div class="parentDiv" style="border-bottom: 1px solid black; margin-bottom: 10px;"><div class="childDiv">'
    + '<img src="' + var1 + '"></div><div class="childDiv">'
    + '<h1 class="companyh1">' + var1 + '</h1>'
    + '<h1 class="companyh1">' + var1 + '</h1>'
    + '<h1 class="companyh1">' + var1 + '</h1>'
    + '<h1 class="companyh1">' + var1 + '</h1></div></div>'
    + '<div class="parentDiv2" style="margin-bottom: 30px;">'
    + '<div class="childDiv">'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '</div>'
    + '</div>'
    + '<div class="parentDiv2" style="margin-bottom: 30px;">'
    + '<div class="childDiv">'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '<h1>' + var1 + '</h1>'
    + '</div>'
    + '</div>'
    + '<div style="margin-bottom: 30px;">'
    + '<h1>This is to bill you for trucking service:</h1>'
    + '<table>'
    + '<tbody>'
    + '<tr>'
    + '<td class="table1TD">TRUCK COST:</td>'
    + '<td class="table1TD" id="truckCostTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">DROP FEE:</th>'
    + '<td class="table1TD" id="dropFeeTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">PARKING FEE:</td>'
    + '<td class="table1TD" id="parkingFeeTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">TOLL FEE:</td>'
    + '<td class="table1TD" id="tollFeeTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">FUEL CHARGE:</td>'
    + '<td class="table1TD" id="fuelChargeTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">EXTRA HELPER:</td>'
    + '<td class="table1TD" id="extraHelperTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">DEMURRAGE:</td>'
    + '<td class="table1TD" id="demurrageTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">OTHER MISC FEE:</td>'
    + '<td class="table1TD" id="miscFeeTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">SUBTOTAL:</td>'
    + '<td class="table1TD" id="subtotalTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">12% VAT:</td>'
    + '<td class="table1TD" id="vatTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">LESS PENALTIES:</td>'
    + '<td class="table1TD" id="penaltyTD">' + var1 + '</td>'
    + '</tr>'
    + '<tr>'
    + '<td class="table1TD">TOTAL TRUCKING CHARGES:</td>'
    + '<td class="table1TD" id="totalTD">' + var1 + '</td>'
    + '</tr>'
    + '</tbody>'
    + '</table>'
    + '<h1>TERMS: Balance due in 30 days.</h1>'
    + '</div>'
    + '<div class="parentDiv3">'
    + '<div class="childDiv" style="margin-right: 100px;">'
    + '<h1>Received by:_______________</h1>'
    + '</div>'
    + '<div class="childDiv">'
    + '<h1 style="margin-bottom: 50px;">________________________________________</h1>'
    + '<h1 style="text-align: center;">LOGISTIC MANAGER</h1>'
    + '</div>'
    + '</div>'
    + '</div>'
    + '</body>'
    + '</html>'

var opt = {
    
    filename: 'invoice.pdf',
    image: {
        type: 'jpeg',
        quality: 1
    },
    html2canvas: {
        scale: 1
    },
    jsPDF: {
        unit: 'in',
        format: 'letter',
        orientation: 'portrait'
    }
};

html2pdf(samplehtml, opt);*/