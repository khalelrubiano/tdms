let truckRateTD = document.getElementById('truckRateTD');
let dropFeeTD = document.getElementById('dropFeeTD');
let parkingFeeTD = document.getElementById('parkingFeeTD');
let tollFeeTD = document.getElementById('tollFeeTD');
let fuelChargeTD = document.getElementById('fuelChargeTD');
let extraHelperFeeTD = document.getElementById('extraHelperFeeTD');
let demurrageTD = document.getElementById('demurrageTD');
let otherChargesTD = document.getElementById('otherChargesTD');
let penaltyTD = document.getElementById('penaltyTD');
let shipmentIdHidden = document.getElementById('shipmentIdHidden');

let dropFeeAdd = document.getElementById('dropFeeAdd')
let parkingFeeAdd = document.getElementById('parkingFeeAdd')
let tollFeeAdd = document.getElementById('tollFeeAdd')
let fuelChargeAdd = document.getElementById('fuelChargeAdd')
let extraHelperFeeAdd = document.getElementById('extraHelperFeeAdd')
let demurrageAdd = document.getElementById('demurrageAdd')
let otherChargesAdd = document.getElementById('otherChargesAdd')
let penaltyAdd = document.getElementById('penaltyAdd')

let dropFeeAddHelp = document.getElementById('dropFeeAddHelp')
let parkingFeeAddHelp = document.getElementById('parkingFeeAddHelp')
let tollFeeAddHelp = document.getElementById('tollFeeAddHelp')
let fuelChargeAddHelp = document.getElementById('fuelChargeAddHelp')
let extraHelperFeeAddHelp = document.getElementById('extraHelperFeeAddHelp')
let demurrageAddHelp = document.getElementById('demurrageAddHelp')
let otherChargesAddHelp = document.getElementById('otherChargesAddHelp')
let penaltyAddHelp = document.getElementById('penaltyAddHelp')

const addModal = document.getElementById('addModal');

let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp');
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

function generateShipmentFees() {
    $.post("./classes/load-shipment-fees.class.php", {
        shipmentId: shipmentIdHidden.innerHTML
    }, function (data) {
        var jsonArray = JSON.parse(data);
        //alert(data);

        truckRateTD.innerHTML = jsonArray[0][0];
        dropFeeTD.innerHTML = jsonArray[0][1];
        parkingFeeTD.innerHTML = jsonArray[0][2];
        tollFeeTD.innerHTML = jsonArray[0][3];
        fuelChargeTD.innerHTML = jsonArray[0][4];
        extraHelperFeeTD.innerHTML = jsonArray[0][5];
        demurrageTD.innerHTML = jsonArray[0][6];
        otherChargesTD.innerHTML = jsonArray[0][7];
        penaltyTD.innerHTML = jsonArray[0][8];
    });
}

//ADD AJAX CALLS WITH VALIDATION

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only

function addAjax() {
    $.post("./classes/edit-shipment-fees-controller.class.php", {
        shipmentId: shipmentIdHidden.innerHTML,
        dropFeeAdd: dropFeeAdd.value,
        parkingFeeAdd: parkingFeeAdd.value,
        tollFeeAdd: tollFeeAdd.value,
        fuelChargeAdd: fuelChargeAdd.value,
        extraHelperFeeAdd: extraHelperFeeAdd.value,
        demurrageAdd: demurrageAdd.value,
        otherChargesAdd: otherChargesAdd.value,
        penaltyAdd: penaltyAdd.value
    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //refreshTable();
        //refreshList();
        closeAdd();
        generateShipmentFees();
    });
    //refreshTable();

}

submitAddForm.addEventListener('click', (e) => {
    clearAddFormHelp();

    let dropFeeAddMessages = [];
    let parkingFeeAddMessages = [];
    let demurrageAddMessages = [];
    let otherChargesAddMessages = [];
    let penaltyAddMessages = [];

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


function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    dropFeeAdd.className = "input is-rounded"
    dropFeeAddHelp.className = "help"
    dropFeeAddHelp.innerText = ""

    parkingFeeAdd.className = "input is-rounded"
    parkingFeeAddHelp.className = "help"
    parkingFeeAddHelp.innerText = ""

    demurrageAdd.className = "input is-rounded"
    demurrageAddHelp.className = "help"
    demurrageAddHelp.innerText = ""

    otherChargesAdd.className = "input is-rounded"
    otherChargesAddHelp.className = "help"
    otherChargesAddHelp.innerText = ""

    penaltyAdd.className = "input is-rounded"
    penaltyAddHelp.className = "help"
    penaltyAddHelp.innerText = ""
}

function clearAddFormInput() {
    dropFeeAdd.value = null;
    parkingFeeAdd.value = null;
    demurrageAdd.value = null;
    otherChargesAdd.value = null;
    penaltyAdd.value = null;
}

generateShipmentFees();

returnBtn.addEventListener('click', () => {
    window.location.href = "shipment.php";
});