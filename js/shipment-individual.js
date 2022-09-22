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



//SHIPMENT LIST
function generateShipmentList1(tabValueVar) {
    $.post("./classes/load-shipment-individual.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;

        let i = 1;
        while (i <= finalLength) {
            generateShipmentList2(tabValueVar, i, selectSort.value, finalLength);
            i++;
        }

    });
}

function generateShipmentList2(tabValueVar, currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-shipment-all-individual.class.php", {
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

                //CONTENT TABLE TBODY TR 1
                var newContentTableTbodyTr1 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr1);

                var newContentTableTbodyTr1Td1 = document.createElement("td");
                newContentTableTbodyTr1Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr1Td1.innerHTML = "Client:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][18];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr2Td1.innerHTML = "Destination:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][9] + ', ' + jsonArray[i][8];
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr3Td1.innerHTML = "Date of Delivery:";
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

                var newContentTableTbodyTr3Td2 = document.createElement("td");
                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][4];
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

                //CONTENT TABLE TBODY TR 4
                var newContentTableTbodyTr4 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr4);

                var newContentTableTbodyTr4Td1 = document.createElement("td");
                newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr4Td1.innerHTML = "Vehicle Plate Number:";
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

                var newContentTableTbodyTr4Td2 = document.createElement("td");
                newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][12];
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.setAttribute("onclick", "redirectToShipmentProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][7] + "','" + jsonArray[i][8] + "','" + jsonArray[i][9] + "','" + jsonArray[i][10] + "','" + jsonArray[i][11] + "','" + jsonArray[i][12] + "','" + jsonArray[i][13] + "','" + jsonArray[i][14] + "','" + jsonArray[i][15] + "','" + jsonArray[i][18] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View";
                newCardFooterLink.classList.add('has-text-info');
                newCardFooter.appendChild(newCardFooterLink);
/*
                var newCardFooterLink2 = document.createElement("a");
                newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
                newCardFooterLink2.classList.add('has-text-danger');
                newCardFooter.appendChild(newCardFooterLink2);
*/
                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function generateShipmentList3(searchTerm) {
    $.post("./classes/load-shipment-individual.class.php", {}, function (data) {
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
function redirectToShipmentProfile(shipmentIdVar, shipmentNumberVar, shipmentStatusVar, shipmentDescriptionVar, dateOfDeliveryVar, callTimeVar, clientIdVar, areaNameVar, destinationVar, areaRateVar, vehicleTypeVar, plateNumberVar, commissionRateVar, driverIdVar, helperIdVar, clientNameVar) {
    $.post("./classes/set-shipment-session-variable.class.php", {
        shipmentId: shipmentIdVar,
        shipmentNumber: shipmentNumberVar,
        shipmentStatus: shipmentStatusVar,
        shipmentDescription: shipmentDescriptionVar,
        dateOfDelivery: dateOfDeliveryVar,
        callTime: callTimeVar,
        clientId: clientIdVar,
        areaName: areaNameVar,
        destination: destinationVar,
        areaRate: areaRateVar,
        vehicleType: vehicleTypeVar,
        plateNumber: plateNumberVar,
        commissionRate: commissionRateVar,
        driverId: driverIdVar,
        helperId: helperIdVar,
        clientName: clientNameVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "shipment-profile-individual.php";
    });
}

function refreshList() {
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateShipmentList1(tabValueHidden.innerHTML);

    //generateUserList2(1, selectSort.value);
}

function returntosender() {
    $.post("./test/test1.php", {

    }, function (data) {
        //var jsonArray = JSON.parse(data);
        alert(data);
    });
}

refreshList();
//generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);

//returntosender();
allTabLink.addEventListener('click', () => {
    inProgressTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    refreshList();
});

inProgressTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    inProgressTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "In-progress";
    refreshList();
});

completedTabLink.addEventListener('click', () => {
    inProgressTabLi.classList.remove('is-active');
    allTabLi.classList.remove('is-active');
    cancelledTabLi.classList.remove('is-active');

    completedTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Completed";
    refreshList();
});

cancelledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    completedTabLi.classList.remove('is-active');
    inProgressTabLi.classList.remove('is-active');

    cancelledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Cancelled";
    refreshList();
});


selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    refreshList();

});

searchBarInput.addEventListener('input', () => {
    generateShipmentList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        refreshList();

    }
});
