
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

function openLog() {
    logModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
}

function closeLog() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/

    logModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

function generatePayslipList1(tabValueVar, orderByVar) {
    $.post("./classes/load-payslip-individual.class.php", {
        tabValue: tabValueVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        let temp_array1 = [];
        let temp_array2 = [];

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
            newCard.appendChild(newCardHeader);

            //CARD HEADER PARAGRAPH
            var newCardHeaderParagraph = document.createElement("p");
            newCardHeaderParagraph.classList.add('card-header-title');

            var newCardHeaderParagraphIcon = document.createElement("i");
            newCardHeaderParagraphIcon.classList.add('fa-solid');
            newCardHeaderParagraphIcon.classList.add('fa-circle');
            newCardHeaderParagraphIcon.classList.add('mr-3');

            newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);

            switch (jsonArray[i][13]) {
                case "Settled":
                    newCardHeaderParagraph.classList.add('has-text-primary');
                    newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-check mr-3 has-text-primary'></i>" + jsonArray[i][13] + " - " + jsonArray[i][17];
                    newCardHeader.appendChild(newCardHeaderParagraph);
                    break;
                case "Unsettled":
                    newCardHeaderParagraph.classList.add('has-text-warning');
                    newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-exclamation mr-3 has-text-warning'></i>" + jsonArray[i][13];
                    newCardHeader.appendChild(newCardHeaderParagraph);
                    break;

            }

            //CARD HEADER BUTTON
            /*
                                    var newCardHeaderButton = document.createElement("button");
                                    //newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i5][0] + "','" + jsonArray[i5][1] + "')");
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
            /*
            var newContentParagraph1 = document.createElement("p");
            newContentParagraph1.classList.add('subtitle');
            newContentParagraph1.classList.add('is-5');
            newContentParagraph1.classList.add('mb-5');
            newContentParagraph1.classList.add('has-text-centered');
            newContentParagraph1.innerHTML = "<strong>Plate Number: </strong>" + jsonArray[i5][8];
            newContent.appendChild(newContentParagraph1);

            var newContentParagraph2 = document.createElement("p");
            newContentParagraph2.classList.add('subtitle');
            newContentParagraph2.classList.add('is-5');
            newContentParagraph2.classList.add('mb-5');
            newContentParagraph2.classList.add('has-text-centered');
            newContentParagraph2.innerHTML = "<strong>Owner: </strong>" + jsonArray[i5][9] + " " + jsonArray[i5][10] + " " + jsonArray[i5][11] ;
            newContent.appendChild(newContentParagraph2);

            var newContentParagraph3 = document.createElement("p");
            newContentParagraph3.classList.add('subtitle');
            newContentParagraph3.classList.add('is-5');
            newContentParagraph3.classList.add('mb-5');
            newContentParagraph3.classList.add('has-text-centered');
            newContentParagraph3.innerHTML = "<strong>Date: </strong>" + jsonArray[i5][15];
            newContent.appendChild(newContentParagraph3);*/

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
            newContentTableTbodyTr1Td1.innerHTML = "Batch Number:";
            newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

            var newContentTableTbodyTr1Td2 = document.createElement("td");
            newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][0];
            newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

            //CONTENT TABLE TBODY TR 2
            var newContentTableTbodyTr2 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr2);

            var newContentTableTbodyTr2Td1 = document.createElement("td");
            newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr2Td1.innerHTML = "Plate Number:";
            newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

            var newContentTableTbodyTr2Td2 = document.createElement("td");
            newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][8];
            newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

            //CONTENT TABLE TBODY TR 3
            var newContentTableTbodyTr3 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr3);

            var newContentTableTbodyTr3Td1 = document.createElement("td");
            newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr3Td1.innerHTML = "Owner:";
            newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

            var newContentTableTbodyTr3Td2 = document.createElement("td");
            newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][9] + " " + jsonArray[i][10] + " " + jsonArray[i][11];
            newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

            //CONTENT TABLE TBODY TR 4
            var newContentTableTbodyTr4 = document.createElement("tr");
            newContentTableTbody.appendChild(newContentTableTbodyTr4);

            var newContentTableTbodyTr4Td1 = document.createElement("td");
            newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
            newContentTableTbodyTr4Td1.innerHTML = "Date:";
            newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

            var newContentTableTbodyTr4Td2 = document.createElement("td");
            newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][15];
            newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

            //CARD CONTENT MEDIA-CONTENT SUBTITLE
            var newCardFooter = document.createElement("footer");
            newCardFooter.classList.add('card-footer');
            newCard.appendChild(newCardFooter);

            //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
            var newCardFooterLink = document.createElement("a");
            newCardFooterLink.setAttribute("onclick", "redirectToPayslipProfile('" + jsonArray[i][0] + "','" + jsonArray[i][16] + "','" + jsonArray[i][13] + "','" + jsonArray[i][8] + "')");
            newCardFooterLink.classList.add('card-footer-item');
            newCardFooterLink.innerHTML = "View Details";
            newCardFooter.appendChild(newCardFooterLink);
            /*
             var newCardFooterLink2 = document.createElement("a");
             newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
             newCardFooterLink2.classList.add('card-footer-item');
             newCardFooterLink2.innerHTML = "Edit Details";
             newCardFooter.appendChild(newCardFooterLink2);
            */
            //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
            newParentTile.appendChild(newChildTile);
            /*
            var newHeader1 = document.createElement("h1");
            newHeader1.innerHTML = "Shipment Number: " + jsonArray[i5][0] + "<br>" + "Billing Id: " + temp_array1[i2] + "<br>" + "Plate Number: " + temp_array2[i4];
            ancestorTile.appendChild(newHeader1);*/

        };
        /*
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
                                newCard.appendChild(newCardHeader);
        
                                //CARD HEADER PARAGRAPH
                                var newCardHeaderParagraph = document.createElement("p");
                                newCardHeaderParagraph.classList.add('card-header-title');
        
                                var newCardHeaderParagraphIcon = document.createElement("i");
                                newCardHeaderParagraphIcon.classList.add('fa-solid');
                                newCardHeaderParagraphIcon.classList.add('fa-circle');
                                newCardHeaderParagraphIcon.classList.add('mr-3');
        
                                newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);
        
                                switch (jsonArray[i5][13]) {
                                    case "Settled":
                                        newCardHeaderParagraph.classList.add('has-text-primary');
                                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-check mr-3 has-text-primary'></i>" + jsonArray[i5][13] + " - " + jsonArray[i5][17];
                                        newCardHeader.appendChild(newCardHeaderParagraph);
                                        break;
                                    case "Unsettled":
                                        newCardHeaderParagraph.classList.add('has-text-warning');
                                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-exclamation mr-3 has-text-warning'></i>" + jsonArray[i5][13];
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
                                newContentTableTbodyTr1Td1.innerHTML = "Batch Number:";
                                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);
        
                                var newContentTableTbodyTr1Td2 = document.createElement("td");
                                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i5][0];
                                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);
        
                                //CONTENT TABLE TBODY TR 2
                                var newContentTableTbodyTr2 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr2);
        
                                var newContentTableTbodyTr2Td1 = document.createElement("td");
                                newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
                                newContentTableTbodyTr2Td1.innerHTML = "Plate Number:";
                                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);
        
                                var newContentTableTbodyTr2Td2 = document.createElement("td");
                                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i5][8];
                                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);
        
                                //CONTENT TABLE TBODY TR 3
                                var newContentTableTbodyTr3 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr3);
        
                                var newContentTableTbodyTr3Td1 = document.createElement("td");
                                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
                                newContentTableTbodyTr3Td1.innerHTML = "Owner:";
                                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);
        
                                var newContentTableTbodyTr3Td2 = document.createElement("td");
                                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i5][9] + " " + jsonArray[i5][10] + " " + jsonArray[i5][11];
                                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);
        
                                //CONTENT TABLE TBODY TR 4
                                var newContentTableTbodyTr4 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr4);
        
                                var newContentTableTbodyTr4Td1 = document.createElement("td");
                                newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
                                newContentTableTbodyTr4Td1.innerHTML = "Date:";
                                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);
        
                                var newContentTableTbodyTr4Td2 = document.createElement("td");
                                newContentTableTbodyTr4Td2.innerHTML = jsonArray[i5][15];
                                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);
        
                                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                                var newCardFooter = document.createElement("footer");
                                newCardFooter.classList.add('card-footer');
                                newCard.appendChild(newCardFooter);
        
                                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                                var newCardFooterLink = document.createElement("a");
                                newCardFooterLink.setAttribute("onclick", "redirectToPayslipProfile('" + jsonArray[i5][0] + "','" + jsonArray[i5][16] + "','" + jsonArray[i5][13]+ "','" + jsonArray[i5][8] + "')");
                                newCardFooterLink.classList.add('card-footer-item');
                                newCardFooterLink.innerHTML = "View Details";
                                newCardFooter.appendChild(newCardFooterLink);
        
                                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                                newParentTile.appendChild(newChildTile);
        
        
                            };
        
                        }
        
                    }
        
                }
        */
    });
}

function redirectToPayslipProfile(billingIdVar, ownerIdVar, payrollStatusVar, plateNumberVar) {
    $.post("./classes/set-payslip-session-variable.class.php", {
        billingId: billingIdVar,
        ownerId: ownerIdVar,
        payrollStatus: payrollStatusVar,
        plateNumber: plateNumberVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "payslip-profile-individual.php";
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

generatePayrollLog();

generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);

allTabLink.addEventListener('click', () => {
    settledTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

settledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    settledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Settled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

unsettledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    settledTabLi.classList.remove('is-active');

    unsettledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Unsettled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generatePayslipList1(tabValueHidden.innerHTML, selectSort.value);

});