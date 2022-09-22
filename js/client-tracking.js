let shipmentNumber = document.getElementById('shipmentNumber');
let submitBtn = document.getElementById('submitBtn');


function getData() {
    $.post("./classes/load-client-tracking.class.php", {
        shipmentNumber: shipmentNumber.value
    }, function (data) {
        var jsonArray = JSON.parse(data);
        //alert(data);
        //alert(jsonArray[0][0]);
        redirectToShipmentProfile(jsonArray[0][0], jsonArray[0][1], jsonArray[0][2], jsonArray[0][3], jsonArray[0][4], jsonArray[0][5], jsonArray[0][7], jsonArray[0][8], jsonArray[0][9], jsonArray[0][10], jsonArray[0][11], jsonArray[0][12], jsonArray[0][13], jsonArray[0][14], jsonArray[0][15], jsonArray[0][18]);
    });
}

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
        window.location.href = "client-tracking-profile.php";
    });
}

submitBtn.addEventListener('click', () => {
    getData();
});

//newCardFooterLink.setAttribute("onclick", "redirectToShipmentProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][6] + "','" + jsonArray[i][7] + "','" + jsonArray[i][8] + "','" + jsonArray[i][9] + "')");