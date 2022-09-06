let shipmentNumber = document.getElementById('shipmentNumber');
let submitBtn = document.getElementById('submitBtn');


function getData() {
    $.post("./classes/load-client-tracking.class.php", {
        shipmentNumber: shipmentNumber.value
    }, function (data) {
        var jsonArray = JSON.parse(data);
        //alert(jsonArray[0][0]);
        redirectToShipmentProfile(jsonArray[0][0], jsonArray[0][1], jsonArray[0][2], jsonArray[0][3], jsonArray[0][4], jsonArray[0][5], jsonArray[0][6], jsonArray[0][7], jsonArray[0][8], jsonArray[0][9])
    });
}



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
        window.location.href = "client-tracking-profile.php";
    });
}

submitBtn.addEventListener('click', () => {
    getData();
});

//newCardFooterLink.setAttribute("onclick", "redirectToShipmentProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][6] + "','" + jsonArray[i][7] + "','" + jsonArray[i][8] + "','" + jsonArray[i][9] + "')");