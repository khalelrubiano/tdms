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

let invoiceNumberAdd = document.getElementById('invoiceNumberAdd')
let invoiceDateAdd = document.getElementById('invoiceDateAdd')
let clientAdd = document.getElementById('clientAdd')
let dropFeeAdd = document.getElementById('dropFeeAdd')
let parkingFeeAdd = document.getElementById('parkingFeeAdd')
let demurrageAdd = document.getElementById('demurrageAdd')
let otherChargesAdd = document.getElementById('otherChargesAdd')
let penaltyAdd = document.getElementById('penaltyAdd')
let startDateAdd = document.getElementById('startDateAdd')
let endDateAdd = document.getElementById('endDateAdd')

let invoiceNumberAddHelp = document.getElementById('invoiceNumberAddHelp')
let dropFeeAddHelp = document.getElementById('dropFeeAddHelp')
let parkingFeeAddHelp = document.getElementById('parkingFeeAddHelp')
let demurrageAddHelp = document.getElementById('demurrageAddHelp')
let otherChargesAddHelp = document.getElementById('otherChargesAddHelp')
let penaltyAddHelp = document.getElementById('penaltyAddHelp')

const addModal = document.getElementById('addModal');

let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let logList = document.getElementById('logList')

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
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
function deleteAjax(deleteVar, deleteVar2) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-billing-controller.class.php", {
            billingId: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            addBillingLog("Deleted", "Invoice #" + deleteVar2);
            refreshList();
        });
    }
}

function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-log-controller.class.php", {
        logDescription: logDescriptionVar,
        moduleDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

function generateBillingLog() {
    $.post("./classes/load-billing-log.class.php", {
    }, function (data) {
        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newLi = document.createElement("li");
            newLi.innerHTML = jsonArray[i][3] + " - " + jsonArray[i][1] + " " + jsonArray[i][0] + " " + jsonArray[i][2];
            logList.appendChild(newLi);
        }

    });
}

generateBillingLog();

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

        //closeSelect();
    });
}

let addBtn = document.getElementById('addBtn');

addBtn.addEventListener('click', (e) => {
    window.location.href = "generate-invoice.php";
});


//ADD AJAX CALLS WITH VALIDATION

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only
/*
function addAjax() {
    $.post("./classes/add-billing-controller.class.php", {
        invoiceNumberAdd: invoiceNumberAdd.value,
        invoiceDateAdd: invoiceDateAdd.value,
        clientAdd: clientAdd.value,
        dropFeeAdd: dropFeeAdd.value,
        parkingFeeAdd: parkingFeeAdd.value,
        demurrageAdd: demurrageAdd.value,
        otherChargesAdd: otherChargesAdd.value,
        penaltyAdd: penaltyAdd.value,
        startDateAdd: startDateAdd.value,
        endDateAdd: endDateAdd.value
    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //refreshTable();
        addBillingLog("Added", "Invoice #" + invoiceNumberAdd.value);
        refreshList();
        closeAdd();
    });
    //refreshTable();

}


submitAddForm.addEventListener('click', (e) => {
    //clearAddFormHelp();

    let invoiceNumberAddMessages = [];
    let dropFeeAddMessages = [];
    let parkingFeeAddMessages = [];
    let demurrageAddMessages = [];
    let otherChargesAddMessages = [];
    let penaltyAddMessages = [];

    //Invoice Number Validation
    if (pattern2.test(invoiceNumberAdd.value) == false) {
        invoiceNumberAdd.className = "input is-danger is-rounded"
        invoiceNumberAddHelp.className = "help is-danger"
        invoiceNumberAddMessages.push('Invoice number should only consist of numbers and letters!')
    }

    if (invoiceNumberAdd.value === "" || invoiceNumberAdd.value == null) {
        invoiceNumberAdd.className = "input is-danger is-rounded"
        invoiceNumberAddHelp.className = "help is-danger"
        invoiceNumberAddMessages.push('Invoice number is required!')
    }

    if (invoiceNumberAdd.value.length < 1) {
        invoiceNumberAdd.className = "input is-danger is-rounded"
        invoiceNumberAddHelp.className = "help is-danger"
        invoiceNumberAddMessages.push('Invoice number must be longer than 1 character!')
    }

    if (invoiceNumberAdd.value.length > 255) {
        invoiceNumberAdd.className = "input is-danger is-rounded"
        invoiceNumberAddHelp.className = "help is-danger"
        invoiceNumberAddMessages.push('Invoice number must be less than 255 characters!')
    }

    //Drop Fee Validation
    if (pattern4.test(dropFeeAdd.value) == false) {
        dropFeeAdd.className = "input is-danger is-rounded"
        dropFeeAddHelp.className = "help is-danger"
        dropFeeAddMessages.push('Drop fee should only consist of numbers!')
    }

    if (dropFeeAdd.value === "" || dropFeeAdd.value == null) {
        dropFeeAdd.className = "input is-danger is-rounded"
        dropFeeAddHelp.className = "help is-danger"
        dropFeeAddMessages.push('Drop fee is required!')
    }

    if (dropFeeAdd.value.length < 1) {
        dropFeeAdd.className = "input is-danger is-rounded"
        dropFeeAddHelp.className = "help is-danger"
        dropFeeAddMessages.push('Drop fee must be longer than 1 character!')
    }

    if (dropFeeAdd.value.length > 255) {
        dropFeeAdd.className = "input is-danger is-rounded"
        dropFeeAddHelp.className = "help is-danger"
        dropFeeAddMessages.push('Drop fee must be less than 255 characters!')
    }

    //Parking Fee Validation
    if (pattern4.test(parkingFeeAdd.value) == false) {
        parkingFeeAdd.className = "input is-danger is-rounded"
        parkingFeeAddHelp.className = "help is-danger"
        parkingFeeAddMessages.push('Parking fee should only consist of numbers!')
    }

    if (parkingFeeAdd.value === "" || parkingFeeAdd.value == null) {
        parkingFeeAdd.className = "input is-danger is-rounded"
        parkingFeeAddHelp.className = "help is-danger"
        parkingFeeAddMessages.push('Parking fee is required!')
    }

    if (parkingFeeAdd.value.length < 1) {
        parkingFeeAdd.className = "input is-danger is-rounded"
        parkingFeeAddHelp.className = "help is-danger"
        parkingFeeAddMessages.push('Parking fee must be longer than 1 character!')
    }

    if (parkingFeeAdd.value.length > 255) {
        parkingFeeAdd.className = "input is-danger is-rounded"
        parkingFeeAddHelp.className = "help is-danger"
        parkingFeeAddMessages.push('Parking fee must be less than 255 characters!')
    }

    //Demurrage Validation
    if (pattern4.test(demurrageAdd.value) == false) {
        demurrageAdd.className = "input is-danger is-rounded"
        demurrageAddHelp.className = "help is-danger"
        demurrageAddMessages.push('Demurrage should only consist of numbers!')
    }

    if (demurrageAdd.value === "" || demurrageAdd.value == null) {
        demurrageAdd.className = "input is-danger is-rounded"
        demurrageAddHelp.className = "help is-danger"
        demurrageAddMessages.push('Demurrage is required!')
    }

    if (demurrageAdd.value.length < 1) {
        demurrageAdd.className = "input is-danger is-rounded"
        demurrageAddHelp.className = "help is-danger"
        demurrageAddMessages.push('Demurrage must be longer than 1 character!')
    }

    if (demurrageAdd.value.length > 255) {
        demurrageAdd.className = "input is-danger is-rounded"
        demurrageAddHelp.className = "help is-danger"
        demurrageAddMessages.push('Demurrage must be less than 255 characters!')
    }

    //Other Charges Validation
    if (pattern4.test(otherChargesAdd.value) == false) {
        otherChargesAdd.className = "input is-danger is-rounded"
        otherChargesAddHelp.className = "help is-danger"
        otherChargesAddMessages.push('Other charges should only consist of numbers!')
    }

    if (otherChargesAdd.value === "" || otherChargesAdd.value == null) {
        otherChargesAdd.className = "input is-danger is-rounded"
        otherChargesAddHelp.className = "help is-danger"
        otherChargesAddMessages.push('Other charges is required!')
    }

    if (otherChargesAdd.value.length < 1) {
        otherChargesAdd.className = "input is-danger is-rounded"
        otherChargesAddHelp.className = "help is-danger"
        otherChargesAddMessages.push('Other charges must be longer than 1 character!')
    }

    if (otherChargesAdd.value.length > 255) {
        otherChargesAdd.className = "input is-danger is-rounded"
        otherChargesAddHelp.className = "help is-danger"
        otherChargesAddMessages.push('Other charges must be less than 255 characters!')
    }

    //Penalty Validation
    if (pattern4.test(penaltyAdd.value) == false) {
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
    //Messages
    if (invoiceNumberAddMessages.length > 0) {
        e.preventDefault()
        invoiceNumberAddHelp.innerText = invoiceNumberAddMessages.join(', ')
    }
    if (dropFeeAddMessages.length > 0) {
        e.preventDefault()
        dropFeeAddHelp.innerText = dropFeeAddMessages.join(', ')
    }
    if (parkingFeeAddMessages.length > 0) {
        e.preventDefault()
        parkingFeeAddHelp.innerText = parkingFeeAddMessages.join(', ')
    }
    if (demurrageAddMessages.length > 0) {
        e.preventDefault()
        demurrageAddHelp.innerText = demurrageAddMessages.join(', ')
    }
    if (otherChargesAddMessages.length > 0) {
        e.preventDefault()
        otherChargesAddHelp.innerText = otherChargesAddMessages.join(', ')
    }
    if (penaltyAddMessages.length > 0) {
        e.preventDefault()
        penaltyAddHelp.innerText = penaltyAddMessages.join(', ')
    }
    if (
        invoiceNumberAddMessages.length <= 0 &&
        dropFeeAddMessages.length <= 0 &&
        parkingFeeAddMessages.length <= 0 &&
        demurrageAddMessages.length <= 0 &&
        otherChargesAddMessages.length <= 0 &&
        penaltyAddMessages.length <= 0
    ) {
        addAjax();
    }
    //refreshTable();
    


})
*/
function generateBillingList1(tabValueVar) {
    $.post("./classes/load-billing.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;
        //generateBillingList2(tabValueHidden.innerHTML, currentPageNumber, selectSort.value, finalLength);

        let i = 1;
        while (i <= finalLength) {
            generateBillingList2(tabValueVar, i, selectSort.value, finalLength);
            i++;
        }

    });
}

function generateBillingList2(tabValueVar, currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-billing-all.class.php", {
        tabValue: tabValueVar,
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);
        indicator.innerHTML = "call success";

        if (currentPageNumber <= finalLengthVar) {


            var newParentTile = document.createElement("div");
            newParentTile.classList.add('tile');
            newParentTile.classList.add('is-parent');
            newParentTile.classList.add('is-vertical');
            newParentTile.setAttribute("style", "align-items: center;");
            ancestorTile.appendChild(newParentTile);

            indicator.innerHTML = jsonArray.length;

            for (var i = 0; i < jsonArray.length; i++) {

                var newChildTile = document.createElement("div");
                newChildTile.classList.add('tile');
                newChildTile.classList.add('is-child');
                newChildTile.classList.add('p-2');
                newChildTile.classList.add('is-6');

                //CARD
                var newCard = document.createElement("div");
                newCard.classList.add('card');
                newCard.setAttribute("style", "border-radius: 5%;");
                newChildTile.appendChild(newCard);

                //CARD HEADER

                var newCardHeader = document.createElement("header");
                newCardHeader.classList.add('card-header');
                newCard.appendChild(newCardHeader);

                //CARD HEADER PARAGRAPH
                var newCardHeaderParagraph = document.createElement("p");
                newCardHeaderParagraph.classList.add('card-header-title');

                var newCardHeaderParagraphIcon = document.createElement("i");
                newCardHeaderParagraphIcon.classList.add('fa-solid');
                newCardHeaderParagraphIcon.classList.add('fa-circle');
                newCardHeaderParagraphIcon.classList.add('mr-3');

                //newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);

                switch (jsonArray[i][5]) {
                    case "Settled":
                        newCardHeaderParagraph.classList.add('has-text-primary');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-check mr-3 has-text-primary'></i>" + jsonArray[i][5] + " - " + jsonArray[i][16];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "Unsettled":
                        newCardHeaderParagraph.classList.add('has-text-warning');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-exclamation mr-3 has-text-warning'></i>" + jsonArray[i][5];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;

                }
                /*
                                //CARD HEADER BUTTON
                
                                var newCardHeaderButton = document.createElement("button");
                                newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                                newCardHeaderButton.classList.add('card-header-icon');
                                newCardHeader.appendChild(newCardHeaderButton);
                
                                var newCardHeaderButtonSpan = document.createElement("span");
                                newCardHeaderButtonSpan.classList.add('icon');
                                newCardHeaderButtonSpan.classList.add('is-right');
                                newCardHeaderButton.appendChild(newCardHeaderButtonSpan);
                
                                var newCardHeaderButtonSpanI = document.createElement("i");
                                newCardHeaderButtonSpanI.classList.add('fa-solid');
                                newCardHeaderButtonSpanI.classList.add('fa-xmark');
                                newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);
                
                                //newCardHeaderButton.innerHTML = jsonArray[i][4];
                                //newCardHeader.appendChild(newCardHeaderParagraph);
                */
                //CARD CONTENT
                var newCardContent = document.createElement("div");
                newCardContent.classList.add('card-content');
                newCard.appendChild(newCardContent);

                //CARD CONTENT MEDIA
                var newContent = document.createElement("div");
                newContent.classList.add('content');
                newCardContent.appendChild(newContent);

                //CONTENT PARAGRAPH
                var newContentParagraph = document.createElement("p");
                newContentParagraph.classList.add('title');
                newContentParagraph.classList.add('is-5');
                newContentParagraph.classList.add('mb-5');
                newContentParagraph.classList.add('has-text-centered');
                newContentParagraph.innerHTML = "<i class='fa-solid fa-hashtag mr-1'></i>" + jsonArray[i][1];
                newContent.appendChild(newContentParagraph);

                //CONTENT PARAGRAPH ICON
                /*
                var newContentParagraphIcon = document.createElement("i");
                newContentParagraphIcon.classList.add('fa-solid');
                newContentParagraphIcon.classList.add('fa-hashtag');
                newContentParagraphIcon.classList.add('fa-2x');
                newContentParagraph.appendChild(newContentParagraphIcon);*/

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
                newContentTableTbodyTr1Td1.innerHTML = "Invoice Date:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][2];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr2Td1.innerHTML = "Covered Date:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][3];
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);
/*
                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr3Td1.innerHTML = "End Date:";
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

                var newContentTableTbodyTr3Td2 = document.createElement("td");
                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][11];
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);
*/
                //CONTENT TABLE TBODY TR 4
                var newContentTableTbodyTr4 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr4);

                var newContentTableTbodyTr4Td1 = document.createElement("td");
                newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr4Td1.innerHTML = "Client:";
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

                var newContentTableTbodyTr4Td2 = document.createElement("td");
                newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][19];
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.setAttribute("onclick", "redirectToBillingProfile('" + jsonArray[i][0] + "','" + jsonArray[i][5] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View";
                newCardFooter.appendChild(newCardFooterLink);

                var newCardFooterLink2 = document.createElement("a");
                newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
                newCardFooterLink2.classList.add('has-text-danger');
                newCardFooter.appendChild(newCardFooterLink2);

                /*
                                var newCardFooterLink2 = document.createElement("a");
                                newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                                newCardFooterLink2.classList.add('card-footer-item');
                                newCardFooterLink2.innerHTML = "Edit Details";
                                newCardFooter.appendChild(newCardFooterLink2);
                */
                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function redirectToBillingProfile(billingIdVar, statusVar) {
    $.post("./classes/set-billing-session-variable.class.php", {
        billingId: billingIdVar,
        invoiceStatus: statusVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "billing-profile.php";
    });
}

function refreshList() {
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateBillingList1(tabValueHidden.innerHTML);

    //generateUserList2(1, selectSort.value);
}

document.addEventListener('DOMContentLoaded', function () {

    populateSelect1();
    refreshList();

});

//populateSelect1();
//generateBillingList1();
//generateBillingList2(tabValueHidden.innerHTML, 1, selectSort.value);

allTabLink.addEventListener('click', () => {
    settledTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateBillingList1(tabValueHidden.innerHTML);
    //generateBillingList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

settledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    settledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Settled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateBillingList1(tabValueHidden.innerHTML);
    //generateBillingList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

unsettledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    settledTabLi.classList.remove('is-active');

    unsettledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Unsettled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateBillingList1(tabValueHidden.innerHTML);
    //generateBillingList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateBillingList1(tabValueHidden.innerHTML);
    //generateBillingList2(tabValueHidden.innerHTML, 1, selectSort.value);

});

