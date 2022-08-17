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

//let logList = document.getElementById('logList')

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

//ADD AJAX CALLS WITH VALIDATION

var pattern1 = /^[a-zA-Z0-9]+$/ //Alphanumeric
var pattern2 = /^[a-zA-Z0-9\s]+$/ //Alphanumeric whitespace
var pattern4 = /^[0-9]+$/ //Numbers only

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
        //addShipmentLog("Added", "Shipment #" + shipmentNumberAdd.value);
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

populateSelect1();

allTabLink.addEventListener('click', () => {
    settledTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    allTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "All";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

settledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    unsettledTabLi.classList.remove('is-active');

    settledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Settled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});

unsettledTabLink.addEventListener('click', () => {
    allTabLi.classList.remove('is-active');
    settledTabLi.classList.remove('is-active');

    unsettledTabLi.classList.add('is-active');

    tabValueHidden.innerHTML = "Unsettled";
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    //generateShipmentList2(tabValueHidden.innerHTML, 1, selectSort.value);
});