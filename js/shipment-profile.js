let shipmentTitleHidden = document.getElementById('shipmentTitleHidden');
let areaIdHidden = document.getElementById('areaIdHidden');
let vehicleIdHidden = document.getElementById('vehicleIdHidden');
let shipmentStatus = document.getElementById('shipmentStatus');
let indicatorHidden = document.getElementById('indicatorHidden');
let driverIdHidden = document.getElementById('driverIdHidden');
let helperIdHidden = document.getElementById('helperIdHidden');
let vehicleTypeHidden = document.getElementById('vehicleTypeHidden');
let driverSubtitle = document.getElementById('driverSubtitle');
let helperSubtitle = document.getElementById('helperSubtitle');
let driverSubtitle2 = document.getElementById('driverSubtitle2');
let helperSubtitle2 = document.getElementById('helperSubtitle2');
let plateNumberSubtitle = document.getElementById('plateNumberSubtitle');

let verticalContainerUl = document.getElementById('verticalContainerUl');

let shipmentPlacedId = document.getElementById('shipmentPlacedId');
let shipmentPickupId = document.getElementById('shipmentPickupId');
let shipmentDropoffId = document.getElementById('shipmentDropoffId');
let completedDeliveryId = document.getElementById('completedDeliveryId');

let progressbarId = document.getElementById('progressbarId');
let cancelModal = document.getElementById('cancelModal');
let cancelBtn = document.getElementById('cancelBtn');
let dropdownBtn = document.getElementById('dropdownBtn');
let dropdownElement = document.getElementById('dropdownElement');
let submitCancelForm = document.getElementById('submitCancelForm'); //save changes button

let shipmentStatusHidden = document.getElementById('shipmentStatusHidden');

let transferBtn = document.getElementById('transferBtn');
let transferModal = document.getElementById('transferModal');
let submitTransferForm = document.getElementById('submitTransferForm'); //save changes button
let vehicleTransfer = document.getElementById('vehicleTransfer');

let shipmentNumberHidden = document.getElementById('shipmentNumberHidden');
let shipmentDescriptionSubtitle = document.getElementById('shipmentDescriptionSubtitle');
let destinationSubtitle = document.getElementById('destinationSubtitle');
let dateOfDeliverySubtitle = document.getElementById('dateOfDeliverySubtitle');

let transferConfirmModal = document.getElementById('transferConfirmModal');
let confirmTransferForm = document.getElementById('confirmTransferForm'); //save changes button
let cancelTransferForm = document.getElementById('cancelTransferForm'); //save changes button

let shipmentTransferHeader = document.getElementById('shipmentTransferHeader');
let fromTransferHeader = document.getElementById('fromTransferHeader');
let toTransferHeader = document.getElementById('toTransferHeader');
let reasonTransferHeader = document.getElementById('reasonTransferHeader');

let cancelConfirmModal = document.getElementById('cancelConfirmModal');
let confirmCancelForm = document.getElementById('confirmCancelForm'); //save changes button
let cancelCancelForm = document.getElementById('cancelCancelForm'); //save changes button

let shipmentCancelHeader = document.getElementById('shipmentCancelHeader');
let vehicleCancelHeader = document.getElementById('vehicleCancelHeader');
let reasonCancelHeader = document.getElementById('reasonCancelHeader');

function myFunction1() {
    dropdownElement.classList.toggle("is-active");
}

dropdownBtn.addEventListener('click', myFunction1);

function myFunction2(x) {
    if (x.matches) { // If media query matches
        transferBtn.innerHTML = "<i class='fa-solid fa-truck-arrow-right'></i>"
        cancelBtn.innerHTML = "<i class='fa-solid fa-ban'></i>"
        returnBtn.innerHTML = "<i class='fa-solid fa-arrow-left'></i>"
    } else {
        transferBtn.innerHTML = "<i class='fa-solid fa-truck-arrow-right mr-3'></i> Transfer"
        cancelBtn.innerHTML = "<i class='fa-solid fa-ban mr-3'></i> Cancel"
        returnBtn.innerHTML = "<i class='fa-solid fa-arrow-left mr-3'></i> Return"
    }
}

var x = window.matchMedia("(max-width: 1000px)")
myFunction2(x) // Call listener function at run time
x.addEventListener('change', myFunction2);

//MODALS
function openCancel() {
    cancelModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
}

function closeCancel() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/
    othersCancellationReason.value = "";
    cancelModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

function openTransfer() {

    transferModal.classList.add('is-active');
    //populateSelect1();
    //populateUsernameAdd();
    //transferConfirmModal.classList.add('is-active');
}

function closeTransfer() {
    /*clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""*/
    transferModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

function openTransferConfirm() {
    if (vehicleTransfer.value != '') {
        for (var i = 0, length = transferReason.length; i < length; i++) {
            if (transferReason[i].checked) {
                // do whatever you want with the checked radio
                if (transferReason[i].value == "Others") {
                    //alert(othersCancellationReason.value);
                    //transferShipment2(othersTransferReason.value)
                    if (othersTransferReason.value != '') {
                        shipmentTransferHeader.innerHTML = "Transfer Shipment #" + shipmentNumberHidden.innerHTML;
                        fromTransferHeader.innerHTML = "From: " + vehicleIdHidden.innerHTML + " (" + vehicleTypeHidden.innerHTML + ")";
                        toTransferHeader.innerHTML = "To: " + vehicleTransfer.value + " (" + vehicleTypeHidden.innerHTML + ")";
                        reasonTransferHeader.innerHTML = othersTransferReason.value;
                        transferConfirmModal.classList.add('is-active');
                    }
                } else {
                    //alert(cancellationReason[i].value);
                    //transferShipment2(transferReason[i].value)
                    shipmentTransferHeader.innerHTML = "Transfer Shipment #" + shipmentNumberHidden.innerHTML;
                    fromTransferHeader.innerHTML = "From: " + vehicleIdHidden.innerHTML + " (" + vehicleTypeHidden.innerHTML + ")";
                    toTransferHeader.innerHTML = "To: " + vehicleTransfer.value + " (" + vehicleTypeHidden.innerHTML + ")";
                    reasonTransferHeader.innerHTML = transferReason[i].value;
                    transferConfirmModal.classList.add('is-active');
                }
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }
}

function closeTransferConfirm() {
    transferConfirmModal.classList.remove('is-active');
}

function openCancelConfirm() {
    for (var i = 0, length = cancellationReason.length; i < length; i++) {
        if (cancellationReason[i].checked) {
            // do whatever you want with the checked radio
            if (cancellationReason[i].value == "Others") {
                //alert(othersCancellationReason.value);
                if (othersCancellationReason.value != '') {
                    shipmentCancelHeader.innerHTML = "Cancel Shipment #" + shipmentNumberHidden.innerHTML;
                    vehicleCancelHeader.innerHTML = "Vehicle: " + vehicleIdHidden.innerHTML + " (" + vehicleTypeHidden.innerHTML + ")";
                    reasonCancelHeader.innerHTML = othersCancellationReason.value;
                    cancelConfirmModal.classList.add('is-active');
                }
            } else {
                //alert(cancellationReason[i].value);
                //cancelShipment2(cancellationReason[i].value)
                shipmentCancelHeader.innerHTML = "Cancel Shipment #" + shipmentNumberHidden.innerHTML;
                vehicleCancelHeader.innerHTML = "Vehicle: " + vehicleIdHidden.innerHTML + " (" + vehicleTypeHidden.innerHTML + ")";
                reasonCancelHeader.innerHTML = cancellationReason[i].value;
                cancelConfirmModal.classList.add('is-active');
            }


            // only one radio can be logically checked, don't check the rest
            break;
        }
    }
}

function closeCancelConfirm() {
    cancelConfirmModal.classList.remove('is-active');
}

var el = document.createElement('div');
el.classList.add('marker');
//el.innerHTML = "<h1 class='title is-6'><i class='fa-solid fa-truck fa-2xl'></i></h1>";
el.setAttribute("style", "background: url(green_marker.png) no-repeat center center fixed; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;");
//el.setAttribute("style", "background-color: #cccccc; height: 50px; background-position: center; background-repeat: no-repeat; background-size: cover;");
el.style.width = '60px';
el.style.height = '60px';

var map = new maplibregl.Map({
    container: 'map', // container id
    style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C', // style URL
    center: [121.261588, 14.295503], // starting position [lng, lat]
    zoom: 5 // starting zoom
});


var markerHeight = 40, markerRadius = 10, linearOffset = 25;

var popupOffsets = {
    'top': [0, 0],
    'top-left': [0, 0],
    'top-right': [0, 0],
    'bottom': [0, -markerHeight],
    'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'left': [markerRadius, (markerHeight - markerRadius) * -1],
    'right': [-markerRadius, (markerHeight - markerRadius) * -1]
};

var popupOffsets2 = {
    'top': [0, 0],
    'top-left': [0, 0],
    'top-right': [0, 0],
    'bottom': [0, -(markerHeight - 70)],
    'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'left': [markerRadius, (markerHeight - markerRadius) * -1],
    'right': [-markerRadius, (markerHeight - markerRadius) * -1]
};


var popup = new maplibregl.Popup({
    closeButton: true,
    closeOnClick: true,
    closeOnMove: true,
    offset: popupOffsets
});

/*
var popup2 = new maplibregl.Popup({
    closeButton: false,
    closeOnClick: false,
    closeOnMove: false,
    offset: popupOffsets2
});
*/

let lat, long, update_time, plate_number;

setInterval(generateLatestMarker2, 10000); // Time in milliseconds

/*
function testFunc(){
    alert("TEST");
}*/

generateLatestMarker();



map.on('click', function () {
    map.getCanvas().style.cursor = 'pointer';
    popup.setLngLat([long, lat]).setHTML("<h1 class='title is-6 p-1'><i class='fa-solid fa-clock mr-3'></i>" + "Last Update: </h1> <h1 class='subtitle is-6 p-1'>" + update_time + "</h1>").addTo(map);
});

/*
map.on('mouseout', function () {
    map.getCanvas().style.cursor = '';
    popup.remove();
});
*/

/*
var map = new maplibregl.Map({
    container: 'map', // container id
    style: 'https://api.maptiler.com/maps/streets/style.json?key=MROowlWHhkfBGNBrkA3C', // style URL
    center: [long, lat],
    zoom: 12
});
*/

function generateLatestMarker2() {
    $.post("./classes/load-tracker.class.php", {
        vehicleId: vehicleIdHidden.innerHTML,
        shipmentId: shipmentTitleHidden.innerHTML
    }, function (data) {
        //indicatorHidden.innerHTML = "Call Success";
        var jsonArray = JSON.parse(data);
        //alert(jsonArray[0][0]);

        var laguna = new maplibregl.Marker(el).setLngLat([jsonArray[0][0], jsonArray[0][1]]).addTo(map);

        lat = jsonArray[0][1];
        long = jsonArray[0][0];
        update_time = jsonArray[0][2];

        //popup2.setLngLat([long, lat]).setHTML("<h1 class='title is-6'>Plate #" + vehicleIdHidden.innerHTML + "</h1>").addTo(map);
        //var finalLength = Math.ceil(jsonArray.length / 4)
        //arrayLengthHidden.innerHTML = finalLength;

        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
        //driverSubtitle.innerHTML = "Driver: " + jsonArray[0][4];
        //helperSubtitle.innerHTML = "Helper: " + jsonArray[0][5];
        //plateNumberSubtitle.innerHTML = "Vehicle Plate Number: " + jsonArray[0][1];
    });
}

function generateLatestMarker() {
    $.post("./classes/load-tracker.class.php", {
        vehicleId: vehicleIdHidden.innerHTML,
        shipmentId: shipmentTitleHidden.innerHTML
    }, function (data) {
        //indicatorHidden.innerHTML = "Call Success";
        var jsonArray = JSON.parse(data);
        //alert(jsonArray[0][0]);

        var laguna = new maplibregl.Marker(el).setLngLat([jsonArray[0][0], jsonArray[0][1]]).addTo(map);

        lat = jsonArray[0][1];
        long = jsonArray[0][0];
        update_time = jsonArray[0][2];

        map.jumpTo({
            center: [long, lat],
            zoom: 15
        });

        //popup2.setLngLat([long, lat]).setHTML("<h1 class='title is-6'>Plate #" + vehicleIdHidden.innerHTML + "</h1>").addTo(map);

        //var finalLength = Math.ceil(jsonArray.length / 4)
        //arrayLengthHidden.innerHTML = finalLength;

        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
        //driverSubtitle.innerHTML = "Driver: " + jsonArray[0][4];
        //helperSubtitle.innerHTML = "Helper: " + jsonArray[0][5];
        //plateNumberSubtitle.innerHTML = "Vehicle Plate Number: " + jsonArray[0][1];
    });
}

function generateVehicleDetails() {
    $.post("./classes/load-vehicle-details.class.php", {
        driverId: driverIdHidden.innerHTML,
        helperId: helperIdHidden.innerHTML
    }, function (data) {
        //indicatorHidden.innerHTML = "Call Success";
        //alert(data);
        var jsonArray = JSON.parse(data);

        //var finalLength = Math.ceil(jsonArray.length / 4)
        //arrayLengthHidden.innerHTML = finalLength;

        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
        driverSubtitle.innerHTML = "Driver: " + jsonArray[0][0];
        helperSubtitle.innerHTML = "Helper: " + jsonArray[0][1];
        driverSubtitle2.innerHTML = jsonArray[0][0];
        helperSubtitle2.innerHTML = jsonArray[0][1];
        //plateNumberSubtitle.innerHTML = "Vehicle Plate Number: " + jsonArray[0][1];
    });
}

function generateProgressBarDetails() {
    $.post("./classes/load-progress-bar-details.class.php", {
        shipmentId: shipmentTitleHidden.innerHTML
    }, function (data) {
        indicatorHidden.innerHTML = "Call Success 2";
        var jsonArray = JSON.parse(data);

        //IN-PROGRESS
        if (jsonArray[0][3] == "In-progress") {

            //1
            var newLi1 = document.createElement("li");

            newLi1.setAttribute("style", "width: 25%");
            newLi1.classList.add('inProgressLi');
            //newLi1.classList.add('inProgressLiActive');

            var newLi1Paragraph = document.createElement("p");
            newLi1Paragraph.setAttribute("style", "color: black;");
            newLi1Paragraph.innerHTML = "Shipment Placed";
            newLi1.appendChild(newLi1Paragraph);
            progressbarId.appendChild(newLi1);

            //2
            var newLi2 = document.createElement("li");

            newLi2.setAttribute("style", "width: 25%");
            newLi2.classList.add('inProgressLi');
            //newLi2.classList.add('inProgressLiActive');

            var newLi2Paragraph = document.createElement("p");
            newLi2Paragraph.setAttribute("style", "color: black;");
            newLi2Paragraph.innerHTML = "Shipment Pickup";
            newLi2.appendChild(newLi2Paragraph);
            progressbarId.appendChild(newLi2);

            //3
            var newLi3 = document.createElement("li");

            newLi3.setAttribute("style", "width: 25%");
            newLi3.classList.add('inProgressLi');
            //newLi3.classList.add('inProgressLiActive');

            var newLi3Paragraph = document.createElement("p");
            newLi3Paragraph.setAttribute("style", "color: black;");
            newLi3Paragraph.innerHTML = "Shipment Dropoff";
            newLi3.appendChild(newLi3Paragraph);
            progressbarId.appendChild(newLi3);

            //4
            var newLi4 = document.createElement("li");

            newLi4.setAttribute("style", "width: 25%");
            newLi4.classList.add('inProgressLi');
            //newLi4.classList.add('inProgressLiActive');

            var newLi4Paragraph = document.createElement("p");
            newLi4Paragraph.setAttribute("style", "color: black;");
            newLi4Paragraph.innerHTML = "Delivery Completed";
            newLi4.appendChild(newLi4Paragraph);
            progressbarId.appendChild(newLi4);

            newLi1.classList.add('inProgressLiActive');

            for (var i = 0; i < jsonArray.length; i++) {

                if (jsonArray[i][1] == "Depart Warehouse") {
                    //newLi1.classList.add('inProgressLiActive');
                    newLi2.classList.add('inProgressLiActive');
                }

                if (jsonArray[i][1] == "Store Out") {
                    //newLi1.classList.add('inProgressLiActive');
                    newLi2.classList.add('inProgressLiActive');
                    newLi3.classList.add('inProgressLiActive');
                }

            }
        }

        //TRANSFERRED

        for (var i = 0; i < jsonArray.length; i++) {
            if (jsonArray[i][1].search('Transferred') != -1 && jsonArray[i][3] == "Cancelled") {
                //alert("Transferred");

                //5
                var newLi5 = document.createElement("li");


                newLi5.classList.add('transferLi');
                //newLi1.classList.add('inProgressLiActive');

                var newLi5Paragraph = document.createElement("p");
                newLi5Paragraph.setAttribute("style", "color: black;");
                newLi5Paragraph.innerHTML = "Shipment Placed";
                newLi5.appendChild(newLi5Paragraph);
                progressbarId.appendChild(newLi5);

                //6
                var newLi6 = document.createElement("li");


                newLi6.classList.add('transferLi');
                //newLi2.classList.add('inProgressLiActive');

                var newLi6Paragraph = document.createElement("p");
                newLi6Paragraph.setAttribute("style", "color: black;");
                newLi6Paragraph.innerHTML = "Shipment Pickup";
                newLi6.appendChild(newLi6Paragraph);
                //progressbarId.appendChild(newLi6);

                //7
                var newLi7 = document.createElement("li");


                newLi7.classList.add('transferLi');
                //newLi3.classList.add('inProgressLiActive');

                var newLi7Paragraph = document.createElement("p");
                newLi7Paragraph.setAttribute("style", "color: black;");
                newLi7Paragraph.innerHTML = "Shipment Dropoff";
                newLi7.appendChild(newLi7Paragraph);
                //progressbarId.appendChild(newLi7);

                //8
                var newLi8 = document.createElement("li");


                newLi8.classList.add('transferLi');
                //newLi4.classList.add('inProgressLiActive');

                var newLi8Paragraph = document.createElement("p");
                newLi8Paragraph.setAttribute("style", "color: black;");
                newLi8Paragraph.innerHTML = "Transferred";
                newLi8.appendChild(newLi8Paragraph);

                newLi5.classList.add('inProgressLiActive');

                var widthCounter = 2;

                for (var i = 0; i < jsonArray.length; i++) {

                    if (jsonArray[i][1] == "Depart Warehouse") {
                        progressbarId.appendChild(newLi6);
                        //newLi5.classList.add('inProgressLiActive');
                        newLi6.classList.add('inProgressLiActive');
                        widthCounter = widthCounter + 1;
                    }

                    if (jsonArray[i][1] == "Store Out") {
                        progressbarId.appendChild(newLi7);
                        //ewLi5.classList.add('inProgressLiActive');
                        newLi6.classList.add('inProgressLiActive');
                        newLi7.classList.add('inProgressLiActive');
                        widthCounter = widthCounter + 1;
                    }

                }

                progressbarId.appendChild(newLi8);
                newLi8.classList.add('transferLiActive');

                var finalWidth = 100 / widthCounter;

                newLi8.setAttribute("style", "width:" + finalWidth + "%");
                newLi7.setAttribute("style", "width:" + finalWidth + "%");
                newLi6.setAttribute("style", "width:" + finalWidth + "%");
                newLi5.setAttribute("style", "width:" + finalWidth + "%");

                //alert(widthCounter);

            }
        }

        //CANCELLED

        //for (var i = 0; i < jsonArray.length; i++) {

        if (jsonArray[jsonArray.length - 1][1].search('Transferred') == -1 && jsonArray[jsonArray.length - 1][3] == "Cancelled") {
            //alert("Transferred");

            //9
            var newLi9 = document.createElement("li");

            newLi9.setAttribute("style", "width: 25%");
            newLi9.classList.add('cancelLi');
            //newLi1.classList.add('inProgressLiActive');

            var newLi9Paragraph = document.createElement("p");
            newLi9Paragraph.setAttribute("style", "color: black;");
            newLi9Paragraph.innerHTML = "Shipment Placed";
            newLi9.appendChild(newLi9Paragraph);
            progressbarId.appendChild(newLi9);

            //10
            var newLi10 = document.createElement("li");

            newLi10.setAttribute("style", "width: 25%");
            newLi10.classList.add('cancelLi');
            //newLi2.classList.add('inProgressLiActive');

            var newLi10Paragraph = document.createElement("p");
            newLi10Paragraph.setAttribute("style", "color: black;");
            newLi10Paragraph.innerHTML = "Shipment Pickup";
            newLi10.appendChild(newLi10Paragraph);
            //progressbarId.appendChild(newLi6);

            //11
            var newLi11 = document.createElement("li");

            newLi11.setAttribute("style", "width: 25%");
            newLi11.classList.add('cancelLi');
            //newLi3.classList.add('inProgressLiActive');

            var newLi11Paragraph = document.createElement("p");
            newLi11Paragraph.setAttribute("style", "color: black;");
            newLi11Paragraph.innerHTML = "Shipment Dropoff";
            newLi11.appendChild(newLi11Paragraph);
            //progressbarId.appendChild(newLi7);

            //12
            var newLi12 = document.createElement("li");

            newLi12.setAttribute("style", "width: 25%");
            newLi12.classList.add('cancelLi');
            //newLi4.classList.add('inProgressLiActive');

            var newLi12Paragraph = document.createElement("p");
            newLi12Paragraph.setAttribute("style", "color: black;");
            newLi12Paragraph.innerHTML = "Cancelled";
            newLi12.appendChild(newLi12Paragraph);

            newLi9.classList.add('inProgressLiActive');

            var widthCounter = 2;
            for (var i = 0; i < jsonArray.length; i++) {

                if (jsonArray[i][1] == "Depart Warehouse") {
                    progressbarId.appendChild(newLi10);
                    //newLi5.classList.add('inProgressLiActive');
                    newLi10.classList.add('inProgressLiActive');
                    widthCounter = widthCounter + 1;
                }

                if (jsonArray[i][1] == "Store Out") {
                    progressbarId.appendChild(newLi11);
                    //ewLi5.classList.add('inProgressLiActive');
                    newLi10.classList.add('inProgressLiActive');
                    newLi11.classList.add('inProgressLiActive');
                    widthCounter = widthCounter + 1;
                }

            }

            progressbarId.appendChild(newLi12);
            newLi12.classList.add('cancelLiActive');

            var finalWidth = 100 / widthCounter;

            newLi9.setAttribute("style", "width:" + finalWidth + "%");
            newLi10.setAttribute("style", "width:" + finalWidth + "%");
            newLi11.setAttribute("style", "width:" + finalWidth + "%");
            newLi12.setAttribute("style", "width:" + finalWidth + "%");

        }
        //}

        //COMPLETED
        if (jsonArray[0][3] == "Completed") {
            //13
            var newLi13 = document.createElement("li");

            newLi13.setAttribute("style", "width: 25%");
            newLi13.classList.add('inProgressLi');
            //newLi1.classList.add('inProgressLiActive');

            var newLi13Paragraph = document.createElement("p");
            newLi13Paragraph.setAttribute("style", "color: black;");
            newLi13Paragraph.innerHTML = "Shipment Placed";
            newLi13.appendChild(newLi13Paragraph);
            progressbarId.appendChild(newLi13);

            //14
            var newLi14 = document.createElement("li");

            newLi14.setAttribute("style", "width: 25%");
            newLi14.classList.add('inProgressLi');
            //newLi2.classList.add('inProgressLiActive');

            var newLi14Paragraph = document.createElement("p");
            newLi14Paragraph.setAttribute("style", "color: black;");
            newLi14Paragraph.innerHTML = "Shipment Pickup";
            newLi14.appendChild(newLi14Paragraph);
            progressbarId.appendChild(newLi14);

            //15
            var newLi15 = document.createElement("li");

            newLi15.setAttribute("style", "width: 25%");
            newLi15.classList.add('inProgressLi');
            //newLi3.classList.add('inProgressLiActive');

            var newLi15Paragraph = document.createElement("p");
            newLi15Paragraph.setAttribute("style", "color: black;");
            newLi15Paragraph.innerHTML = "Shipment Dropoff";
            newLi15.appendChild(newLi15Paragraph);
            progressbarId.appendChild(newLi15);

            //16
            var newLi16 = document.createElement("li");

            newLi16.setAttribute("style", "width: 25%");
            newLi16.classList.add('inProgressLi');
            //newLi4.classList.add('inProgressLiActive');

            var newLi16Paragraph = document.createElement("p");
            newLi16Paragraph.setAttribute("style", "color: black;");
            newLi16Paragraph.innerHTML = "Delivery Completed";
            newLi16.appendChild(newLi16Paragraph);
            progressbarId.appendChild(newLi16);

            newLi13.classList.add('inProgressLiActive');
            newLi14.classList.add('inProgressLiActive');
            newLi15.classList.add('inProgressLiActive');
            newLi16.classList.add('inProgressLiActive');
        }

        for (var i = 0; i < jsonArray.length; i++) {

            var newLi = document.createElement("li");

            var newLiSpan = document.createElement("span");
            newLiSpan.innerHTML = jsonArray[i][2];
            newLi.appendChild(newLiSpan);

            var newLiDiv = document.createElement("div");
            newLiDiv.innerHTML = jsonArray[i][1];
            newLi.appendChild(newLiDiv);

            verticalContainerUl.appendChild(newLi);

        }

    });
}
var cancellationReason = document.getElementsByName('cancellationReason');
var othersCancellationReason = document.getElementById('othersCancellationReason');

function cancelShipment1() {

    for (var i = 0, length = cancellationReason.length; i < length; i++) {
        if (cancellationReason[i].checked) {
            // do whatever you want with the checked radio
            if (cancellationReason[i].value == "Others") {
                //alert(othersCancellationReason.value);
                cancelShipment2(othersCancellationReason.value)
            } else {
                //alert(cancellationReason[i].value);
                cancelShipment2(cancellationReason[i].value)
            }


            // only one radio can be logically checked, don't check the rest
            break;
        }
    }

};

function cancelShipment2(cancelReasonVar) {
    $.post("./classes/cancel-shipment-controller.class.php", {
        shipmentId: shipmentTitleHidden.innerHTML,
        cancelReason: cancelReasonVar
    }, function (data) {
        //indicatorHidden.innerHTML = "Call Success";
        //var jsonArray = JSON.parse(data);

        //var finalLength = Math.ceil(jsonArray.length / 4)
        //arrayLengthHidden.innerHTML = finalLength;
        //alert(data);
        addShipmentLog("Cancelled", "Shipment #" + shipmentNumberHidden.innerHTML);
        window.location.href = "shipment.php";
        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
    });
}

var transferReason = document.getElementsByName('transferReason');
var othersTransferReason = document.getElementById('othersTransferReason');

function transferShipment1() {

    for (var i = 0, length = transferReason.length; i < length; i++) {
        if (transferReason[i].checked) {
            // do whatever you want with the checked radio
            if (transferReason[i].value == "Others") {
                //alert(othersCancellationReason.value);
                transferShipment2(othersTransferReason.value)
            } else {
                //alert(cancellationReason[i].value);
                transferShipment2(transferReason[i].value)
            }


            // only one radio can be logically checked, don't check the rest
            break;
        }
    }

};

function transferShipment2(transferReasonVar) {
    $.post("./classes/transfer-shipment-controller.class.php", {
        shipmentId: shipmentTitleHidden.innerHTML,
        shipmentNumber: shipmentNumberHidden.innerHTML,
        vehicleId: vehicleTransfer.value,
        vehicleIdOld: vehicleIdHidden.innerHTML,
        transferReason: transferReasonVar
    }, function (data) {
        $("#submitTransferFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //refreshTable();
        addShipmentLog("Transferred", "Shipment #" + shipmentNumberHidden.innerHTML);
        window.location.href = "shipment.php";
        //closeTransfer(); 
        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
    });
}

function populateSelect3(typeVar) {
    $.post("./classes/load-vehicle-select2.class.php", {
        vehicleType: typeVar
    }, function (data) {
        //alert("call success");
        var jsonArray = JSON.parse(data);
        //alert(jsonArray[i][0]);
        for (var i = 0; i < jsonArray.length; i++) {
            //alert(jsonArray[i][0]);
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][1];
            newOption.innerHTML = "Plate Number: " + jsonArray[i][1] + " Driver: " + jsonArray[i][4];
            vehicleTransfer.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
}
/*
function transferShipment() {
    $.post("./classes/transfer-shipment-controller.class.php", {
        shipmentId: shipmentTitleHidden.innerHTML,
        shipmentNumber: shipmentNumberHidden.innerHTML,
        vehicleId: vehicleTransfer.value,
        vehicleIdOld: vehicleIdHidden.innerHTML
    }, function (data) {
        $("#submitTransferFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //refreshTable();
        addShipmentLog("Transferred", "Shipment #" + shipmentNumberHidden.innerHTML);
        window.location.href = "shipment.php";
        //closeTransfer();
    });
    //refreshTable();

}
*/
function addShipmentLog(logDescriptionVar, shipmentDescriptionVar) {
    $.post("./classes/add-log-controller.class.php", {
        logDescription: logDescriptionVar,
        moduleDescription: shipmentDescriptionVar
    }, function (data) {
        //alert(data);
    });
}


submitCancelForm.addEventListener('click', (e) => {
    //cancelShipment1();
    openCancelConfirm();
});

confirmCancelForm.addEventListener('click', (e) => {
    cancelShipment1();
    //openTransferConfirm();
    //alert('CONFIRM');
});

cancelCancelForm.addEventListener('click', (e) => {
    //transferShipment1();
    closeCancelConfirm();
});

returnBtn.addEventListener('click', () => {
    window.location.href = "shipment.php";
});

cancelBtn.addEventListener('click', () => {
    openCancel();
});

cancellationReason[0].addEventListener('change', () => {
    //alert("0");
    othersCancellationReason.value = "";
    othersCancellationReason.setAttribute("readonly", "true");
});

cancellationReason[1].addEventListener('change', () => {
    //alert("1");
    othersCancellationReason.value = "";
    othersCancellationReason.setAttribute("readonly", "true");
});

cancellationReason[2].addEventListener('change', () => {
    //alert("1");
    othersCancellationReason.value = "";
    othersCancellationReason.removeAttribute("readonly");
});

transferReason[0].addEventListener('change', () => {
    //alert("0");
    othersTransferReason.value = "";
    othersTransferReason.setAttribute("readonly", "true");
});

transferReason[1].addEventListener('change', () => {
    //alert("1");
    othersTransferReason.value = "";
    othersTransferReason.setAttribute("readonly", "true");
});

transferReason[2].addEventListener('change', () => {
    //alert("1");
    othersTransferReason.value = "";
    othersTransferReason.removeAttribute("readonly");
});

transferBtn.addEventListener('click', () => {
    openTransfer();
});

submitTransferForm.addEventListener('click', (e) => {
    //transferShipment1();
    openTransferConfirm();
});

confirmTransferForm.addEventListener('click', (e) => {
    transferShipment1();
    //openTransferConfirm();
    //alert('CONFIRM');
});

cancelTransferForm.addEventListener('click', (e) => {
    //transferShipment1();
    closeTransferConfirm();
});

if (shipmentStatusHidden.innerHTML != "In-progress") {
    transferBtn.classList.add('is-hidden');
    cancelBtn.classList.add('is-hidden');
};

generateVehicleDetails();
generateProgressBarDetails();
populateSelect3(vehicleTypeHidden.innerHTML);
/*

shipmentlog table

log_id
log_description
user_id (subcontractor_id or employee_id)
user_type (subcontractor or employee)



shipmentprogress

progress_id
progress_description (warehouse arrival, start loading, etc..) if start loading is accomplished then turn on a step progress bar circle
created_at
shipment_id / number

these two can be omitted if only subcontractors are allowed to update the progress of a shipment outside of a transfer or cancellation
user_id
user_type


depending on the shipment status you will generate a different step progress bar

In-progress = 4 steps

Completed = 4 steps

Cancelled = 2 steps

Transferred = 2 steps



use shipmentStatus session variable
generate a set of list items depending on the status (In-progress gets 4 items + custom ids + active class that would alter their styling)


should we generate updates and progress bar for cancelled / transferred shipment?

original personnel: old personnel

transferred to: new personnel

deleting shipment moves them to an archive before being permanently deleted 
*/