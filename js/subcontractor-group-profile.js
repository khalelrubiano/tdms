let returnBtn = document.getElementById('returnBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');
const add2Modal = document.getElementById('add2Modal');
let vehicleIdHidden = document.getElementById('vehicleIdHidden');
const typeTable = document.getElementById('typeTable');
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
    populateSelect3();
    populateSelect4();
    vehicleIdHidden.innerHTML = idVar;
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

function openAdd2() {
    add2Modal.classList.add('is-active');
    typeTable.innerHTML = '';
    getType();
    //populateUsernameAdd();
}

function closeAdd2() {

    clearAdd2FormHelp();
    clearAdd2FormInput();

    submitAdd2FormHelp.className = "help"
    submitAdd2FormHelp.innerText = ""

    add2Modal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

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
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button

let plateNumberAdd = document.getElementById('plateNumberAdd');
let commissionRateAdd = document.getElementById('commissionRateAdd');
let driverAdd = document.getElementById('driverAdd');
let helperAdd = document.getElementById('helperAdd');
let groupIdHidden = document.getElementById('groupIdHidden')
let typeAdd = document.getElementById('typeAdd');

let plateNumberAddHelp = document.getElementById('plateNumberAddHelp');
let commissionRateAddHelp = document.getElementById('commissionRateAddHelp');


function addAjax() {
    $.post("./classes/add-vehicle-controller.class.php", {
        plateNumberAdd: plateNumberAdd.value,
        commissionRateAdd: commissionRateAdd.value,
        driverAdd: driverAdd.value,
        helperAdd: helperAdd.value,
        groupIdAdd: groupIdHidden.innerHTML,
        typeAdd: typeAdd.value
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
    clearAddFormHelp();
    //clearAddFormInput();

    let plateNumberAddMessages = []
    let commissionRateAddMessages = []

    //Plate Number Validation

    if (plateNumberAdd.value === "" || plateNumberAdd.value == null) {
        plateNumberAdd.className = "input is-danger is-rounded"
        plateNumberAddHelp.className = "help is-danger"
        plateNumberAddMessages.push('Vehicle plate number is required!')
    }
    if (plateNumberAdd.value.length < 1) {
        plateNumberAdd.className = "input is-danger is-rounded"
        plateNumberAddHelp.className = "help is-danger"
        plateNumberAddMessages.push('Vehicle plate number must be longer than 1 character!')
    }

    if (plateNumberAdd.value.length >= 255) {
        plateNumberAdd.className = "input is-danger is-rounded"
        plateNumberAddHelp.className = "help is-danger"
        plateNumberAddMessages.push('Vehicle plate number must be less than 50 characters!')
    }

    //Commission Rate Validation

    if (commissionRateAdd.value === "" || commissionRateAdd.value == null) {
        commissionRateAdd.className = "input is-danger is-rounded"
        commissionRateAddHelp.className = "help is-danger"
        commissionRateAddMessages.push('Commission rate is required!')
    }

    //Messages
    if (plateNumberAddMessages.length > 0) {
        e.preventDefault()
        plateNumberAddHelp.innerText = plateNumberAddMessages.join(', ');
    }
    if (commissionRateAddMessages.length > 0) {
        e.preventDefault()
        commissionRateAddHelp.innerText = commissionRateAddMessages.join(', ');
    }
    if (
        plateNumberAddMessages.length <= 0 &&
        commissionRateAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    plateNumberAdd.className = "input is-rounded"
    plateNumberAddHelp.className = "help"
    plateNumberAddHelp.innerText = ""

    commissionRateAdd.className = "input is-rounded"
    commissionRateAddHelp.className = "help"
    commissionRateAddHelp.innerText = ""

}

function clearAddFormInput() {
    plateNumberAdd.value = null;
    commissionRateAdd.value = null;

}

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
        closeEdit();
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

//ADD 2 AJAX CALLS WITH VALIDATION
let submitAdd2Form = document.getElementById('submitAdd2Form'); //save changes button
let submitAdd2FormHelp = document.getElementById('submitAdd2FormHelp'); //save changes button

let typeAdd2 = document.getElementById('typeAdd2');

let typeAdd2Help = document.getElementById('typeAdd2Help');


function addAjax2() {
    $.post("./classes/add-vehicle-type-controller.class.php", {
        typeAdd2: typeAdd2.value
    }, function (data) {
        //$("#submitAdd2FormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        clearAdd2FormHelp();
        clearAdd2FormInput();
        //addModal.classList.remove('is-active');
        //closeAdd2();
        //refreshList();
        typeTable.innerHTML = '';
        getType();
    });
}
/*
var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/
*/
submitAdd2Form.addEventListener('click', (e) => {
    clearAdd2FormHelp();
    //clearAddFormInput();

    addAjax2();

    /*
        let plateNumberAddMessages = []
    
    
        //Plate Number Validation
    
        if (plateNumberAdd.value === "" || plateNumberAdd.value == null) {
            plateNumberAdd.className = "input is-danger is-rounded"
            plateNumberAddHelp.className = "help is-danger"
            plateNumberAddMessages.push('Vehicle plate number is required!')
        }
        if (plateNumberAdd.value.length < 1) {
            plateNumberAdd.className = "input is-danger is-rounded"
            plateNumberAddHelp.className = "help is-danger"
            plateNumberAddMessages.push('Vehicle plate number must be longer than 1 character!')
        }
    
        if (plateNumberAdd.value.length >= 255) {
            plateNumberAdd.className = "input is-danger is-rounded"
            plateNumberAddHelp.className = "help is-danger"
            plateNumberAddMessages.push('Vehicle plate number must be less than 50 characters!')
        }
    
        //Commission Rate Validation
    
        if (commissionRateAdd.value === "" || commissionRateAdd.value == null) {
            commissionRateAdd.className = "input is-danger is-rounded"
            commissionRateAddHelp.className = "help is-danger"
            commissionRateAddMessages.push('Commission rate is required!')
        }
    
        //Messages
        if (plateNumberAddMessages.length > 0) {
            e.preventDefault()
            plateNumberAddHelp.innerText = plateNumberAddMessages.join(', ');
        }
        if (commissionRateAddMessages.length > 0) {
            e.preventDefault()
            commissionRateAddHelp.innerText = commissionRateAddMessages.join(', ');
        }
        if (
            plateNumberAddMessages.length <= 0 &&
            commissionRateAddMessages.length <= 0
        ) {
            addAjax();
        }
    */
})

function clearAdd2FormHelp() {
    //RESETTING FORM ELEMENTS
    typeAdd2.className = "input is-rounded"
    typeAdd2Help.className = "help"
    typeAdd2Help.innerText = ""

}

function clearAdd2FormInput() {
    typeAdd2.value = null;

}

function populateSelect5() {
    $.post("./classes/load-vehicle-type-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][0];
            typeAdd.options.add(newOption);
            //helperAdd.options.add(newOption);
        }

        //closeSelect();
    });
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

        let i = 1;
        while (i <= finalLength) {
            generateUserList2(i, selectSort.value, finalLength);
            i++;
        }
    });
}

function generateUserList2(currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-vehicle.class.php", {
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
                    newContentParagraph2.innerHTML = jsonArray[i][7];
                    newContent.appendChild(newContentParagraph2);
                }

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
                newContentTableTbodyTr5Td2.innerHTML = jsonArray[i][6];
                newContentTableTbodyTr5.appendChild(newContentTableTbodyTr5Td2);

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.classList.add('has-text-weight-bold');
                newContentTableTbodyTr2Td1.innerHTML = "Commission Rate:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][2] + "%";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);

                //CONTENT TABLE TBODY TR 3
                var newContentTableTbodyTr3 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr3);

                var newContentTableTbodyTr3Td1 = document.createElement("td");
                newContentTableTbodyTr3Td1.classList.add('has-text-weight-bold');
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
                newCardFooterLink.classList.add('has-text-info');
                newCardFooterLink.innerHTML = "<i class='fa-solid fa-pen-to-square p-1 mr-1'></i> Edit";
                newCardFooter.appendChild(newCardFooterLink);

                var newCardFooterLink2 = document.createElement("a");
                newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
                newCardFooterLink2.classList.add('has-text-danger');
                newCardFooter.appendChild(newCardFooterLink2);

                /*
                var newCardFooterLink2 = document.createElement("a");
                //newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "Manage Tracker";
                newCardFooter.appendChild(newCardFooterLink2);
*/
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

    /*
    var newCardFooterLink2 = document.createElement("a");
    //newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
    newCardFooterLink2.classList.add('card-footer-item');
    newCardFooterLink2.innerHTML = "Manage Tracker";
    newCardFooter.appendChild(newCardFooterLink2);
*/
    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];

    newParentTile.appendChild(newChildTile);
}

function refreshList() {

    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList1();

    //generateUserList2(1, selectSort.value);
}

//DELETE AJAX CALL
function deleteAjax2(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-type-controller.class.php", {
            typeId: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshTable();
            typeTable.innerHTML = '';
            getType();
        });
    }
}

function testFunc(testVar) {
    alert(testVar);
}

function getType() {
    $.post("./classes/load-vehicle-type-select.class.php", {
    }, function (data) {
        var jsonArray = JSON.parse(data);
        //alert(data);

        for (var i = 0; i < jsonArray.length; i++) {
            //TR
            var newTr = document.createElement("tr");

            //TD
            var newTd = document.createElement("td");
            newTd.setAttribute("style", "text-align: left;");
            newTd.classList.add('typeTD');
            //newTd.innerHTML = '<button class="mr-4" onclick="deleteAjax("' + jsonArray[i][1] + '")"><i class="fa-solid fa-xmark"></i></button>' + jsonArray[i][0]
            newTd.innerHTML = "<button class='mr-4' onclick=deleteAjax2('" + jsonArray[i][1] + "')><i class='fa-solid fa-xmark'></i></button>" + jsonArray[i][0]
            newTr.appendChild(newTd);

            //FINAL APPEND
            typeTable.appendChild(newTr);
        };
    });
}



returnBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-group.php";
});

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    refreshList();
    //generateUserList2(1, selectSort.value);


});

searchBarInput.addEventListener('input', () => {
    generateUserList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        refreshList();
        //generateUserList2(1, selectSort.value);

    }
});

populateSelect1();
populateSelect2();
populateSelect5();
refreshList();
//generateUserList1();
//generateUserList2(1, selectSort.value);