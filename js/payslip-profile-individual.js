let returnBtn = document.getElementById('returnBtn');

let updateBtn = document.getElementById('updateBtn');
let downloadBtn = document.getElementById('downloadBtn');
let billingIdHidden = document.getElementById('billingIdHidden');
let ownerIdHidden = document.getElementById('ownerIdHidden');
let payrollIdHidden = document.getElementById('payrollIdHidden');
let statusHeader = document.getElementById('statusHeader');
let payrollStatusHidden = document.getElementById('payrollStatusHidden');
let invoiceNumberHidden = document.getElementById('invoiceNumberHidden');
let plateNumberHidden = document.getElementById('plateNumberHidden');
const arrayLengthHidden = document.getElementById('arrayLengthHidden')


const ancestorTile = document.getElementById('ancestorTile');

const test_indicator = document.getElementById('test_indicator');



const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')
let lessTDHeader = document.getElementById('lessTDHeader');

let invoiceNumberHeader = document.getElementById('invoiceNumberHeader');
let plateNumberHeader = document.getElementById('plateNumberHeader');
let ownerHeader = document.getElementById('ownerHeader');
let dateHeader = document.getElementById('dateHeader');

let truckRateTD = document.getElementById('truckRateTD');
let dropOffTD = document.getElementById('dropOffTD');
let penaltyTD = document.getElementById('penaltyTD');
let totalTD = document.getElementById('totalTD');
let taxTD = document.getElementById('taxTD');
let lessTD = document.getElementById('lessTD');
let netPayTD = document.getElementById('netPayTD');
let remarksParagraph = document.getElementById('remarksParagraph');
let currentPageNumber = 1;

/*
function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-billing-log-controller.class.php", {
        logDescription: logDescriptionVar,
        billingDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
    });
}
*/

function generatePayslipFees(payrollIdVar) {
    $.post("./classes/load-payslip-profile-fees.class.php", {
        payrollId: payrollIdVar
    }, function (data) {

        var jsonArray = JSON.parse(data);
        invoiceNumberHeader.innerHTML = 'Invoice Number: ' + jsonArray[0][0];
        plateNumberHeader.innerHTML = 'Plate Number: ' + jsonArray[0][1];
        ownerHeader.innerHTML = 'Vehicle Owner: ' + jsonArray[0][2] + ' ' + jsonArray[0][3] + ' ' + jsonArray[0][4];
        dateHeader.innerHTML = 'Date: ' + jsonArray[0][5];

        truckRateTD.innerHTML = jsonArray[0][6];
        dropOffTD.innerHTML = jsonArray[0][7];
        penaltyTD.innerHTML = jsonArray[0][8];
        totalTD.innerHTML = parseFloat(jsonArray[0][6]) + parseFloat(jsonArray[0][7]) - parseFloat(jsonArray[0][8]);
        taxTD.innerHTML = (parseFloat(jsonArray[0][6]) + parseFloat(jsonArray[0][7]) - parseFloat(jsonArray[0][8])) * 0.01;

        lessTDHeader.innerHTML = 'LESS ' + jsonArray[0][9] + '%';

        lessTD.innerHTML = (parseFloat(jsonArray[0][6]) + parseFloat(jsonArray[0][7]) - parseFloat(jsonArray[0][8])) * (parseFloat(jsonArray[0][9]) / 100);
        netPayTD.innerHTML = parseFloat(totalTD.innerHTML) - (parseFloat(taxTD.innerHTML) + parseFloat(lessTD.innerHTML));

    });
}

function generatePayslip1(payrollIdVar) {
    $.post("./classes/load-payslip-profile.class.php", {
        payrollId: payrollIdVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 5); //1 is the number of results per page

        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}

function generatePayslip2(currentPageNumberVar, payrollIdVar) {
    $.post("./classes/load-payslip-profile-pagination.class.php", {
        currentPageNumber: currentPageNumberVar,
        payrollId: payrollIdVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        tableTbody.innerHTML = "";
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            //GENERATE SHIPMENT DETAILS HERE

            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");
            var newTableData2 = document.createElement("td");
            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");
            var newTableData5 = document.createElement("td");
            var newTableData6 = document.createElement("td");
            var newTableData7 = document.createElement("td");

            newTableData1.setAttribute("data-label", "Date");
            newTableData2.setAttribute("data-label", "Shipment Number");
            newTableData3.setAttribute("data-label", "Destination");
            newTableData4.setAttribute("data-label", "Area");
            newTableData5.setAttribute("data-label", "Rate");
            newTableData6.setAttribute("data-label", "Drop Off");
            newTableData7.setAttribute("data-label", "Penalty");

            newTableData1.innerHTML = jsonArray[i][0];
            newTableData2.innerHTML = jsonArray[i][1];
            newTableData3.innerHTML = jsonArray[i][2];
            newTableData4.innerHTML = jsonArray[i][3];
            newTableData5.innerHTML = jsonArray[i][4];
            newTableData6.innerHTML = jsonArray[i][5];
            newTableData7.innerHTML = jsonArray[i][6];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);
            newTableRow.appendChild(newTableData5);
            newTableRow.appendChild(newTableData6);
            newTableRow.appendChild(newTableData7);


        }

    });
}

generatePayslip1(payrollIdHidden.innerHTML);
generatePayslip2(1, payrollIdHidden.innerHTML);
generatePayslipFees(payrollIdHidden.innerHTML);

//generateShipmentListTable2(1);
//populateTable();

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

returnBtn.addEventListener('click', () => {
    window.location.href = "payroll-individual.php";
});

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generatePayslip2(paginationIndicatorBtn.innerHTML, payrollIdHidden.innerHTML);
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
        generatePayslip2(paginationIndicatorBtn.innerHTML, payrollIdHidden.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});
