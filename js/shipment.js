let allTabLink = document.getElementById('allTabLink');
let inProgressTabLink = document.getElementById('inProgressTabLink');
let completedTabLink = document.getElementById('completedTabLink');
let cancelledTabLink = document.getElementById('cancelledTabLink');

let allTabLi = document.getElementById('allTabLi');
let inProgressTabLi = document.getElementById('inProgressTabLi');
let completedTabLi = document.getElementById('completedTabLi');
let cancelledTabLi = document.getElementById('cancelledTabLi');

const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;

let tabValueHidden = document.getElementById('tabValueHidden')

let logList = document.getElementById('logList')

//console.log("js code was loaded");

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
}

function closeAdd() {
    clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""

    addModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

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


/*

POST A THIRD VARIABLE TO THE LOAD SHIPMENT ALL FILE THAT DETERMINES WHETHER THE SQL QUERY RETURNS ALL / IN-PROGRESS / COMPLETED/ CANCELLED, USE CUSTOM FUNCTIONS FOR EACH TAB CATEGORY

Vehicle1 arrived at pick-up location
Vehicle1 started loading the goods
Vehicle1 departed from the pick-up location

etc...
*/



//DELETE AJAX CALL
function deleteAjax(deleteVar, deleteVar2) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-shipment-controller.class.php", {
            shipmentId: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            addShipmentLog("Deleted", "Shipment #" + deleteVar2);
            refreshList();
        });
    }
}

function addShipmentLog(logDescriptionVar, shipmentDescriptionVar) {
    $.post("./classes/add-shipment-log-controller.class.php", {
        logDescription: logDescriptionVar,
        shipmentDescription: shipmentDescriptionVar
    }, function (data) {
        //alert(data);
    });
}

function generateShipmentLog() {
    $.post("./classes/load-shipment-log.class.php", {
    }, function (data) {
        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newLi = document.createElement("li");
            newLi.innerHTML = jsonArray[i][3] + " - " + jsonArray[i][1] + " " + jsonArray[i][0] + " " + jsonArray[i][2];
            logList.appendChild(newLi);
        }

    });
}
generateShipmentLog();


//SHIPMENT LIST
function generateShipmentList1(tabValueVar) {
    $.post("./classes/load-shipment.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;
        //generateShipmentList2(tabValueHidden.innerHTML, currentPageNumber, selectSort.value, finalLength);

        let i = 1;
        while (i <= finalLength) {
            generateShipmentList2(tabValueVar, i, selectSort.value, finalLength);
            i++;
        }

    });
}

function generateShipmentList2(tabValueVar, currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-shipment-all.class.php", {
        tabValue: tabValueVar,
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {
        console.log("js code was loaded");
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

                switch (jsonArray[i][2]) {
                    case "In-progress":
                        newCardHeaderParagraph.classList.add('has-text-warning');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-warning'></i>" + jsonArray[i][2];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "Completed":
                        newCardHeaderParagraph.classList.add('has-text-primary');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-primary'></i>" + jsonArray[i][2];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "Cancelled":
                        newCardHeaderParagraph.classList.add('has-text-grey');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-grey'></i>" + jsonArray[i][2];
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

                /*CONTENT TABLE TBODY TR 1
                var newContentTableTbodyTr1 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr1);

                var newContentTableTbodyTr1Td1 = document.createElement("td");
                newContentTableTbodyTr1Td1.innerHTML = "Starting Point:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][3];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);*/

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr2Td1.innerHTML = "Destination:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][4];
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr3Td1.innerHTML = "Expected Date of Delivery:";
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

                var newContentTableTbodyTr3Td2 = document.createElement("td");
                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][5];
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

                //CONTENT TABLE TBODY TR 4
                var newContentTableTbodyTr4 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr4);

                var newContentTableTbodyTr4Td1 = document.createElement("td");
                newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr4Td1.innerHTML = "Vehicle Plate Number:";
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
                newCardFooterLink.setAttribute("onclick", "redirectToShipmentProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][6] + "','" + jsonArray[i][7] + "','" + jsonArray[i][8] + "','" + jsonArray[i][9] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View";
                newCardFooterLink.classList.add('has-text-info');
                newCardFooter.appendChild(newCardFooterLink);

                var newCardFooterLink2 = document.createElement("a");
                newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
                newCardFooterLink2.classList.add('has-text-danger');
                newCardFooter.appendChild(newCardFooterLink2);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function generateShipmentList3(searchTerm) {
    $.post("./classes/load-shipment.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][1]:
                    console.clear();
                    console.log("Shipment Number")
                    indicator.innerHTML = "Shipment Number";
                    generateShipmentList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][5], jsonArray[i][6], jsonArray[i][7], jsonArray[i][8], jsonArray[i][9]);
                    break;

                case jsonArray[i][7]:
                    console.clear();
                    console.log("Vehicle Plate Number")
                    indicator.innerHTML = "Vehicle Plate Number";
                    generateShipmentList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][5], jsonArray[i][6], jsonArray[i][7], jsonArray[i][8], jsonArray[i][9]);
                    break;
            }

        }

    });

}

function generateShipmentList4(shipmentIdVar, shipmentNumberVar, shipmentStatusVar, shipmentDescriptionVar, destinationVar, dateOfDeliveryVar, clientNameVar, plateNumberVar, vehicleIdVar, areaIdVar) {
    ancestorTile.innerHTML = "";
    var newParentTile = document.createElement("div");
    newParentTile.classList.add('tile');
    newParentTile.classList.add('is-parent');
    newParentTile.classList.add('is-vertical');
    newParentTile.setAttribute("style", "align-items: center;");
    ancestorTile.appendChild(newParentTile);
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

    //newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);

    switch (shipmentStatusVar) {
        case "In-progress":
            newCardHeaderParagraph.classList.add('has-text-warning');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-warning'></i>" + shipmentStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;
        case "Completed":
            newCardHeaderParagraph.classList.add('has-text-primary');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-primary'></i>" + shipmentStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;
        case "Cancelled":
            newCardHeaderParagraph.classList.add('has-text-grey');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-grey'></i>" + shipmentStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;

    }

    //CARD HEADER BUTTON
    /*
    var newCardHeaderButton = document.createElement("button");
    newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "')");
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
*/
    //newCardHeaderButton.innerHTML = jsonArray[i][4];
    //newCardHeader.appendChild(newCardHeaderParagraph);

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
    newContentParagraph.innerHTML = "<i class='fa-solid fa-hashtag mr-1'></i>" + shipmentNumberVar;
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

    /*CONTENT TABLE TBODY TR 1
    var newContentTableTbodyTr1 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr1);

    var newContentTableTbodyTr1Td1 = document.createElement("td");
    newContentTableTbodyTr1Td1.innerHTML = "Starting Point:";
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

    var newContentTableTbodyTr1Td2 = document.createElement("td");
    newContentTableTbodyTr1Td2.innerHTML = shipmentDescriptionVar;
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);*/

    //CONTENT TABLE TBODY TR 2
    var newContentTableTbodyTr2 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr2);

    var newContentTableTbodyTr2Td1 = document.createElement("td");
    newContentTableTbodyTr2Td1.innerHTML = "Destination:";
    newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

    var newContentTableTbodyTr2Td2 = document.createElement("td");
    newContentTableTbodyTr2Td2.innerHTML = destinationVar;
    newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

    //CONTENT TABLE TBODY TR 3
    var newContentTableTbodyTr3 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr3);

    var newContentTableTbodyTr3Td1 = document.createElement("td");
    newContentTableTbodyTr3Td1.innerHTML = "Expected Date of Delivery:";
    newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

    var newContentTableTbodyTr3Td2 = document.createElement("td");
    newContentTableTbodyTr3Td2.innerHTML = dateOfDeliveryVar;
    newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

    //CONTENT TABLE TBODY TR 4
    var newContentTableTbodyTr4 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr4);

    var newContentTableTbodyTr4Td1 = document.createElement("td");
    newContentTableTbodyTr4Td1.innerHTML = "Vehicle Plate Number:";
    newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

    var newContentTableTbodyTr4Td2 = document.createElement("td");
    newContentTableTbodyTr4Td2.innerHTML = plateNumberVar;
    newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardFooter = document.createElement("footer");
    newCardFooter.classList.add('card-footer');
    newCard.appendChild(newCardFooter);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
    var newCardFooterLink = document.createElement("a");
    newCardFooterLink.setAttribute("onclick", "redirectToShipmentProfile('" + shipmentIdVar + "','" + shipmentNumberVar + "','" + shipmentStatusVar + "','" + shipmentDescriptionVar + "','" + destinationVar + "','" + dateOfDeliveryVar + "','" + clientNameVar + "','" + plateNumberVar + "','" + vehicleIdVar + "','" + areaIdVar + "')");
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.innerHTML = "View Details";
    newCardFooter.appendChild(newCardFooterLink);
    /*
                    var newCardFooterLink2 = document.createElement("a");
                    newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                    newCardFooterLink2.classList.add('card-footer-item');
                    newCardFooterLink2.innerHTML = "Manage Tracker";
                    newCardFooter.appendChild(newCardFooterLink2);
    */
    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}

//shipmentId, shipmentNumber, shipmentStatus, shipmentDescription, destination, dateOfDelivery, plateNumber, shipmentDescription, 
function redirectToShipmentProfile(shipmentIdVar, shipmentNumberVar, shipmentStatusVar, shipmentDescriptionVar, destinationVar, dateOfDeliveryVar, clientNameVar, plateNumberVar, vehicleIdVar, areaIdVar) {
    $.post("./classes/set-shipment-session-variable.class.php", {
        shipmentId: shipmentIdVar,
        shipmentNumber: shipmentNumberVar,
        shipmentStatus: shipmentStatusVar,
        shipmentDescription: shipmentDescriptionVar,
        destination: destinationVar,
        dateOfDelivery: dateOfDeliveryVar,
        clientName: clientNameVar,
        plateNumber: plateNumberVar,
        vehicleId: vehicleIdVar,
        areaId: areaIdVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "shipment-profile.php";
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

        //closeSelect();
    });
}

function populateSelect2(clientIdVar) {
    $.post("./classes/load-client-area-select.class.php", {
        clientId: clientIdVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

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

function populateSelect3() {
    $.post("./classes/load-vehicle-select.class.php", {

    }, function (data) {
        //alert("call success");
        var jsonArray = JSON.parse(data);
        //alert(jsonArray[i][0]);
        for (var i = 0; i < jsonArray.length; i++) {
            //alert(jsonArray[i][0]);
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "Plate Number: " + jsonArray[i][1] + " Driver: " + jsonArray[i][4];
            vehicleAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

function refreshList() {
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);

    //generateUserList2(1, selectSort.value);
}

//ADD AJAX CALLS WITH VALIDATION
const addModal = document.getElementById('addModal');

let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let shipmentNumberAdd = document.getElementById('shipmentNumberAdd');
let shipmentDescriptionAdd = document.getElementById('shipmentDescriptionAdd');
let destinationAdd = document.getElementById('destinationAdd');
let dateOfDeliveryAdd = document.getElementById('dateOfDeliveryAdd');
let clientAdd = document.getElementById('clientAdd');
let areaRateAdd = document.getElementById('areaRateAdd');
let vehicleAdd = document.getElementById('vehicleAdd');

let shipmentNumberAddHelp = document.getElementById('shipmentNumberAddHelp');
let shipmentDescriptionAddHelp = document.getElementById('shipmentDescriptionAddHelp');
let destinationAddHelp = document.getElementById('destinationAddHelp');
let dateOfDeliveryAddHelp = document.getElementById('dateOfDeliveryAddHelp');

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only

function addAjax() {
    $.post("./classes/add-shipment-controller.class.php", {
        shipmentNumberAdd: shipmentNumberAdd.value,
        shipmentDescriptionAdd: shipmentDescriptionAdd.value,
        destinationAdd: destinationAdd.value,
        dateOfDeliveryAdd: dateOfDeliveryAdd.value,
        clientAdd: clientAdd.value,
        areaRateAdd: areaRateAdd.value,
        vehicleAdd: vehicleAdd.value
    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //refreshTable();
        addShipmentLog("Added", "Shipment #" + shipmentNumberAdd.value);
        closeAdd();
        refreshList();
    });
    //refreshTable();

}

submitAddForm.addEventListener('click', (e) => {
    //clearAddFormHelp();

    let shipmentNumberAddMessages = [];
    let shipmentDescriptionAddMessages = [];
    let destinationAddMessages = [];
    let dateOfDeliveryAddMessages = [];

    //Shipment Number Validation
    if (pattern4.test(shipmentNumberAdd.value) == false) {
        shipmentNumberAdd.className = "input is-danger is-rounded"
        shipmentNumberAddHelp.className = "help is-danger"
        shipmentNumberAddMessages.push('Shipment number should only consist of numbers!')
    }

    if (shipmentNumberAdd.value === "" || shipmentNumberAdd.value == null) {
        shipmentNumberAdd.className = "input is-danger is-rounded"
        shipmentNumberAddHelp.className = "help is-danger"
        shipmentNumberAddMessages.push('Shipment number is required!')
    }

    if (shipmentNumberAdd.value.length < 1) {
        shipmentNumberAdd.className = "input is-danger is-rounded"
        shipmentNumberAddHelp.className = "help is-danger"
        shipmentNumberAddMessages.push('Shipment number must be longer than 1 character!')
    }

    if (shipmentNumberAdd.value.length > 255) {
        shipmentNumberAdd.className = "input is-danger is-rounded"
        shipmentNumberAddHelp.className = "help is-danger"
        shipmentNumberAddMessages.push('Shipment number must be less than 255 characters!')
    }

    //Starting Point Validation
    if (pattern2.test(shipmentDescriptionAdd.value) == false) {
        shipmentDescriptionAdd.className = "input is-danger is-rounded"
        shipmentDescriptionAddHelp.className = "help is-danger"
        shipmentDescriptionAddMessages.push('Shipment description should only consist of numbers and letters!')
    }

    if (shipmentDescriptionAdd.value === "" || shipmentDescriptionAdd.value == null) {
        shipmentDescriptionAdd.className = "input is-danger is-rounded"
        shipmentDescriptionAddHelp.className = "help is-danger"
        shipmentDescriptionAddMessages.push('Shipment description is required!')
    }

    if (shipmentDescriptionAdd.value.length < 1) {
        shipmentDescriptionAdd.className = "input is-danger is-rounded"
        shipmentDescriptionAddHelp.className = "help is-danger"
        shipmentDescriptionAddMessages.push('Shipment description must be longer than 1 character!')
    }

    if (shipmentDescriptionAdd.value.length > 255) {
        shipmentDescriptionAdd.className = "input is-danger is-rounded"
        shipmentDescriptionAddHelp.className = "help is-danger"
        shipmentDescriptionAddMessages.push('Shipment description must be less than 255 characters!')
    }

    //Destination Validation
    if (pattern2.test(destinationAdd.value) == false) {
        destinationAdd.className = "input is-danger is-rounded"
        destinationAddHelp.className = "help is-danger"
        destinationAddMessages.push('Destination should only consist of numbers and letters!')
    }

    if (destinationAdd.value === "" || destinationAdd.value == null) {
        destinationAdd.className = "input is-danger is-rounded"
        destinationAddHelp.className = "help is-danger"
        destinationAddMessages.push('Destination is required!')
    }

    if (destinationAdd.value.length < 1) {
        destinationAdd.className = "input is-danger is-rounded"
        destinationAddHelp.className = "help is-danger"
        destinationAddMessages.push('Destination must be longer than 1 character!')
    }

    if (destinationAdd.value.length > 255) {
        destinationAdd.className = "input is-danger is-rounded"
        destinationAddHelp.className = "help is-danger"
        destinationAddMessages.push('Destination must be less than 255 characters!')
    }

    //Date of Delivery Validation
    if (dateOfDeliveryAdd.value === "" || dateOfDeliveryAdd.value == null) {
        dateOfDeliveryAdd.className = "input is-danger is-rounded"
        dateOfDeliveryAddHelp.className = "help is-danger"
        dateOfDeliveryAddMessages.push('Date of delivery is required!')
    }

    //Messages
    if (shipmentNumberAddMessages.length > 0) {
        e.preventDefault()
        shipmentNumberAddHelp.innerText = shipmentNumberAddMessages.join(', ')
    }
    if (shipmentDescriptionAddMessages.length > 0) {
        e.preventDefault()
        shipmentDescriptionAddHelp.innerText = shipmentDescriptionAddMessages.join(', ')
    }
    if (destinationAddMessages.length > 0) {
        e.preventDefault()
        destinationAddHelp.innerText = destinationAddMessages.join(', ')
    }
    if (dateOfDeliveryAddMessages.length > 0) {
        e.preventDefault()
        dateOfDeliveryAddHelp.innerText = dateOfDeliveryAddMessages.join(', ')
    }
    if (
        shipmentNumberAddMessages.length <= 0 &&
        shipmentDescriptionAddMessages.length <= 0 &&
        destinationAddMessages.length <= 0 &&
        dateOfDeliveryAddMessages.length <= 0
    ) {
        addAjax();
    }
    //refreshTable();
})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    shipmentNumberAdd.className = "input is-rounded"
    shipmentNumberAddHelp.className = "help"
    shipmentNumberAddHelp.innerText = ""

    shipmentDescriptionAdd.className = "input is-rounded"
    shipmentDescriptionAddHelp.className = "help"
    shipmentDescriptionAddHelp.innerText = ""

    destinationAdd.className = "input is-rounded"
    destinationAddHelp.className = "help"
    destinationAddHelp.innerText = ""

}

function clearAddFormInput() {
    shipmentNumberAdd.value = null;
    shipmentDescriptionAdd.value = null;
    destinationAdd.value = null;

}

document.addEventListener('DOMContentLoaded', function () {

    populateSelect1();
    populateSelect3();
    refreshList();
    //generateShipmentList1();
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
    //location.reload(true);
});



allTabLink.addEventListener('click', () => {
    inProgressTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

inProgressTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    inProgressTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "In-progress";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

completedTabLink.addEventListener('click', () => {
    inProgressTabLi.classList.remove('is-active');
    allTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    completedTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Completed";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

cancelledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    inProgressTabLi.classList.remove('is-active');

    cancelledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Cancelled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

clientAdd.addEventListener('change', () => {
    areaRateAdd.innerHTML = "";
    populateSelect2(clientAdd.value);
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);

});

searchBarInput.addEventListener('input', () => {
    generateShipmentList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        generateShipmentList1(tabValueHidden.innerHTML);
        //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);

    }
});
/*

POST A THIRD VARIABLE TO THE LOAD SHIPMENT ALL FILE THAT DETERMINES WHETHER THE SQL QUERY RETURNS ALL / IN-PROGRESS / COMPLETED/ CANCELLED, USE CUSTOM FUNCTIONS FOR EACH TAB CATEGORY

*/