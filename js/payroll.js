
const editHeader = document.getElementById('editHeader');
const editHeader2 = document.getElementById('editHeader2');

let allTabLink = document.getElementById('allTabLink');
let settledTabLink = document.getElementById('settledTabLink');
let unsettledTabLink = document.getElementById('unsettledTabLink');


let allTabLi = document.getElementById('allTabLi');
let settledTabLi = document.getElementById('settledTabLi');
let unsettledTabLi = document.getElementById('unsettledTabLi');


const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;

let tabValueHidden = document.getElementById('tabValueHidden')

let logList = document.getElementById('logList')

let addModal = document.getElementById('addModal')
let typeAdd = document.getElementById('typeAdd')
let invoiceNumberAdd = document.getElementById('invoiceNumberAdd')
let invoiceNumberAddTemp = '';
let vehicleAdd = document.getElementById('vehicleAdd')
let vehicleAddField = document.getElementById('vehicleAddField')

let pdfModal = document.getElementById('pdfModal')
let invoiceNumberPDF = document.getElementById('invoiceNumberPDF')
let invoiceNumberPDFTemp = '';
let submitPDFForm = document.getElementById('submitPDFForm')

let submitAddForm = document.getElementById('submitAddForm')

function openPDF() {
    pdfModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
}

function closePDF() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/

    pdfModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

function openAdd() {
    addModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
    //alert('add');
}

function closeAdd() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/

    addModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

function openLog() {
    //logModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
    window.location.href = "log.php";
}

function closeLog() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/

    logModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-payslip-controller.class.php", {
            payrollId: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            //addPayrollLog("Deleted", "Invoice #" + deleteVar2);
            //refreshList();
            ancestorTile.innerHTML = '';
            generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
        });
    }
}

function populateSelect1() {
    $.post("./classes/load-invoice-no-payroll.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            invoiceNumberAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        invoiceNumberAddTemp = jsonArray[0][0];

        //getClientShipment();
        //closeSelect();
    });
}

function populateSelect2(billingIdVar) {
    $.post("./classes/load-vehicle-no-payroll.class.php", {
        billingId: billingIdVar
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i];
            newOption.innerHTML = jsonArray[i];
            vehicleAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //getClientShipment();
        //closeSelect();

    });
}

function populateSelect3() {
    $.post("./classes/load-invoice-with-payroll.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            invoiceNumberPDF.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        invoiceNumberPDFTemp = jsonArray[0][0];

        //getClientShipment();
        //closeSelect();
    });
}



function generatePayslipList1(tabValueVar, orderByVar) {
    $.post("./classes/load-payslip.class.php", {
        tabValue: tabValueVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        //alert('data');


        var newParentTile = document.createElement("div");
        newParentTile.classList.add('tile');
        newParentTile.classList.add('is-parent');
        newParentTile.classList.add('is-vertical');
        newParentTile.setAttribute("style", "align-items: center;");
        ancestorTile.appendChild(newParentTile);

        //load billing into array 1
        for (var i = 0; i < jsonArray.length; i++) {

            //GENERATE SHIPMENT DETAILS HERE
            var newChildTile = document.createElement("div");
            newChildTile.classList.add('tile');
            newChildTile.classList.add('is-child');
            newChildTile.classList.add('p-2');
            newChildTile.classList.add('is-6');

            //CARD
            var newCard = document.createElement("div");
            newCard.classList.add('card');
            newChildTile.appendChild(newCard);

            //CARD HEADER

            var newCardHeader = document.createElement("header");
            newCardHeader.classList.add('card-header');
            newCard.setAttribute("style", "border-radius: 5%;");
            newCard.appendChild(newCardHeader);

            //CARD HEADER PARAGRAPH
            var newCardHeaderParagraph = document.createElement("p");
            newCardHeaderParagraph.classList.add('card-header-title');

            var newCardHeaderParagraphIcon = document.createElement("i");
            newCardHeaderParagraphIcon.classList.add('fa-solid');
            newCardHeaderParagraphIcon.classList.add('fa-circle');
            newCardHeaderParagraphIcon.classList.add('mr-3');

            newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);

            switch (jsonArray[i][0]) {
                case "Settled":
                    newCardHeaderParagraph.classList.add('has-text-primary');
                    newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-check mr-3 has-text-primary'></i>" + jsonArray[i][0] + " - " + jsonArray[i][2];
                    newCardHeader.appendChild(newCardHeaderParagraph);
                    break;
                case "Unsettled":
                    newCardHeaderParagraph.classList.add('has-text-warning');
                    newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-exclamation mr-3 has-text-warning'></i>" + jsonArray[i][0];
                    newCardHeader.appendChild(newCardHeaderParagraph);
                    break;

            }

            //CARD CONTENT
            var newCardContent = document.createElement("div");
            newCardContent.classList.add('card-content');
            newCard.appendChild(newCardContent);

            //CARD CONTENT MEDIA
            var newContent = document.createElement("div");
            newContent.classList.add('content');
            newCardContent.appendChild(newContent);


            //CONTENT TABLE
            var newContentTable = document.createElement("table");
            newContentTable.classList.add('table');
            newContentTable.classList.add('is-bordered');
            newContent.appendChild(newContentTable);

            //CONTENT TABLE TBODY
            var newContentTableTbody = document.createElement("tbody");
            newContentTable.appendChild(newContentTableTbody);

            //CONTENT TABLE TBODY TR 1
            var newContentTableTbodyTr1 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr1);

            var newContentTableTbodyTr1Td1 = document.createElement("td");
            newContentTableTbodyTr1Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr1Td1.innerHTML = "Invoice Number:";
            newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

            var newContentTableTbodyTr1Td2 = document.createElement("td");
            newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][3];
            newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

            //CONTENT TABLE TBODY TR 2
            var newContentTableTbodyTr2 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr2);

            var newContentTableTbodyTr2Td1 = document.createElement("td");
            newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr2Td1.innerHTML = "Plate Number:";
            newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

            var newContentTableTbodyTr2Td2 = document.createElement("td");
            newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][1];
            newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

            //CONTENT TABLE TBODY TR 3
            var newContentTableTbodyTr3 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr3);

            var newContentTableTbodyTr3Td1 = document.createElement("td");
            newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr3Td1.innerHTML = "Owner:";
            newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

            var newContentTableTbodyTr3Td2 = document.createElement("td");
            newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][4] + " " + jsonArray[i][5] + " " + jsonArray[i][6];
            newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

            //CONTENT TABLE TBODY TR 4
            var newContentTableTbodyTr4 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr4);

            var newContentTableTbodyTr4Td1 = document.createElement("td");
            newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr4Td1.innerHTML = "Date:";
            newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

            var newContentTableTbodyTr4Td2 = document.createElement("td");
            newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][7];
            newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

            //CARD CONTENT MEDIA-CONTENT SUBTITLE
            var newCardFooter = document.createElement("footer");
            newCardFooter.classList.add('card-footer');
            newCard.appendChild(newCardFooter);

            //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
            var newCardFooterLink = document.createElement("a");
            newCardFooterLink.setAttribute("onclick", "redirectToPayslipProfile('" + jsonArray[i][8] + "','" + jsonArray[i][0] + "')");
            newCardFooterLink.classList.add('card-footer-item');
            newCardFooterLink.innerHTML = "View Details";
            newCardFooter.appendChild(newCardFooterLink);

            var newCardFooterLink2 = document.createElement("a");
            newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + jsonArray[i][8] + "')");
            newCardFooterLink2.classList.add('card-footer-item');
            newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
            newCardFooterLink2.classList.add('has-text-danger');
            newCardFooter.appendChild(newCardFooterLink2);

            //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
            newParentTile.appendChild(newChildTile);

        };

    });
}
//alert(tabValueHidden.innerHTML);
/*
function generatePayslipList2(searchTerm) {
    $.post("./classes/load-payslip.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][1]:
                    console.clear();
                    console.log("Invoice Number" + jsonArray[i][1])
                    indicator.innerHTML = "Invoice Number";
                    generateBillingList4(jsonArray[i][5], jsonArray[i][16], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][19], jsonArray[i][0]);
                    break;
            }

        }

    });

}
*/
generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);

function redirectToPayslipProfile(payrollIdVar, payrollStatusHiddenVar) {
    $.post("./classes/set-payslip-session-variable.class.php", {
        payrollId: payrollIdVar,
        payrollStatusHidden: payrollStatusHiddenVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "payslip-profile.php";
    });
}

function addPayrollLog(logDescriptionVar, payrollDescriptionVar) {
    $.post("./classes/add-log-controller.class.php", {
        logDescription: logDescriptionVar,
        moduleDescription: payrollDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

function generatePayrollLog() {
    $.post("./classes/load-payroll-log.class.php", {
    }, function (data) {
        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newLi = document.createElement("li");
            newLi.innerHTML = jsonArray[i][3] + " - " + jsonArray[i][1] + " " + jsonArray[i][0] + " " + jsonArray[i][2];
            logList.appendChild(newLi);
        }

    });
}

typeAdd.addEventListener('change', () => {
    //shipmentTable.innerHTML = "";
    //getClientShipment();
    //alert('1');

    $("#invoiceNumberAdd option").remove();
    populateSelect1();

    if (typeAdd.value == 'single') {
        $("#vehicleAdd option").remove();
        vehicleAddField.classList.remove('is-hidden');
        populateSelect2(invoiceNumberAddTemp);
    } else {
        vehicleAddField.classList.add('is-hidden');
    }

});

invoiceNumberAdd.addEventListener('change', () => {
    //shipmentTable.innerHTML = "";
    //getClientShipment();
    //alert(clientAdd.value);
    //alert('2');
    $("#vehicleAdd option").remove();

    populateSelect2(invoiceNumberAddTemp);
    //populateSelect1();

});



function generateAjax() {
    $.post("./classes/generate-payroll-controller.class.php", {
        typeAdd: typeAdd.value,
        invoiceNumberAdd: invoiceNumberAdd.value,
        vehicleAdd: vehicleAdd.value
    }, function (data) {
        /*
        $("#submitAddFormHelp").html("Successfully added a record!");
        $("#submitAddFormHelp").attr('class', 'help is-success');
        
        clearAddFormHelp();
        clearAddFormInput();
        */

        if (typeAdd.value == 'batch') {
            addPayrollLog("Added", "Invoice #" + invoiceNumberAdd.selectedOptions[0].text);
        }

        if (typeAdd.value == 'single') {
            addPayrollLog("Added", "Invoice #" + invoiceNumberAdd.selectedOptions[0].text + " - Vehicle: " + vehicleAdd.selectedOptions[0].text);
        }

        //window.location.href = "billing.php";
        //alert('SUCCESS');
        closeAdd();
        ancestorTile.innerHTML = '';
        generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
    });
    //shipmentDatatable.ajax.reload();
}

function redirectToPDF() {
    $.post("./classes/set-payslip-session-variable3.class.php", {
        invoiceNumberPDF: invoiceNumberPDF.value
    }, function (data) {
        //alert(data);
        window.location.href = "payslip-pdf-batch.php";
    });
}

populateSelect1();
populateSelect3();

generatePayrollLog();

//alert(tabValueHidden.innerHTML);


submitAddForm.addEventListener('click', (e) => {
    generateAjax();
});

submitPDFForm.addEventListener('click', (e) => {
    redirectToPDF();
});

allTabLink.addEventListener('click', () => {
    settledTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;

    //alert(tabValueHidden.innerHTML);
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

settledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    settledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Settled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    //alert(tabValueHidden.innerHTML);
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

unsettledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    settledTabLi.classList.remove('is-active');

    unsettledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Unsettled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    //alert(tabValueHidden.innerHTML);
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);

});