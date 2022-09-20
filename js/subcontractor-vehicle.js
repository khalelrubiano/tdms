let allTabLink = document.getElementById('allTabLink');
let availableTabLink = document.getElementById('availableTabLink');
let onDeliveryTabLink = document.getElementById('onDeliveryTabLink');
let unavailableTabLink = document.getElementById('unavailableTabLink');

let allTabLi = document.getElementById('allTabLi');
let availableTabLi = document.getElementById('availableTabLi');
let onDeliveryTabLi = document.getElementById('onDeliveryTabLi');
let unavailableTabLi = document.getElementById('unavailableTabLi');

const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;

let tabValueHidden = document.getElementById('tabValueHidden')
let vehicleIdHidden = document.getElementById('vehicleIdHidden')
/*

POST A THIRD VARIABLE TO THE LOAD SHIPMENT ALL FILE THAT DETERMINES WHETHER THE SQL QUERY RETURNS ALL / IN-PROGRESS / COMPLETED/ CANCELLED, USE CUSTOM FUNCTIONS FOR EACH TAB CATEGORY

Vehicle1 arrived at pick-up location
Vehicle1 started loading the goods
Vehicle1 departed from the pick-up location

etc...
*/
//MODALS
function openAdd(vehicleIdVar) {
    addModal.classList.add('is-active');
    vehicleIdHidden.innerHTML = vehicleIdVar;
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

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-tracker-controller.class.php", {
            trackerIdDelete: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            refreshList();
        });
    }
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button

let trackerIdAdd = document.getElementById('trackerIdAdd');
let trackerIdAddHelp = document.getElementById('trackerIdAddHelp');

function addAjax() {
    $.post("./classes/add-tracker-controller.class.php", {
        trackerId: trackerIdAdd.value,
        vehicleId: vehicleIdHidden.innerHTML

    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //addModal.classList.remove('is-active');
        closeAdd();
        refreshList();
    });
}

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

submitAddForm.addEventListener('click', (e) => {
    //clearAddFormHelp();
    //clearAddFormInput();

    let trackerIdAddMessages = []

    //Username Validation

    if (pattern1.test(trackerIdAdd.value) == false) {
        trackerIdAdd.className = "input is-danger is-rounded"
        trackerIdAddHelp.className = "help is-danger"
        trackerIdAddMessages.push('Tracker ID should only consist of numbers, letters!')
    }

    if (trackerIdAdd.value === "" || trackerIdAdd.value == null) {
        trackerIdAdd.className = "input is-danger is-rounded"
        trackerIdAddHelp.className = "help is-danger"
        trackerIdAddMessages.push('Tracker ID is required!')
    }

    if (trackerIdAdd.value.length >= 255) {
        trackerIdAdd.className = "input is-danger is-rounded"
        trackerIdAddHelp.className = "help is-danger"
        trackerIdAddMessages.push('Tracker ID must be less than 255 characters!')
    }

    //Messages
    if (trackerIdAddMessages.length > 0) {
        e.preventDefault()
        trackerIdAddHelp.innerText = trackerIdAddMessages.join(', ');
    }

    if (
        trackerIdAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    trackerIdAdd.className = "input is-rounded"
    trackerIdAddHelp.className = "help"
    trackerIdAddHelp.innerText = ""
}

function clearAddFormInput() {
    trackerIdAdd.value = null;

}

//VEHICLE LIST
function generateVehicleList1(tabValueVar) {
    $.post("./classes/load-vehicle-availability-all.class.php", {
        tabValue: tabValueVar
    }, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;

        let i = 1;
        while (i <= finalLength) {
            generateVehicleList2(tabValueVar, i, selectSort.value, finalLength);
            i++;
        }

    });
}

function generateVehicleList2(tabValueVar, currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-vehicle-availability.class.php", {
        tabValue: tabValueVar,
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);
        indicator.innerHTML = "call success";
        if (currentPageNumber <= finalLengthVar) {
            indicator.innerHTML = "condition success";

            var newParentTile = document.createElement("div");
            newParentTile.classList.add('tile');
            newParentTile.classList.add('is-parent');
            ancestorTile.appendChild(newParentTile);

            for (var i = 0; i < jsonArray.length; i++) {

                var newChildTile = document.createElement("div");
                newChildTile.classList.add('tile');
                newChildTile.classList.add('is-child');
                newChildTile.classList.add('p-2');
                newChildTile.classList.add('is-3');

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
                switch (jsonArray[i][3]) {
                    case "Available":
                        newCardHeaderParagraph.classList.add('has-text-primary');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3'></i>" + jsonArray[i][3];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "Unavailable":
                        newCardHeaderParagraph.classList.add('has-text-danger');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-danger'></i>" + jsonArray[i][3];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "On-Delivery":
                        newCardHeaderParagraph.classList.add('has-text-warning');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-warning'></i>" + jsonArray[i][3];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;

                }
                /*
                                var newCardHeaderLabel = document.createElement("label");
                                newCardHeaderLabel.classList.add('card-header-icon');
                                newCardHeaderLabel.classList.add('switch');
                                newCardHeader.appendChild(newCardHeaderLabel);
                
                                var newCardHeaderLabelInput = document.createElement("input");
                                newCardHeaderLabelInput.setAttribute("type", "checkbox");
                                newCardHeaderLabelInput.setAttribute("onchange", "vehicleStatusUpdate1('" + jsonArray[i][0] + "','" + jsonArray[i][3] + "')");
                
                                switch (jsonArray[i][3]) {
                                    case "Available":
                                        newCardHeaderLabelInput.setAttribute("checked", "true");
                                        break;
                                    case "Unavailable":
                                        //newCardHeaderLabelInput.setAttribute("checked", "true");
                                        break;
                
                                }
                
                                //newCardHeaderLabelInput.setAttribute("checked", "true");
                                newCardHeaderLabel.appendChild(newCardHeaderLabelInput);
                
                                var newCardHeaderLabelInputSpan = document.createElement("span");
                                newCardHeaderLabelInputSpan.classList.add('slider');
                                newCardHeaderLabelInputSpan.classList.add('round');
                                newCardHeaderLabel.appendChild(newCardHeaderLabelInputSpan);
                                
                                                //CARD HEADER BUTTON
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
                newContent.appendChild(newContentParagraph);

                //CONTENT PARAGRAPH ICON
                var newContentParagraphIcon = document.createElement("i");
                newContentParagraphIcon.classList.add('fa-solid');
                newContentParagraphIcon.classList.add('fa-truck');
                newContentParagraphIcon.classList.add('fa-2x');
                newContentParagraph.appendChild(newContentParagraphIcon);

                if (jsonArray[i][3] == "Unavailable") {
                    //CONTENT PARAGRAPH
                    var newContentParagraph2 = document.createElement("p");
                    newContentParagraph2.classList.add('title');
                    newContentParagraph2.classList.add('is-5');
                    newContentParagraph2.classList.add('mb-5');
                    newContentParagraph2.classList.add('has-text-danger');
                    newContentParagraph2.classList.add('has-text-centered');
                    newContentParagraph2.innerHTML = jsonArray[i][9];
                    newContent.appendChild(newContentParagraph2);
                }

                //CONTENT TABLE
                var newContentTable = document.createElement("table");
                //newContentTable.setAttribute("style", "height: 100%;");
                newContentTable.classList.add('table');
                newContentTable.classList.add('is-bordered');
                newContent.appendChild(newContentTable);

                //CONTENT TABLE TBODY
                var newContentTableTbody = document.createElement("tbody");
                //newContentTableTbody.setAttribute("style", "height: 100%;");
                newContentTable.appendChild(newContentTableTbody);

                //CONTENT TABLE TBODY TR 1
                var newContentTableTbodyTr1 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr1);

                var newContentTableTbodyTr1Td1 = document.createElement("td");
                newContentTableTbodyTr1Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr1Td1.classList.add('leftTd');
                newContentTableTbodyTr1Td1.innerHTML = "Plate Number:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][1];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

                //CONTENT TABLE TBODY TR 5
                var newContentTableTbodyTr5 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr5);

                var newContentTableTbodyTr5Td1 = document.createElement("td");
                newContentTableTbodyTr5Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr5Td1.innerHTML = "Vehicle Type:";
                newContentTableTbodyTr5.appendChild(newContentTableTbodyTr5Td1);

                var newContentTableTbodyTr5Td2 = document.createElement("td");
                newContentTableTbodyTr5Td2.innerHTML = jsonArray[i][8];
                newContentTableTbodyTr5.appendChild(newContentTableTbodyTr5Td2);

                /*
                                //CONTENT TABLE TBODY TR 2
                                var newContentTableTbodyTr2 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr2);
                
                                var newContentTableTbodyTr2Td1 = document.createElement("td");
                                newContentTableTbodyTr2Td1.innerHTML = "Commission Rate:";
                                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);
                
                                var newContentTableTbodyTr2Td2 = document.createElement("td");
                                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][2] + "%";
                                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);
                */
                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr3Td1.classList.add('leftTd');
                newContentTableTbodyTr3Td1.innerHTML = "Driver:";
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

                var newContentTableTbodyTr3Td2 = document.createElement("td");
                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][4];
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

                //CONTENT TABLE TBODY TR 4
                var newContentTableTbodyTr4 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr4);

                var newContentTableTbodyTr4Td1 = document.createElement("td");
                newContentTableTbodyTr4Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr4Td1.classList.add('leftTd');
                newContentTableTbodyTr4Td1.innerHTML = "Helper:";
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

                var newContentTableTbodyTr4Td2 = document.createElement("td");
                newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][5];
                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);


                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                //newCardFooterLink.setAttribute("onclick", "openEdit('" + jsonArray[i][0] + "')");


                switch (jsonArray[i][6] == null) {
                    case true:
                        newCardFooterLink.setAttribute("onclick", "openAdd('" + jsonArray[i][0] + "')");
                        newCardFooterLink.classList.add('card-footer-item');
                        newCardFooterLink.innerHTML = "<i class='fa-solid fa-plus p-1 mr-1'></i> Add Tracker";
                        newCardFooterLink.classList.add('has-text-info');
                        newCardFooter.appendChild(newCardFooterLink);
                        break;

                    case false:
                        newCardFooterLink.setAttribute("onclick", "deleteAjax('" + jsonArray[i][6] + "')");
                        newCardFooterLink.classList.add('card-footer-item');
                        newCardFooterLink.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Remove Tracker #" + jsonArray[i][7];
                        newCardFooterLink.classList.add('has-text-danger');
                        newCardFooter.appendChild(newCardFooterLink);
                        break;

                }

                /*
                var newCardFooterLink2 = document.createElement("a");
                //newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "Remove Tracker";
                newCardFooter.appendChild(newCardFooterLink2);
*/
                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}
/*
function generateVehicleList3(searchTerm) {
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

function generateVehicleList4(shipmentIdVar, shipmentNumberVar, shipmentStatusVar, shipmentDescriptionVar, destinationVar, dateOfDeliveryVar, clientNameVar, plateNumberVar, vehicleIdVar, areaIdVar) {
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
    
    var newContentParagraphIcon = document.createElement("i");
    newContentParagraphIcon.classList.add('fa-solid');
    newContentParagraphIcon.classList.add('fa-hashtag');
    newContentParagraphIcon.classList.add('fa-2x');
    newContentParagraph.appendChild(newContentParagraphIcon);

    //CONTENT TABLE
    var newContentTable = document.createElement("table");
    newContentTable.classList.add('table');
    newContentTable.classList.add('is-bordered');
    newContent.appendChild(newContentTable);

    //CONTENT TABLE TBODY
    var newContentTableTbody = document.createElement("tbody");
    newContentTable.appendChild(newContentTableTbody);

    CONTENT TABLE TBODY TR 1
    var newContentTableTbodyTr1 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr1);

    var newContentTableTbodyTr1Td1 = document.createElement("td");
    newContentTableTbodyTr1Td1.innerHTML = "Starting Point:";
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

    var newContentTableTbodyTr1Td2 = document.createElement("td");
    newContentTableTbodyTr1Td2.innerHTML = shipmentDescriptionVar;
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

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
    
                    var newCardFooterLink2 = document.createElement("a");
                    newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                    newCardFooterLink2.classList.add('card-footer-item');
                    newCardFooterLink2.innerHTML = "Manage Tracker";
                    newCardFooter.appendChild(newCardFooterLink2);
    
    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}
*/

refreshList();
//generateVehicleList1(tabValueHidden.innerHTML);
//generateVehicleList2(tabValueHidden.innerHTML, 1, selectSort.value);

function refreshList() {
    ancestorTile.innerHTML = "";
    //currentPageNumber = 1;
    generateVehicleList1(tabValueHidden.innerHTML);
}

allTabLink.addEventListener('click', () => {
    availableTabLi.classList.remove('is-active');
    onDeliveryTabLi.classList.remove('is-active');
    unavailableTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();

});

availableTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    onDeliveryTabLi.classList.remove('is-active');
    unavailableTabLi.classList.remove('is-active');

    availableTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Available";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();
});

onDeliveryTabLink.addEventListener('click', () => {
    availableTabLi.classList.remove('is-active');
    allTabLi.classList.remove('is-active');
    unavailableTabLi.classList.remove('is-active');

    onDeliveryTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "On-Delivery";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();
});

unavailableTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    availableTabLi.classList.remove('is-active');
    onDeliveryTabLi.classList.remove('is-active');

    unavailableTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Unavailable";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();

});

/*
searchBarInput.addEventListener('input', () => {
    generateShipmentList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        refreshList();

    }
});


POST A THIRD VARIABLE TO THE LOAD SHIPMENT ALL FILE THAT DETERMINES WHETHER THE SQL QUERY RETURNS ALL / IN-PROGRESS / COMPLETED/ CANCELLED, USE CUSTOM FUNCTIONS FOR EACH TAB CATEGORY

*/