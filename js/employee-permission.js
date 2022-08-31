const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')

let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button
let roleNameAdd = document.getElementById('roleNameAdd');
let roleNameAddHelp = document.getElementById('roleNameAddHelp');
let shipmentAccessAdd = document.getElementById('shipmentAccessAdd');
let employeeAccessAdd = document.getElementById('employeeAccessAdd');
let subcontractorAccessAdd = document.getElementById('subcontractorAccessAdd');
let clientAccessAdd = document.getElementById('clientAccessAdd');
let billingAccessAdd = document.getElementById('billingAccessAdd');
let payrollAccessAdd = document.getElementById('payrollAccessAdd');

let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button
let roleNameEdit = document.getElementById('roleNameEdit');
let roleNameEditHelp = document.getElementById('roleNameEditHelp');
let shipmentAccessEdit = document.getElementById('shipmentAccessEdit');
let employeeAccessEdit = document.getElementById('employeeAccessEdit');
let subcontractorAccessEdit = document.getElementById('subcontractorAccessEdit');
let clientAccessEdit = document.getElementById('clientAccessEdit');
let billingAccessEdit = document.getElementById('billingAccessEdit');
let payrollAccessEdit = document.getElementById('payrollAccessEdit');
let editModalTitle = document.getElementById('editModalTitle');

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
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

function openEdit(var1, var2) {
    editModalTitle.innerHTML = var2;
    roleNameEdit.value = var1;
    editModal.classList.add('is-active');
    //populateUsernameEdit();
}

function closeEdit() {

    //clearEditFormHelp();
    clearEditFormInput();

    submitEditFormHelp.className = "help"
    submitEditFormHelp.innerText = ""

    editModal.classList.remove('is-active');

    //removeSelectEdit(document.getElementById('usernameEdit'));
}

function generateEmployeeListTable1() {
    $.post("./classes/load-permission.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 5); //1 is the number of results per page

        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}


function generateEmployeeListTable2(currentPageNumberVar) {
    $.post("./classes/load-permission-pagination.class.php", {
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        tableTbody.innerHTML = "";


        for (var i = 0; i < jsonArray.length; i++) {
            //console.log(jsonArray[i][1]);

            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");
            
            var newTableData2 = document.createElement("td");
            
            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");
            
            var newTableData5 = document.createElement("td");
            var newTableData6 = document.createElement("td");
            var newTableData7 = document.createElement("td");
            

            var newTableData8 = document.createElement("td");


            //EDIT BUTTON
            var newEditBtn = document.createElement("button");
            newEditBtn.classList.add('button');
            newEditBtn.classList.add('mr-3');
            newEditBtn.setAttribute("onclick", "openEdit('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
            var newEditBtnIcon = document.createElement("i");
            newEditBtnIcon.classList.add('fa-solid');
            newEditBtnIcon.classList.add('fa-pen-to-square');
            newEditBtn.appendChild(newEditBtnIcon);

            //DELETE BUTTON
            var newDeleteBtn = document.createElement("button");
            newDeleteBtn.classList.add('button');
            newDeleteBtn.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "')");
            var newDeleteBtnIcon = document.createElement("i");
            newDeleteBtnIcon.classList.add('fa-solid');
            newDeleteBtnIcon.classList.add('fa-trash-can');
            newDeleteBtn.appendChild(newDeleteBtnIcon);


            newTableData8.appendChild(newEditBtn);
            newTableData8.appendChild(newDeleteBtn);

            newTableData1.setAttribute("data-label", "Role");
            
            newTableData2.setAttribute("data-label", "Shipment Access");
            
            newTableData3.setAttribute("data-label", "Employee Access");
            newTableData4.setAttribute("data-label", "Subcontractor Access");
            newTableData5.setAttribute("data-label", "Client Access");
            newTableData6.setAttribute("data-label", "Billing Access");
            newTableData7.setAttribute("data-label", "Payroll Access");
            
            newTableData8.setAttribute("data-label", "");

            //SHIPMENT ACCESS
            if (jsonArray[i][2] == "true") {
                var newShipmentAccessIcon = document.createElement("i");
                newShipmentAccessIcon.classList.add('fa-solid');
                newShipmentAccessIcon.classList.add('fa-check');
                newTableData2.appendChild(newShipmentAccessIcon);
            } else {
                var newShipmentAccessIcon = document.createElement("i");
                newShipmentAccessIcon.classList.add('fa-solid');
                newShipmentAccessIcon.classList.add('fa-xmark');
                newTableData2.appendChild(newShipmentAccessIcon);
            }

            //EMPLOYEE ACCESS
            if (jsonArray[i][3] == "true") {
                var newEmployeeAccessIcon = document.createElement("i");
                newEmployeeAccessIcon.classList.add('fa-solid');
                newEmployeeAccessIcon.classList.add('fa-check');
                newTableData3.appendChild(newEmployeeAccessIcon);
            } else {
                var newEmployeeAccessIcon = document.createElement("i");
                newEmployeeAccessIcon.classList.add('fa-solid');
                newEmployeeAccessIcon.classList.add('fa-xmark');
                newTableData3.appendChild(newEmployeeAccessIcon);
            }

            //SUBCONTRACTOR ACCESS
            if (jsonArray[i][4] == "true") {
                var newSubcontractorAccessIcon = document.createElement("i");
                newSubcontractorAccessIcon.classList.add('fa-solid');
                newSubcontractorAccessIcon.classList.add('fa-check');
                newTableData4.appendChild(newSubcontractorAccessIcon);
            } else {
                var newSubcontractorAccessIcon = document.createElement("i");
                newSubcontractorAccessIcon.classList.add('fa-solid');
                newSubcontractorAccessIcon.classList.add('fa-xmark');
                newTableData4.appendChild(newSubcontractorAccessIcon);
            }

            //CLIENT ACCESS
            if (jsonArray[i][5] == "true") {
                var newClientAccessIcon = document.createElement("i");
                newClientAccessIcon.classList.add('fa-solid');
                newClientAccessIcon.classList.add('fa-check');
                newTableData5.appendChild(newClientAccessIcon);
            } else {
                var newClientAccessIcon = document.createElement("i");
                newClientAccessIcon.classList.add('fa-solid');
                newClientAccessIcon.classList.add('fa-xmark');
                newTableData5.appendChild(newClientAccessIcon);
            }

            //BILLING ACCESS
            if (jsonArray[i][6] == "true") {
                var newBillingAccessIcon = document.createElement("i");
                newBillingAccessIcon.classList.add('fa-solid');
                newBillingAccessIcon.classList.add('fa-check');
                newTableData6.appendChild(newBillingAccessIcon);
            } else {
                var newBillingAccessIcon = document.createElement("i");
                newBillingAccessIcon.classList.add('fa-solid');
                newBillingAccessIcon.classList.add('fa-xmark');
                newTableData6.appendChild(newBillingAccessIcon);
            }

            //PAYROLL ACCESS
            if (jsonArray[i][7] == "true") {
                var newPayrollAccessIcon = document.createElement("i");
                newPayrollAccessIcon.classList.add('fa-solid');
                newPayrollAccessIcon.classList.add('fa-check');
                newTableData7.appendChild(newPayrollAccessIcon);
            } else {
                var newPayrollAccessIcon = document.createElement("i");
                newPayrollAccessIcon.classList.add('fa-solid');
                newPayrollAccessIcon.classList.add('fa-xmark');
                newTableData7.appendChild(newPayrollAccessIcon);
            }

            newTableData1.innerHTML = jsonArray[i][1];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);
            newTableRow.appendChild(newTableData5);
            newTableRow.appendChild(newTableData6);
            newTableRow.appendChild(newTableData7);
            newTableRow.appendChild(newTableData8);
            

        }
    });
}

function addAjax(roleNameAddVar, shipmentAccessAddVar, employeeAccessAddVar, subcontractorAccessAddVar, clientAccessAddVar, billingAccessAddVar, payrollAccessAddVar) {
    $.post("./classes/add-permission-controller.class.php", {
        roleNameAdd: roleNameAddVar,
        shipmentAccessAdd: shipmentAccessAddVar,
        employeeAccessAdd: employeeAccessAddVar,
        subcontractorAccessAdd: subcontractorAccessAddVar,
        clientAccessAdd: clientAccessAddVar,
        billingAccessAdd: billingAccessAddVar,
        payrollAccessAdd: payrollAccessAddVar

    }, function (data) {
        $("#submitAddFormHelp").html(data);
        $("#submitAddFormHelp").attr('class', 'help is-success');
        clearAddFormHelp();
        clearAddFormInput();
        //addModal.classList.remove('is-active');
        //alert(data);
        closeAdd();
        refreshTable();
    });
}

function refreshTable() {
    generateEmployeeListTable1();
    generateEmployeeListTable2(1);
    currentPageNumber = 1;
}

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    roleNameAdd.className = "input is-rounded"
    roleNameAddHelp.className = "help"
    roleNameAddHelp.innerText = ""

}

function clearAddFormInput() {
    roleNameAdd.value = null;
    shipmentAccessAdd.checked = false;
    employeeAccessAdd.checked = false;
    subcontractorAccessAdd.checked = false;
    clientAccessAdd.checked = false;
    billingAccessAdd.checked = false;
    payrollAccessAdd.checked = false;
}

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-permission-controller.class.php", {
            permissionIdDelete: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            refreshTable();
        });
    }
}

function editAjax(roleNameEditVar, shipmentAccessEditVar, employeeAccessEditVar, subcontractorAccessEditVar, clientAccessEditVar, billingAccessEditVar, payrollAccessEditVar, permissionIdEditVar) {
    $.post("./classes/edit-permission-controller.class.php", {
        roleNameEdit: roleNameEditVar,
        shipmentAccessEdit: shipmentAccessEditVar,
        employeeAccessEdit: employeeAccessEditVar,
        subcontractorAccessEdit: subcontractorAccessEditVar,
        clientAccessEdit: clientAccessEditVar,
        billingAccessEdit: billingAccessEditVar,
        payrollAccessEdit: payrollAccessEditVar,
        permissionIdEdit: permissionIdEditVar

    }, function (data) {
        $("#submitEditFormHelp").html(data);
        $("#submitEditFormHelp").attr('class', 'help is-success');
        //clearEditFormHelp();
        //clearEditFormInput();
        //editModal.classList.remove('is-active');
        //alert(data);
        closeEdit();
        refreshTable();
    });
}

function clearEditFormInput() {
    roleNameEdit.value = null;
    shipmentAccessEdit.checked = false;
    employeeAccessEdit.checked = false;
    subcontractorAccessEdit.checked = false;
    clientAccessEdit.checked = false;
    billingAccessEdit.checked = false;
    payrollAccessEdit.checked = false;
}

generateEmployeeListTable1();

generateEmployeeListTable2(1);

let currentPageNumber = 1;

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != 1) {
        paginationPreviousBtn.classList.remove("is-disabled");
    }

});

paginationPreviousBtn.addEventListener('click', () => {

    if (currentPageNumber > 1) {
        currentPageNumber = currentPageNumber - 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});

submitAddForm.addEventListener('click', (e) => {
    //clearAddFormHelp();
    //clearAddFormInput();

    let roleNameAddMessages = []

    //Username Validation

    if (pattern1.test(roleNameAdd.value) == false) {
        roleNameAdd.className = "input is-danger is-rounded"
        roleNameAddHelp.className = "help is-danger"
        roleNameAddMessages.push('Role name should only consist of numbers, letters, or an underscore!')
    }

    if (roleNameAdd.value === "" || roleNameAdd.value == null) {
        roleNameAdd.className = "input is-danger is-rounded"
        roleNameAddHelp.className = "help is-danger"
        roleNameAddMessages.push('Role name is required!')
    }

    if (roleNameAdd.value.length >= 30) {
        roleNameAdd.className = "input is-danger is-rounded"
        roleNameAddHelp.className = "help is-danger"
        roleNameAddMessages.push('Role name must be less than 30 characters!')
    }
    //Messages
    if (roleNameAddMessages.length > 0) {
        e.preventDefault()
        roleNameAddHelp.innerText = roleNameAddMessages.join(', ');
    }

    if (
        roleNameAddMessages.length <= 0
    ) {
        addAjax(roleNameAdd.value, shipmentAccessAdd.checked, employeeAccessAdd.checked, subcontractorAccessAdd.checked, clientAccessAdd.checked, billingAccessAdd.checked, payrollAccessAdd.checked);
    }
});

submitEditForm.addEventListener('click', (e) => {
    //clearAddFormHelp();
    //clearAddFormInput();
    editAjax(editModalTitle.innerHTML, shipmentAccessEdit.checked, employeeAccessEdit.checked, subcontractorAccessEdit.checked, clientAccessEdit.checked, billingAccessEdit.checked, payrollAccessEdit.checked, roleNameEdit.value);
});