const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const editHeader = document.getElementById('editHeader');
const editHeader2 = document.getElementById('editHeader2');
const ancestorTile = document.getElementById('ancestorTile');
const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const selectSort = document.getElementById('selectSort');
let indicator = document.getElementById('indicator');
let currentPageNumber = 1;
let searchBarInput = document.getElementById('searchBarInput')

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
    populateSelect1();
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

function openEdit(idVar, nameVar) {
    editModal.classList.add('is-active');
    populateSelect2();
    editHeader.innerHTML = "Edit " + nameVar;
    editHeader2.innerHTML = idVar;
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

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-group-controller.class.php", {
            usernameDelete: deleteVar
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

let groupNameAdd = document.getElementById('groupNameAdd')
let groupOwnerAdd = document.getElementById('groupOwnerAdd')

let groupNameAddHelp = document.getElementById('groupNameAddHelp')


function addAjax() {
    $.post("./classes/add-subcontractor-group-controller.class.php", {
        groupNameAdd: groupNameAdd.value,
        groupOwnerAdd: groupOwnerAdd.value
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

    let groupNameAddMessages = []

    //Company Name Validation

    if (groupNameAdd.value === "" || groupNameAdd.value == null) {
        groupNameAdd.className = "input is-danger is-rounded"
        groupNameAddHelp.className = "help is-danger"
        groupNameAddMessages.push('Group name is required!')
    }
    if (groupNameAdd.value.length < 1) {
        groupNameAdd.className = "input is-danger is-rounded"
        groupNameAddHelp.className = "help is-danger"
        groupNameAddMessages.push('Group name must be longer than 1 character!')
    }

    if (groupNameAdd.value.length >= 255) {
        groupNameAdd.className = "input is-danger is-rounded"
        groupNameAddHelp.className = "help is-danger"
        groupNameAddMessages.push('Group name must be less than 50 characters!')
    }


    //Messages
    if (groupNameAddMessages.length > 0) {
        e.preventDefault()
        groupNameAddHelp.innerText = groupNameAddMessages.join(', ');
    }

    if (
        groupNameAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    groupNameAdd.className = "input is-rounded"
    groupNameAddHelp.className = "help"
    groupNameAddHelp.innerText = ""

}

function clearAddFormInput() {
    groupNameAdd.value = null;

}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let groupNameEdit = document.getElementById('groupNameEdit')
let groupOwnerEdit = document.getElementById('groupOwnerEdit')

let groupNameEditHelp = document.getElementById('groupNameEditHelp')


function editAjax() {
    $.post("./classes/edit-subcontractor-group-controller.class.php", {
        groupIdEdit: editHeader2.innerHTML,
        groupNameEdit: groupNameEdit.value,
        groupOwnerEdit: groupOwnerEdit.value
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

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();
    //clearEditFormInput();

    let groupNameEditMessages = []

    //Company Name Validation

    if (groupNameEdit.value === "" || groupNameEdit.value == null) {
        groupNameEdit.className = "input is-danger is-rounded"
        groupNameEditHelp.className = "help is-danger"
        groupNameEditMessages.push('Group name is required!')
    }
    if (groupNameEdit.value.length < 1) {
        groupNameEdit.className = "input is-danger is-rounded"
        groupNameEditHelp.className = "help is-danger"
        groupNameEditMessages.push('Group name must be longer than 1 character!')
    }

    if (groupNameEdit.value.length >= 255) {
        groupNameEdit.className = "input is-danger is-rounded"
        groupNameEditHelp.className = "help is-danger"
        groupNameEditMessages.push('Group name must be less than 50 characters!')
    }


    //Messages
    if (groupNameEditMessages.length > 0) {
        e.preventDefault()
        groupNameEditHelp.innerText = groupNameEditMessages.join(', ');
    }

    if (
        groupNameEditMessages.length <= 0
    ) {
        editAjax();
    }

})

function clearEditFormHelp() {
    //RESETTING FORM ELEMENTS
    groupNameEdit.className = "input is-rounded"
    groupNameEditHelp.className = "help"
    groupNameEditHelp.innerText = ""

}

function clearEditFormInput() {
    groupNameEdit.value = null;

}

function redirectToGroupProfile(subcontractorIdVar, usernameVar, firstNameVar, middleNameVar, lastNameVar, groupIdVar, groupNameVar) {
    $.post("./classes/set-group-session-variable.class.php", {
        subcontractorId: subcontractorIdVar,
        username: usernameVar,
        firstName: firstNameVar,
        middleName: middleNameVar,
        lastName: lastNameVar,
        groupId: groupIdVar,
        groupName: groupNameVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "subcontractor-group-profile.php";
    });
}

//EMPLOYEE LIST
function generateUserList1() {
    $.post("./classes/load-group-all.class.php", {}, function (data) {
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
    $.post("./classes/load-group.class.php", {
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
/*
                //CARD HEADER

                var newCardHeader = document.createElement("header");
                newCardHeader.classList.add('card-header');
                newCard.appendChild(newCardHeader);

                //CARD HEADER PARAGRAPH
                var newCardHeaderParagraph = document.createElement("p");
                newCardHeaderParagraph.classList.add('card-header-title');
                newCardHeaderParagraph.innerHTML = "Owned By: " + jsonArray[i][2] + " " + jsonArray[i][4];
                newCardHeader.appendChild(newCardHeaderParagraph);

                //CARD HEADER BUTTON
                var newCardHeaderButton = document.createElement("button");
                newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][5] + "')");
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
                var newCardContentMedia = document.createElement("div");
                newCardContentMedia.classList.add('media');
                newCardContent.appendChild(newCardContentMedia);

                //CARD CONTENT MEDIA-CONTENT
                var newCardContentMediaContent = document.createElement("div");
                newCardContentMediaContent.classList.add('media-content');
                newCardContentMediaContent.classList.add('has-text-centered');
                newCardContentMedia.appendChild(newCardContentMediaContent);

                var newCardHeaderButtonSpanI2 = document.createElement("i");
                newCardHeaderButtonSpanI2.classList.add('fa-solid');
                newCardHeaderButtonSpanI2.classList.add('fa-users');
                newCardHeaderButtonSpanI2.classList.add('fa-3x');
                newCardHeaderButtonSpanI2.classList.add('mb-4');
                newCardContentMediaContent.appendChild(newCardHeaderButtonSpanI2);

                /*
                                //CARD CONTENT MEDIA-CONTENT FIGURE
                                var newCardContentMediaContentFigure = document.createElement("figure");
                                newCardContentMediaContentFigure.classList.add('image');
                                newCardContentMediaContentFigure.classList.add('is-96x96');
                                newCardContentMediaContentFigure.classList.add('is-inline-block');
                                newCardContentMediaContent.appendChild(newCardContentMediaContentFigure);
                
                                //CARD CONTENT MEDIA-CONTENT FIGURE IMAGE
                                var newCardContentMediaContentFigureImage = document.createElement("img");
                                newCardContentMediaContentFigureImage.classList.add('is-rounded');
                                newCardContentMediaContentFigureImage.setAttribute("src", "https://bulma.io/images/placeholders/96x96.png");
                                newCardContentMediaContentFigure.appendChild(newCardContentMediaContentFigureImage);
                */

                //CARD CONTENT MEDIA-CONTENT TITLE
                var newCardContentMediaContentTitle = document.createElement("p");
                newCardContentMediaContentTitle.classList.add('title');
                newCardContentMediaContentTitle.classList.add('is-4');
                newCardContentMediaContentTitle.innerHTML = jsonArray[i][6];
                newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);
                /*
                                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                                var newCardContentMediaContentSubtitle = document.createElement("p");
                                newCardContentMediaContentSubtitle.classList.add('subtitle');
                                newCardContentMediaContentSubtitle.classList.add('is-6');
                                newCardContentMediaContentSubtitle.innerHTML = jsonArray[i][2] + " " + jsonArray[i][4];
                                newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);
                */
                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.setAttribute("onclick", "redirectToGroupProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "','" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View";
                newCardFooterLink.classList.add('has-text-info');
                newCardFooter.appendChild(newCardFooterLink);

                var newCardFooterLink2 = document.createElement("a");
                newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                newCardFooterLink2.classList.add('card-footer-item');
                newCardFooterLink2.innerHTML = "<i class='fa-solid fa-pen-to-square p-1 mr-1'></i> Edit";
                newCardFooterLink2.classList.add('has-text-info');
                newCardFooter.appendChild(newCardFooterLink2);

                var newCardFooterLink3 = document.createElement("a");
                newCardFooterLink3.setAttribute("onclick", "deleteAjax('" + jsonArray[i][5] + "')");
                newCardFooterLink3.classList.add('card-footer-item');
                newCardFooterLink3.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
                newCardFooterLink3.classList.add('has-text-danger');
                newCardFooter.appendChild(newCardFooterLink3);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function testFunction(var1) {
    alert(var1);
}
/*
function generateUserList3(searchTerm) {
    $.post("./classes/load-group-live-search.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][1]:
                    console.clear();
                    console.log("Username")
                    indicator.innerHTML = "Username";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    break;

                case jsonArray[i][2]:
                    console.clear();
                    console.log("First Name")
                    indicator.innerHTML = "First Name";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    break;

                case jsonArray[i][3]:
                    console.clear();
                    console.log("Middle Name")
                    indicator.innerHTML = "Middle Name";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    return "Success";

                case jsonArray[i][4]:
                    console.clear();
                    console.log("Last Name")
                    indicator.innerHTML = "Last Name";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    break;

                case jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4]:
                    console.clear();
                    console.log("Full Name")
                    indicator.innerHTML = "Full Name";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    break;

                case jsonArray[i][6]:
                    console.clear();
                    console.log("Group Name")
                    indicator.innerHTML = "Group Name";
                    generateUserList4(jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4], jsonArray[i][6], jsonArray[i][5]);
                    break;
            }

        }

    });

}

function generateUserList4(usernameVar, firstNameVar, middleNameVar, lastNameVar, groupNameVar, ownerIdVar) {
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
    newCardHeaderParagraph.innerHTML = "Owned By: " + firstNameVar + " " + lastNameVar;
    newCardHeader.appendChild(newCardHeaderParagraph);

    //CARD HEADER BUTTON
    var newCardHeaderButton = document.createElement("button");
    newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + ownerIdVar + "')");
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
    var newCardContentMedia = document.createElement("div");
    newCardContentMedia.classList.add('media');
    newCardContent.appendChild(newCardContentMedia);

    //CARD CONTENT MEDIA-CONTENT
    var newCardContentMediaContent = document.createElement("div");
    newCardContentMediaContent.classList.add('media-content');
    newCardContentMediaContent.classList.add('has-text-centered');
    newCardContentMedia.appendChild(newCardContentMediaContent);

    var newCardHeaderButtonSpanI2 = document.createElement("i");
    newCardHeaderButtonSpanI2.classList.add('fa-solid');
    newCardHeaderButtonSpanI2.classList.add('fa-users');
    newCardHeaderButtonSpanI2.classList.add('fa-3x');
    newCardHeaderButtonSpanI2.classList.add('mb-4');
    newCardContentMediaContent.appendChild(newCardHeaderButtonSpanI2);

    /*
    //CARD CONTENT MEDIA-CONTENT FIGURE
    var newCardContentMediaContentFigure = document.createElement("figure");
    newCardContentMediaContentFigure.classList.add('image');
    newCardContentMediaContentFigure.classList.add('is-96x96');
    newCardContentMediaContentFigure.classList.add('is-inline-block');
    newCardContentMediaContent.appendChild(newCardContentMediaContentFigure);

    //CARD CONTENT MEDIA-CONTENT FIGURE IMAGE
    var newCardContentMediaContentFigureImage = document.createElement("img");
    newCardContentMediaContentFigureImage.classList.add('is-rounded');
    newCardContentMediaContentFigureImage.setAttribute("src", "https://bulma.io/images/placeholders/96x96.png");
    newCardContentMediaContentFigure.appendChild(newCardContentMediaContentFigureImage);

    //CARD CONTENT MEDIA-CONTENT TITLE
    var newCardContentMediaContentTitle = document.createElement("p");
    newCardContentMediaContentTitle.classList.add('title');
    newCardContentMediaContentTitle.classList.add('is-4');
    newCardContentMediaContentTitle.innerHTML = groupNameVar;
    newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);
    
        //CARD CONTENT MEDIA-CONTENT SUBTITLE
        var newCardContentMediaContentSubtitle = document.createElement("p");
        newCardContentMediaContentSubtitle.classList.add('subtitle');
        newCardContentMediaContentSubtitle.classList.add('is-6');
        newCardContentMediaContentSubtitle.innerHTML = firstNameVar + " " + lastNameVar;
        newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);
    
    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardFooter = document.createElement("footer");
    newCardFooter.classList.add('card-footer');
    newCard.appendChild(newCardFooter);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
    var newCardFooterLink = document.createElement("a");
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.innerHTML = "View";
    newCardFooter.appendChild(newCardFooterLink);

    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}
*/
function refreshList() {
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList1();
    //generateUserList2(1, selectSort.value);
}

function populateSelect1() {
    $.post("./classes/load-subcontractor-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = "@" + jsonArray[i][1] + " - " + jsonArray[i][2] + " " + jsonArray[i][3] + " " + jsonArray[i][4];
            groupOwnerAdd.options.add(newOption);
            //groupOwnerEdit.options.add(newOption);
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
            //groupOwnerAdd.options.add(newOption);
            groupOwnerEdit.options.add(newOption);
        }

        //closeSelect();
    });
}

selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    refreshList();
    //generateUserList2(1, selectSort.value);


});

/*
searchBarInput.addEventListener('input', () => {
    generateUserList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        refreshList();
        //generateUserList2(1, selectSort.value);

    }
});*/

refreshList();

//generateUserList1();
//generateUserList2(1, selectSort.value);