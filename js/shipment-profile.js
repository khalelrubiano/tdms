let shipmentTitleHidden = document.getElementById('shipmentTitleHidden');
let areaIdHidden = document.getElementById('areaIdHidden');
let vehicleIdHidden = document.getElementById('vehicleIdHidden');
let shipmentStatus = document.getElementById('shipmentStatus');
let indicatorHidden = document.getElementById('indicatorHidden');

let driverSubtitle = document.getElementById('driverSubtitle');
let helperSubtitle = document.getElementById('helperSubtitle');
let plateNumberSubtitle = document.getElementById('plateNumberSubtitle');

let verticalContainerUl = document.getElementById('verticalContainerUl');

let shipmentPlacedId = document.getElementById('shipmentPlacedId');
let shipmentPickupId = document.getElementById('shipmentPickupId');
let shipmentDropoffId = document.getElementById('shipmentDropoffId');
let completedDeliveryId = document.getElementById('completedDeliveryId');

function generateVehicleDetails() {
    $.post("./classes/load-vehicle-details.class.php", {
        vehicleId: vehicleIdHidden.innerHTML
    }, function (data) {
        //indicatorHidden.innerHTML = "Call Success";
        var jsonArray = JSON.parse(data);

        //var finalLength = Math.ceil(jsonArray.length / 4)
        //arrayLengthHidden.innerHTML = finalLength;

        //indicatorHidden.innerHTML = jsonArray[0][0] + " " + jsonArray[0][1] + " " + jsonArray[0][2] + " " + jsonArray[0][3] + " " + jsonArray[0][4] + " " + jsonArray[0][5];
        driverSubtitle.innerHTML = "Driver: " + jsonArray[0][4];
        helperSubtitle.innerHTML = "Helper: " + jsonArray[0][5];
        plateNumberSubtitle.innerHTML = "Vehicle Plate Number: " + jsonArray[0][1];
    });
}

function generateProgressBarDetails() {
    $.post("./classes/load-progress-bar-details.class.php", {
        shipmentId: shipmentTitleHidden.innerHTML
    }, function (data) {
        indicatorHidden.innerHTML = "Call Success 2";
        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {

            var newLi = document.createElement("li");

            var newLiSpan = document.createElement("span");
            newLiSpan.innerHTML = jsonArray[i][2];
            newLi.appendChild(newLiSpan);

            var newLiDiv = document.createElement("div");
            newLiDiv.innerHTML = jsonArray[i][1];
            newLi.appendChild(newLiDiv);

            verticalContainerUl.appendChild(newLi);

            if(jsonArray[i][1] == "Depart Warehouse"){
                shipmentPickupId.classList.add('active');
            }
        }
        
    });
}

generateVehicleDetails();
generateProgressBarDetails();
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