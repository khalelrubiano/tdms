let returnBtn = document.getElementById('returnBtn')
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');

const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const areaIdHidden = document.getElementById('areaIdHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')
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

function openEdit(idVar) {
    editModal.classList.add('is-active');
    //populateSelect3();
    //populateSelect4();
    areaIdHidden.innerHTML = idVar;
    //populateUsernameAdd();
}

function closeEdit() {

    clearEditFormHelp();
    clearEditFormInput();

    submitEditFormHelp.className = "help"
    submitEditFormHelp.innerText = ""

    editModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}
/*
//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-vehicle-controller.class.php", {
            vehicleIdDelete: deleteVar
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
}*/

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-client-area-controller.class.php", {
            clientAreaIdDelete: deleteVar
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

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button

let areaNameAdd = document.getElementById('areaNameAdd');
let areaRateAdd = document.getElementById('areaRateAdd');
let clientIdHidden = document.getElementById('clientIdHidden');

let areaNameAddHelp = document.getElementById('areaNameAddHelp');
let areaRateAddHelp = document.getElementById('areaRateAddHelp');


function addAjax() {
    $.post("./classes/add-client-area-controller.class.php", {
        areaNameAdd: areaNameAdd.value,
        areaRateAdd: areaRateAdd.value,
        clientId: clientIdHidden.innerHTML
    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        //clearAddFormHelp();
        //clearAddFormInput();
        //addModal.classList.remove('is-active');
        closeAdd();
        refreshTable();
    });
}

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

submitAddForm.addEventListener('click', (e) => {
    clearAddFormHelp();
    //clearAddFormInput();

    let areaNameAddMessages = []
    let areaRateAddMessages = []

    //Plate Number Validation

    if (areaNameAdd.value === "" || areaNameAdd.value == null) {
        areaNameAdd.className = "input is-danger is-rounded"
        areaNameAddHelp.className = "help is-danger"
        areaNameAddMessages.push('Area name is required!')
    }
    if (areaNameAdd.value.length < 1) {
        areaNameAdd.className = "input is-danger is-rounded"
        areaNameAddHelp.className = "help is-danger"
        areaNameAddMessages.push('Area name must be longer than 1 character!')
    }

    if (areaNameAdd.value.length >= 255) {
        areaNameAdd.className = "input is-danger is-rounded"
        areaNameAddHelp.className = "help is-danger"
        areaNameAddMessages.push('Area name must be less than 50 characters!')
    }

    //Area Rate Validation

    if (areaRateAdd.value === "" || areaRateAdd.value == null) {
        areaRateAdd.className = "input is-danger is-rounded"
        areaRateAddHelp.className = "help is-danger"
        areaRateAddMessages.push('Area rate is required!')
    }

    //Messages
    if (areaNameAddMessages.length > 0) {
        e.preventDefault()
        areaNameAddHelp.innerText = areaNameAddMessages.join(', ');
    }
    if (areaRateAddMessages.length > 0) {
        e.preventDefault()
        areaRateAddHelp.innerText = areaRateAddMessages.join(', ');
    }
    if (
        areaNameAddMessages.length <= 0 &&
        areaRateAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    areaNameAdd.className = "input is-rounded"
    areaNameAddHelp.className = "help"
    areaNameAddHelp.innerText = ""

    areaRateAdd.className = "input is-rounded"
    areaRateAddHelp.className = "help"
    areaRateAddHelp.innerText = ""

}

function clearAddFormInput() {
    areaNameAdd.value = null;
    areaRateAdd.value = null;

}
//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let areaRateEdit = document.getElementById('areaRateEdit');

let areaRateEditHelp = document.getElementById('areaRateEditHelp');


function editAjax(areaIdVar) {
    $.post("./classes/edit-client-area-controller.class.php", {
        areaRateEdit: areaRateEdit.value,
        areaId: areaIdHidden.innerHTML
    }, function (data) {
        $("#submitEditFormHelp").html(data);
        //$("#submitEditFormHelp").attr('class', 'help is-success');
        //clearEditFormHelp();
        //clearEditFormInput();
        //editModal.classList.remove('is-active');
        closeEdit();
        refreshTable();
    });
}

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();
    //clearEditFormInput();

    let areaRateEditMessages = []

    //Area Rate Validation

    if (areaRateEdit.value === "" || areaRateEdit.value == null) {
        areaRateEdit.className = "input is-danger is-rounded"
        areaRateEditHelp.className = "help is-danger"
        areaRateEditMessages.push('Area rate is required!')
    }

    //Messages

    if (areaRateEditMessages.length > 0) {
        e.preventDefault()
        areaRateEditHelp.innerText = areaRateEditMessages.join(', ');
    }
    if (
        areaRateEditMessages.length <= 0
    ) {
        editAjax();
    }

})

function clearEditFormHelp() {
    //RESETTING FORM ELEMENTS

    areaRateEdit.className = "input is-rounded"
    areaRateEditHelp.className = "help"
    areaRateEditHelp.innerText = ""

}

function clearEditFormInput() {

    areaRateEdit.value = null;

}
/*
//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let commissionRateEdit = document.getElementById('commissionRateEdit');
let driverEdit = document.getElementById('driverEdit');
let helperEdit = document.getElementById('helperEdit');

let commissionRateEditHelp = document.getElementById('commissionRateEditHelp');


function editAjax() {
    $.post("./classes/edit-vehicle-controller.class.php", {
        vehicleIdEdit: vehicleIdHidden.innerHTML,
        commissionRateEdit: commissionRateEdit.value,
        driverEdit: driverEdit.value,
        helperEdit: helperEdit.value
    }, function (data) {
        $("#submitEditFormHelp").html(data);
        //$("#submitEditFormHelp").attr('class', 'help is-success');
        //clearEditFormHelp();
        //clearEditFormInput();
        //editModal.classList.remove('is-active');
        refreshList();
    });
}

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();
    //clearEditFormInput();

    let commissionRateEditMessages = []

    //Commission Rate Validation

    if (commissionRateEdit.value === "" || commissionRateEdit.value == null) {
        commissionRateEdit.className = "input is-danger is-rounded"
        commissionRateEditHelp.className = "help is-danger"
        commissionRateEditMessages.push('Commission rate is required!')
    }

    //Messages
    if (commissionRateEditMessages.length > 0) {
        e.preventDefault()
        commissionRateEditHelp.innerText = commissionRateEditMessages.join(', ');
    }
    if (
        commissionRateEditMessages.length <= 0
    ) {
        editAjax();
    }

})

function clearEditFormHelp() {
    //RESETTING FORM ELEMENTS

    commissionRateEdit.className = "input is-rounded"
    commissionRateEditHelp.className = "help"
    commissionRateEditHelp.innerText = ""

}

function clearEditFormInput() {
    commissionRateEdit.value = null;

}

function populateSelect1() {
    $.post("./classes/load-subcontractor-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "@" + jsonArray[i][1] + " - " + jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4];
            driverAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

function populateSelect3() {
    $.post("./classes/load-subcontractor-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "@" + jsonArray[i][1] + " - " + jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4];
            driverEdit.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

function populateSelect2() {
    $.post("./classes/load-subcontractor-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "@" + jsonArray[i][1] + " - " + jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4];
            //driverAdd.options.add(newOption);
            helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

function populateSelect4() {
    $.post("./classes/load-subcontractor-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "@" + jsonArray[i][1] + " - " + jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4];
            //driverAdd.options.add(newOption);
            helperEdit.options.add(newOption);
        }

        //closeSelect();
    });
}

//VEHICLE LIST
function generateUserList1() {
    $.post("./classes/load-vehicle-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;
    });
}

function generateUserList2(currentPageNumberVar, orderByVar) {
    $.post("./classes/load-vehicle.class.php", {
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);
        indicator.innerHTML = "call success";

        if (currentPageNumber <= arrayLengthHidden.innerHTML) {
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
                newContentTableTbodyTr1Td1.innerHTML = "Plate Number:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][1];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.innerHTML = "Commission Rate:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][2] + "%";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.innerHTML = "Driver:";
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

                var newContentTableTbodyTr3Td2 = document.createElement("td");
                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][4];
                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

                //CONTENT TABLE TBODY TR 4
                var newContentTableTbodyTr4 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr4);

                var newContentTableTbodyTr4Td1 = document.createElement("td");
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
                newCardFooterLink.setAttribute("onclick", "openEdit('" + jsonArray[i][0] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "Edit Details";
                newCardFooter.appendChild(newCardFooterLink);

                var newCardFooterLink2 = document.createElement("a");
                //newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "Manage Tracker";
                newCardFooter.appendChild(newCardFooterLink2);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function generateUserList3(searchTerm) {
    $.post("./classes/load-vehicle-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][1]:
                    console.clear();
                    console.log("Plate Number")
                    indicator.innerHTML = "Plate Number";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][5]);
                    break;

                case jsonArray[i][4]:
                    console.clear();
                    console.log("Driver")
                    indicator.innerHTML = "Driver";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][5]);
                    return "Success";

                case jsonArray[i][5]:
                    console.clear();
                    console.log("Helper")
                    indicator.innerHTML = "Helper";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][5]);
                    break;
            }

        }

    });

}

function generateUserList4(vehicleIdVar, plateNumberVar, commissionRateVar, vehicleStatusVar, driverVar, helperVar) {
    ancestorTile.innerHTML = "";
    var newParentTile = document.createElement("div");
    newParentTile.classList.add('tile');
    newParentTile.classList.add('is-parent');
    ancestorTile.appendChild(newParentTile);
    var newChildTile = document.createElement("div");
    newChildTile.classList.add('tile');
    newChildTile.classList.add('is-child');
    newChildTile.classList.add('p-2');
    newChildTile.classList.add('is-3');

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
    switch (vehicleStatusVar) {
        case "Available":
            newCardHeaderParagraph.classList.add('has-text-primary');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3'></i>" + vehicleStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;
        case "Unavailable":
            newCardHeaderParagraph.classList.add('has-text-danger');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-danger'></i>" + vehicleStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;
        case "On-Delivery":
            newCardHeaderParagraph.classList.add('has-text-warning');
            newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle mr-3 has-text-warning'></i>" + vehicleStatusVar;
            newCardHeader.appendChild(newCardHeaderParagraph);
            break;

    }
    //indicator.innerHTML = "gen4";

    //CARD HEADER BUTTON
    var newCardHeaderButton = document.createElement("button");
    newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + vehicleIdVar + "')");
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
    newContent.appendChild(newContentParagraph);

    //CONTENT PARAGRAPH ICON
    var newContentParagraphIcon = document.createElement("i");
    newContentParagraphIcon.classList.add('fa-solid');
    newContentParagraphIcon.classList.add('fa-truck');
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

    //CONTENT TABLE TBODY TR 1
    var newContentTableTbodyTr1 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr1);

    var newContentTableTbodyTr1Td1 = document.createElement("td");
    newContentTableTbodyTr1Td1.innerHTML = "Plate Number:";
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

    var newContentTableTbodyTr1Td2 = document.createElement("td");
    newContentTableTbodyTr1Td2.innerHTML = plateNumberVar;
    newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

    //CONTENT TABLE TBODY TR 2
    var newContentTableTbodyTr2 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr2);

    var newContentTableTbodyTr2Td1 = document.createElement("td");
    newContentTableTbodyTr2Td1.innerHTML = "Commission Rate:";
    newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

    var newContentTableTbodyTr2Td2 = document.createElement("td");
    newContentTableTbodyTr2Td2.innerHTML = commissionRateVar + "%";
    newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

    //CONTENT TABLE TBODY TR 3
    var newContentTableTbodyTr3 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr3);

    var newContentTableTbodyTr3Td1 = document.createElement("td");
    newContentTableTbodyTr3Td1.innerHTML = "Driver:";
    newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);

    var newContentTableTbodyTr3Td2 = document.createElement("td");
    newContentTableTbodyTr3Td2.innerHTML = driverVar;
    newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);

    //CONTENT TABLE TBODY TR 4
    var newContentTableTbodyTr4 = document.createElement("tr");
    newContentTableTbody.appendChild(newContentTableTbodyTr4);

    var newContentTableTbodyTr4Td1 = document.createElement("td");
    newContentTableTbodyTr4Td1.innerHTML = "Helper:";
    newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);

    var newContentTableTbodyTr4Td2 = document.createElement("td");
    newContentTableTbodyTr4Td2.innerHTML = helperVar;
    newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardFooter = document.createElement("footer");
    newCardFooter.classList.add('card-footer');
    newCard.appendChild(newCardFooter);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
    var newCardFooterLink = document.createElement("a");
    //newCardFooterLink.setAttribute("onclick", "redirectToGroupProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.innerHTML = "Edit Details";
    newCardFooter.appendChild(newCardFooterLink);

    var newCardFooterLink2 = document.createElement("a");
    //newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
    newCardFooterLink2.classList.add('card-footer-item');
    newCardFooterLink2.innerHTML = "Manage Tracker";
    newCardFooter.appendChild(newCardFooterLink2);

    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];

    newParentTile.appendChild(newChildTile);
}

function refreshList() {
    generateUserList1();
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList2(1, selectSort.value);
}*/

function generateClientAreaListTable1() {
    $.post("./classes/load-client-area.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 5); //1 is the number of results per page
        //arrayLengthHidden.innerHTML = jsonArray.length;
        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}

function generateClientAreaListTable2(currentPageNumberVar) {
    $.post("./classes/load-client-area-pagination.class.php", {
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

            //EDIT BUTTON
            var newEditBtn = document.createElement("button");
            newEditBtn.classList.add('button');
            newEditBtn.classList.add('mr-3');
            newEditBtn.setAttribute("onclick", "openEdit('" + jsonArray[i][0] + "')");
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


            newTableData3.appendChild(newEditBtn);
            newTableData3.appendChild(newDeleteBtn);

            newTableData1.setAttribute("data-label", "Area Name");

            newTableData2.setAttribute("data-label", "Area Rate");

            newTableData3.setAttribute("data-label", "");

            newTableData1.innerHTML = jsonArray[i][1];
            newTableData2.innerHTML = jsonArray[i][2];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);


        }
    });
}

function refreshTable() {
    generateClientAreaListTable1();
    generateClientAreaListTable2(1);
    currentPageNumber = 1;
}

generateClientAreaListTable1();
generateClientAreaListTable2(1);

returnBtn.addEventListener('click', () => {
    window.location.href = "client-view-list.php";
});

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateClientAreaListTable2(paginationIndicatorBtn.innerHTML);
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
        generateClientAreaListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});

/*
selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList2(1, selectSort.value);


});

searchBarInput.addEventListener('input', () => {
    generateUserList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        generateUserList2(1, selectSort.value);

    }
});

populateSelect1();
populateSelect2();

generateUserList1();
generateUserList2(1, selectSort.value);*/