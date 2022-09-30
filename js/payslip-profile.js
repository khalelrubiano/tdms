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
/*
function generatePayslip3(billingIdVar, ownerIdVar, plateNumberVar) {
    $.post("./classes/load-payslip-profile.class.php", {
        billingId: billingIdVar,
        ownerId: ownerIdVar,
        plateNumber: plateNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        plateNumberHeader.innerHTML = jsonArray[0][8];
        ownerHeader.innerHTML = jsonArray[0][9] + " " + jsonArray[0][10] + " " + jsonArray[0][11];
        dateHeader.innerHTML = jsonArray[0][15];

        let temp_array1 = [];
        let temp_array2 = [];
        let temp_array3 = [];
        
                var newParentTile = document.createElement("div");
                newParentTile.classList.add('tile');
                newParentTile.classList.add('is-parent');
                newParentTile.classList.add('is-vertical');
                newParentTile.setAttribute("style", "align-items: center;");
                ancestorTile.appendChild(newParentTile);
        
        //load billing into array 1
        for (var i = 0; i < jsonArray.length; i++) {

            if (temp_array1.includes(jsonArray[i][0]) == false) {

                temp_array1.push(jsonArray[i][0]);

            }

        };

        for (var i2 = 0; i2 < temp_array1.length; i2++) {

            //load plate number into array 2
            for (var i3 = 0; i3 < jsonArray.length; i3++) {

                if (jsonArray[i3][0] == temp_array1[i2]) {

                    if (temp_array2.includes(jsonArray[i3][8]) == false) {

                        temp_array2.push(jsonArray[i3][8]);

                    }

                }
            }

            //LOOP THROUGH ARRAY 2 AND GENERATE PAYSLIP FOR EACH VEHICLE
            for (var i4 = 0; i4 < temp_array2.length; i4++) {

                //GENERATE PLATE NUMBER HERE

                for (var i5 = 0; i5 < jsonArray.length; i5++) {

                    if (jsonArray[i5][8] == temp_array2[i4]) {

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

                        newTableData1.innerHTML = jsonArray[i5][15];
                        newTableData2.innerHTML = jsonArray[i5][3];
                        newTableData3.innerHTML = jsonArray[i5][4];
                        newTableData4.innerHTML = jsonArray[i5][5];
                        newTableData5.innerHTML = jsonArray[i5][6];
                        newTableData6.innerHTML = jsonArray[i5][5];
                        newTableData7.innerHTML = jsonArray[i5][6];

                        newTableRow.appendChild(newTableData1);
                        newTableRow.appendChild(newTableData2);
                        newTableRow.appendChild(newTableData3);
                        newTableRow.appendChild(newTableData4);
                        newTableRow.appendChild(newTableData5);
                        newTableRow.appendChild(newTableData6);
                        newTableRow.appendChild(newTableData7);
                        
                                                truckRateTD.innerHTML = parseFloat(jsonArray[i5][6]) + parseFloat(truckRateTD.innerHTML);
                                                subtotalTD.innerHTML = truckRateTD.innerHTML;
                                                whtTD.innerHTML = parseFloat(subtotalTD.innerHTML) * 0.01;
                                                commissionTD.innerHTML = parseFloat(subtotalTD.innerHTML) * (parseFloat(jsonArray[i5][17]) / 100);
                                                netpayTD.innerHTML = parseFloat(subtotalTD.innerHTML) - parseFloat(whtTD.innerHTML) - parseFloat(commissionTD.innerHTML);
                        

                    };

                }
                
                var newHeader2 = document.createElement("h1");
                newHeader2.innerHTML = "--------------------------------------------------------";
                sampleContainer.appendChild(newHeader2);
            }

        }

    });
}
*/
function updatePayslipStatus() {
    if (confirm("Mark this payslip as settled?")) {
        $.post("./classes/edit-payslip-status-controller.class.php", {
            payrollId: payrollIdHidden.innerHTML
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            addPayrollLog("Updated", invoiceNumberHeader.innerHTML + " - " + plateNumberHeader.innerHTML);
            window.location.href = "payroll.php";
        });
    }
}

function addPayrollLog(logDescriptionVar, payrollDescriptionVar) {
    $.post("./classes/add-payroll-log-controller.class.php", {
        logDescription: logDescriptionVar,
        payrollDescription: payrollDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

function redirectToPDF() {
    $.post("./classes/set-payslip-session-variable2.class.php", {
        payrollId: payrollIdHidden.innerHTML
    }, function (data) {
        //alert(data);
        window.location.href = "payslip-pdf.php";
    });
}

function openEdit() {
    editModal.classList.add('is-active');
    /*
    editHeader.innerHTML = "Edit " + nameVar;
    editHeader2.innerHTML = idVar;
    //populateUsernameAdd();
    */
}

function closeEdit() {
    
    clearEditFormHelp();
    clearEditFormInput();

    submitEditFormHelp.className = "help"
    submitEditFormHelp.innerText = ""

    editModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let dropOffEdit = document.getElementById('dropOffEdit')
let dropOffEditHelp = document.getElementById('dropOffEditHelp')

let penaltyEdit = document.getElementById('penaltyEdit')
let penaltyEditHelp = document.getElementById('penaltyEditHelp')

let remarksEdit = document.getElementById('remarksEdit')
let remarksEditHelp = document.getElementById('remarksEditHelp')


function editAjax() {
    $.post("./classes/edit-payslip-controller.class.php", {
        dropOffEdit: dropOffEdit.value,
        penaltyEdit: penaltyEdit.value,
        remarksEdit: remarksEdit.value,
        payrollId: payrollIdHidden.innerHTML
    }, function (data) {
        $("#submitEditFormHelp").html(data);
        //$("#submitEditFormHelp").attr('class', 'help is-success');
        //clearEditFormHelp();
        //clearEditFormInput();
        //editModal.classList.remove('is-active');
        closeEdit();
        //refreshList();
        addPayrollLog("Updated", invoiceNumberHeader.innerHTML + " - " + plateNumberHeader.innerHTML);
        window.location.href = "payroll.php";
    });
}

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();
    //clearEditFormInput();
    editAjax();

})

function clearEditFormHelp() {
    //RESETTING FORM ELEMENTS
    dropOffEdit.className = "input is-rounded"
    dropOffEditHelp.className = "help"
    dropOffEditHelp.innerText = ""

    penaltyEdit.className = "input is-rounded"
    penaltyEditHelp.className = "help"
    penaltyEditHelp.innerText = ""

    remarksEdit.className = "input is-rounded"
    remarksEditHelp.className = "help"
    remarksEditHelp.innerText = ""
}

function clearEditFormInput() {
    dropOffEdit.value = null;
    penaltyEdit.value = null;
    remarksEdit.value = null;
}

generatePayslip1(payrollIdHidden.innerHTML);
generatePayslip2(1, payrollIdHidden.innerHTML);
generatePayslipFees(payrollIdHidden.innerHTML);

//generateShipmentListTable2(1);
//populateTable();

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

returnBtn.addEventListener('click', () => {
    window.location.href = "payroll.php";
});

downloadBtn.addEventListener('click', () => {
    redirectToPDF();
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
