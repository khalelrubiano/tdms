const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let editVarHidden = document.getElementById('editVarHidden')
const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
let currentPageNumber = 1;

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

function openEdit(userIdVar) {
    editModal.classList.add('is-active');
    editVarHidden.innerHTML = userIdVar;
    //populateUsernameEdit();
}

function closeEdit() {
    clearEditFormHelp();
    clearEditFormInput();

    submitEditFormHelp.className = "help"
    submitEditFormHelp.innerText = ""

    editModal.classList.remove('is-active');

    //removeSelectEdit(document.getElementById('usernameEdit'));
}

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-employee-controller.class.php", {
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


function testAjax() {
    prompt("deleteVar");
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button
let employeeNumberAdd = document.getElementById('employeeNumberAdd')
let usernameAdd = document.getElementById('usernameAdd')
let passwordAdd = document.getElementById('passwordAdd')
let confirmPasswordAdd = document.getElementById('confirmPasswordAdd')
let firstNameAdd = document.getElementById('firstNameAdd')
let middleNameAdd = document.getElementById('middleNameAdd')
let lastNameAdd = document.getElementById('lastNameAdd')
let roleNameAdd = document.getElementById('roleNameAdd')

let employeeNumberAddHelp = document.getElementById('employeeNumberAddHelp')
let usernameAddHelp = document.getElementById('usernameAddHelp')
let passwordAddHelp = document.getElementById('passwordAddHelp')
let confirmPasswordAddHelp = document.getElementById('confirmPasswordAddHelp')
let firstNameAddHelp = document.getElementById('firstNameAddHelp')
let middleNameAddHelp = document.getElementById('middleNameAddHelp')
let lastNameAddHelp = document.getElementById('lastNameAddHelp')

function addAjax() {
    $.post("./classes/add-employee-controller.class.php", {
        employeeNumberAdd: employeeNumberAdd.value,
        usernameAdd: usernameAdd.value,
        passwordAdd: passwordAdd.value,
        firstNameAdd: firstNameAdd.value,
        middleNameAdd: middleNameAdd.value,
        lastNameAdd: lastNameAdd.value,
        roleNameAdd: roleNameAdd.value
    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        clearAddFormHelp();
        clearAddFormInput();
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

    let employeeNumberAddMessages = []
    let usernameAddMessages = []
    let passwordAddMessages = []
    let confirmPasswordAddMessages = []

    let firstNameAddMessages = []
    let middleNameAddMessages = []
    let lastNameAddMessages = []

    //Username Validation

    if (pattern4.test(employeeNumberAdd.value) == false) {
        employeeNumberAdd.className = "input is-danger is-rounded"
        employeeNumberAddHelp.className = "help is-danger"
        employeeNumberAddMessages.push('Employee number should only consist of numbers!')
    }

    if (employeeNumberAdd.value === "" || employeeNumberAdd.value == null) {
        employeeNumberAdd.className = "input is-danger is-rounded"
        employeeNumberAddHelp.className = "help is-danger"
        employeeNumberAddMessages.push('Employee number is required!')
    }
    /*
    if (employeeNumberAdd.value.length <= 6) {
        employeeNumberAdd.className = "input is-danger is-rounded"
        employeeNumberAddHelp.className = "help is-danger"
        employeeNumberAddMessages.push('Employee number must be longer than 1 character!')
    }

    if (employeeNumberAdd.value.length >= 20) {
        employeeNumberAdd.className = "input is-danger is-rounded"
        employeeNumberAddHelp.className = "help is-danger"
        employeeNumberAddMessages.push('Employee number must be less than 20 characters!')
    }
*/
    //Username Validation

    if (pattern1.test(usernameAdd.value) == false) {
        usernameAdd.className = "input is-danger is-rounded"
        usernameAddHelp.className = "help is-danger"
        usernameAddMessages.push('Username should only consist of numbers, letters, or an underscore!')
    }

    if (usernameAdd.value === "" || usernameAdd.value == null) {
        usernameAdd.className = "input is-danger is-rounded"
        usernameAddHelp.className = "help is-danger"
        usernameAddMessages.push('Username is required!')
    }
    if (usernameAdd.value.length <= 6) {
        usernameAdd.className = "input is-danger is-rounded"
        usernameAddHelp.className = "help is-danger"
        usernameAddMessages.push('Username must be longer than 6 characters!')
    }

    if (usernameAdd.value.length >= 20) {
        usernameAdd.className = "input is-danger is-rounded"
        usernameAddHelp.className = "help is-danger"
        usernameAddMessages.push('Username must be less than 20 characters!')
    }

    //Password Validation
    if (passwordAdd.value === "" || passwordAdd.value == null) {
        passwordAdd.className = "input is-danger is-rounded"
        passwordAddHelp.className = "help is-danger"
        passwordAddMessages.push('Password is required!')
    }
    if (passwordAdd.value.length <= 6) {
        passwordAdd.className = "input is-danger is-rounded"
        passwordAddHelp.className = "help is-danger"
        passwordAddMessages.push('Password must be longer than 6 characters!')
    }

    if (passwordAdd.value.length >= 20) {
        passwordAdd.className = "input is-danger is-rounded"
        passwordAddHelp.className = "help is-danger"
        passwordAddMessages.push('Password must be less than 20 characters!')
    }

    //Confirm Password Validation
    if (confirmPasswordAdd.value != passwordAdd.value) {
        confirmPasswordAdd.className = "input is-danger is-rounded"
        confirmPasswordAddHelp.className = "help is-danger"
        confirmPasswordAddMessages.push('Password does not match!')
    }

    //First Name Validation
    if (pattern3.test(firstNameAdd.value) == false) {
        firstNameAdd.className = "input is-danger is-rounded"
        firstNameAddHelp.className = "help is-danger"
        firstNameAddMessages.push('First name should only consist of letters!')
    }

    if (firstNameAdd.value === "" || firstNameAdd.value == null) {
        firstNameAdd.className = "input is-danger is-rounded"
        firstNameAddHelp.className = "help is-danger"
        firstNameAddMessages.push('First name is required!')
    }

    if (firstNameAdd.value.length >= 255) {
        firstNameAdd.className = "input is-danger is-rounded"
        firstNameAddHelp.className = "help is-danger"
        firstNameAddMessages.push('First name must be less than 255 characters!')
    }

    //Middle Name Validation
    if (pattern3.test(middleNameAdd.value) == false) {
        middleNameAdd.className = "input is-danger is-rounded"
        middleNameAddHelp.className = "help is-danger"
        middleNameAddMessages.push('Middle name should only consist of letters!')
    }

    if (middleNameAdd.value === "" || middleNameAdd.value == null) {
        middleNameAdd.className = "input is-danger is-rounded"
        middleNameAddHelp.className = "help is-danger"
        middleNameAddMessages.push('Middle name is required!')
    }

    if (middleNameAdd.value.length >= 20) {
        middleNameAdd.className = "input is-danger is-rounded"
        middleNameAddHelp.className = "help is-danger"
        middleNameAddMessages.push('Middle name must be less than 255 characters!')
    }

    //Last Name Validation
    if (pattern3.test(lastNameAdd.value) == false) {
        lastNameAdd.className = "input is-danger is-rounded"
        lastNameAddHelp.className = "help is-danger"
        lastNameAddMessages.push('Last name should only consist of letters!')
    }

    if (lastNameAdd.value === "" || lastNameAdd.value == null) {
        lastNameAdd.className = "input is-danger is-rounded"
        lastNameAddHelp.className = "help is-danger"
        lastNameAddMessages.push('Last name is required!')
    }

    if (lastNameAdd.value.length >= 20) {
        lastNameAdd.className = "input is-danger is-rounded"
        lastNameAddHelp.className = "help is-danger"
        lastNameAddMessages.push('Last name must be less than 255 characters!')
    }

    //Messages
    if (employeeNumberAddMessages.length > 0) {
        e.preventDefault()
        employeeNumberAddHelp.innerText = employeeNumberAddMessages.join(', ');
    }

    if (usernameAddMessages.length > 0) {
        e.preventDefault()
        usernameAddHelp.innerText = usernameAddMessages.join(', ');
    }

    if (passwordAddMessages.length > 0) {
        e.preventDefault()
        passwordAddHelp.innerText = passwordAddMessages.join(', ')
    }

    if (confirmPasswordAddMessages.length > 0) {
        e.preventDefault()
        confirmPasswordAddHelp.innerText = confirmPasswordAddMessages.join(', ')
    }

    if (firstNameAddMessages.length > 0) {
        e.preventDefault()
        firstNameAddHelp.innerText = firstNameAddMessages.join(', ')
    }
    if (middleNameAddMessages.length > 0) {
        e.preventDefault()
        middleNameAddHelp.innerText = middleNameAddMessages.join(', ')
    }
    if (lastNameAddMessages.length > 0) {
        e.preventDefault()
        lastNameAddHelp.innerText = lastNameAddMessages.join(', ')
    }

    if (
        employeeNumberAddMessages.length <= 0 &&
        usernameAddMessages.length <= 0 &&
        passwordAddMessages.length <= 0 &&
        confirmPasswordAddMessages.length <= 0 &&
        firstNameAddMessages.length <= 0 &&
        middleNameAddMessages.length <= 0 &&
        lastNameAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    employeeNumberAdd.className = "input is-rounded"
    employeeNumberAddHelp.className = "help"
    employeeNumberAddHelp.innerText = ""

    usernameAdd.className = "input is-rounded"
    usernameAddHelp.className = "help"
    usernameAddHelp.innerText = ""

    passwordAdd.className = "input is-rounded"
    passwordAddHelp.className = "help"
    passwordAddHelp.innerText = ""

    confirmPasswordAdd.className = "input is-rounded"
    confirmPasswordAddHelp.className = "help"
    confirmPasswordAddHelp.innerText = ""

    firstNameAdd.className = "input is-rounded"
    firstNameAddHelp.className = "help"
    firstNameAddHelp.innerText = ""

    middleNameAdd.className = "input is-rounded"
    middleNameAddHelp.className = "help"
    middleNameAddHelp.innerText = ""

    lastNameAdd.className = "input is-rounded"
    lastNameAddHelp.className = "help"
    lastNameAddHelp.innerText = ""
}

function clearAddFormInput() {
    employeeNumberAdd.value = null;
    usernameAdd.value = null;
    passwordAdd.value = null;
    confirmPasswordAdd.value = null;
    firstNameAdd.value = null;
    middleNameAdd.value = null;
    lastNameAdd.value = null;
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button


let passwordEdit = document.getElementById('passwordEdit')
let confirmPasswordEdit = document.getElementById('confirmPasswordEdit')
let firstNameEdit = document.getElementById('firstNameEdit')
let middleNameEdit = document.getElementById('middleNameEdit')
let lastNameEdit = document.getElementById('lastNameEdit')
let roleNameEdit = document.getElementById('roleNameEdit')


let passwordEditHelp = document.getElementById('passwordEditHelp')
let confirmPasswordEditHelp = document.getElementById('confirmPasswordEditHelp')
let firstNameEditHelp = document.getElementById('firstNameEditHelp')
let middleNameEditHelp = document.getElementById('middleNameEditHelp')
let lastNameEditHelp = document.getElementById('lastNameEditHelp')

function editAjax() {
    $.post("./classes/edit-employee-controller.class.php", {
        usernameEdit: editVarHidden.innerHTML,
        passwordEdit: passwordEdit.value,
        firstNameEdit: firstNameEdit.value,
        middleNameEdit: middleNameEdit.value,
        lastNameEdit: lastNameEdit.value,
        roleNameEdit: roleNameEdit.value
    }, function (data) {
        $("#submitEditFormHelp").html(data);
        //$("#submitEditFormHelp").attr('class', 'help is-success');
        clearEditFormHelp();
        clearEditFormInput();
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

    let passwordEditMessages = []
    let confirmPasswordEditMessages = []

    let firstNameEditMessages = []
    let middleNameEditMessages = []
    let lastNameEditMessages = []

    //Password Validation
    if (passwordEdit.value === "" || passwordEdit.value == null) {
        passwordEdit.className = "input is-danger is-rounded"
        passwordEditHelp.className = "help is-danger"
        passwordEditMessages.push('Password is required!')
    }
    if (passwordEdit.value.length <= 6) {
        passwordEdit.className = "input is-danger is-rounded"
        passwordEditHelp.className = "help is-danger"
        passwordEditMessages.push('Password must be longer than 6 characters!')
    }

    if (passwordEdit.value.length >= 20) {
        passwordEdit.className = "input is-danger is-rounded"
        passwordEditHelp.className = "help is-danger"
        passwordEditMessages.push('Password must be less than 20 characters!')
    }

    //Confirm Password Validation
    if (confirmPasswordEdit.value != passwordEdit.value) {
        confirmPasswordEdit.className = "input is-danger is-rounded"
        confirmPasswordEditHelp.className = "help is-danger"
        confirmPasswordEditMessages.push('Password does not match!')
    }

    //First Name Validation
    if (pattern3.test(firstNameEdit.value) == false) {
        firstNameEdit.className = "input is-danger is-rounded"
        firstNameEditHelp.className = "help is-danger"
        firstNameEditMessages.push('First name should only consist of letters!')
    }

    if (firstNameEdit.value === "" || firstNameEdit.value == null) {
        firstNameEdit.className = "input is-danger is-rounded"
        firstNameEditHelp.className = "help is-danger"
        firstNameEditMessages.push('First name is required!')
    }

    if (firstNameEdit.value.length >= 255) {
        firstNameEdit.className = "input is-danger is-rounded"
        firstNameEditHelp.className = "help is-danger"
        firstNameEditMessages.push('First name must be less than 255 characters!')
    }

    //Middle Name Validation
    if (pattern3.test(middleNameEdit.value) == false) {
        middleNameEdit.className = "input is-danger is-rounded"
        middleNameEditHelp.className = "help is-danger"
        middleNameEditMessages.push('Middle name should only consist of letters!')
    }

    if (middleNameEdit.value === "" || middleNameEdit.value == null) {
        middleNameEdit.className = "input is-danger is-rounded"
        middleNameEditHelp.className = "help is-danger"
        middleNameEditMessages.push('Middle name is required!')
    }

    if (middleNameEdit.value.length >= 20) {
        middleNameEdit.className = "input is-danger is-rounded"
        middleNameEditHelp.className = "help is-danger"
        middleNameEditMessages.push('Middle name must be less than 255 characters!')
    }

    //Last Name Validation
    if (pattern3.test(lastNameEdit.value) == false) {
        lastNameEdit.className = "input is-danger is-rounded"
        lastNameEditHelp.className = "help is-danger"
        lastNameEditMessages.push('Last name should only consist of letters!')
    }

    if (lastNameEdit.value === "" || lastNameEdit.value == null) {
        lastNameEdit.className = "input is-danger is-rounded"
        lastNameEditHelp.className = "help is-danger"
        lastNameEditMessages.push('Last name is required!')
    }

    if (lastNameEdit.value.length >= 20) {
        lastNameEdit.className = "input is-danger is-rounded"
        lastNameEditHelp.className = "help is-danger"
        lastNameEditMessages.push('Last name must be less than 255 characters!')
    }

    //Messages


    if (passwordEditMessages.length > 0) {
        e.preventDefault()
        passwordEditHelp.innerText = passwordEditMessages.join(', ')
    }

    if (confirmPasswordEditMessages.length > 0) {
        e.preventDefault()
        confirmPasswordEditHelp.innerText = confirmPasswordEditMessages.join(', ')
    }

    if (firstNameEditMessages.length > 0) {
        e.preventDefault()
        firstNameEditHelp.innerText = firstNameEditMessages.join(', ')
    }
    if (middleNameEditMessages.length > 0) {
        e.preventDefault()
        middleNameEditHelp.innerText = middleNameEditMessages.join(', ')
    }
    if (lastNameEditMessages.length > 0) {
        e.preventDefault()
        lastNameEditHelp.innerText = lastNameEditMessages.join(', ')
    }

    if (

        passwordEditMessages.length <= 0 &&
        confirmPasswordEditMessages.length <= 0 &&
        firstNameEditMessages.length <= 0 &&
        middleNameEditMessages.length <= 0 &&
        lastNameEditMessages.length <= 0
    ) {
        editAjax();
    }

})

function clearEditFormHelp() {
    //RESETTING FORM ELEMENTS

    passwordEdit.className = "input is-rounded"
    passwordEditHelp.className = "help"
    passwordEditHelp.innerText = ""

    confirmPasswordEdit.className = "input is-rounded"
    confirmPasswordEditHelp.className = "help"
    confirmPasswordEditHelp.innerText = ""

    firstNameEdit.className = "input is-rounded"
    firstNameEditHelp.className = "help"
    firstNameEditHelp.innerText = ""

    middleNameEdit.className = "input is-rounded"
    middleNameEditHelp.className = "help"
    middleNameEditHelp.innerText = ""

    lastNameEdit.className = "input is-rounded"
    lastNameEditHelp.className = "help"
    lastNameEditHelp.innerText = ""
}

function clearEditFormInput() {

    passwordEdit.value = null;
    confirmPasswordEdit.value = null;
    firstNameEdit.value = null;
    middleNameEdit.value = null;
    lastNameEdit.value = null;
}


function populateSelect1() {
    $.post("./classes/load-company-role-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            roleNameAdd.options.add(newOption);
            //roleNameEdit.options.add(newOption);
        }

        //closeSelect();
    });
}

function populateSelect2() {
    $.post("./classes/load-company-role-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            //roleNameAdd.options.add(newOption);
            roleNameEdit.options.add(newOption);
        }

        //closeSelect();
    });
}

populateSelect1();
populateSelect2();

//EMPLOYEE LIST
function generateUserList1() {
    $.post("./classes/load-user-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;

        let i = 1;
        while (i <= finalLength) {
            generateUserList2(i, selectSort.value, finalLength);
            i++;
        }

        //generateUserList2(currentPageNumber, selectSort.value, finalLength);
    });
}

function generateUserList2(currentPageNumberVar, orderByVar, finalLengthVar) {
    $.post("./classes/load-user.class.php", {
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);


        if (currentPageNumber <= finalLengthVar) {
            indicator.innerHTML = "success";

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
                newCardHeaderParagraph.innerHTML = jsonArray[i][4] + ' - ' + 'ID: ' + jsonArray[i][6];
                newCardHeader.appendChild(newCardHeaderParagraph);
                /*
                                //CARD HEADER BUTTON
                                var newCardHeaderButton = document.createElement("button");
                                newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "')");
                                newCardHeaderButton.classList.add('card-header-icon');
                                newCardHeader.appendChild(newCardHeaderButton);
                
                                var newCardHeaderButtonSpan = document.createElement("span");
                                newCardHeaderButtonSpan.classList.add('icon');
                                newCardHeaderButton.appendChild(newCardHeaderButtonSpan);
                
                                var newCardHeaderButtonSpanI = document.createElement("i");
                                newCardHeaderButtonSpanI.classList.add('fa-solid');
                                newCardHeaderButtonSpanI.classList.add('fa-trash-can');
                                newCardHeaderButtonSpanI.classList.add('has-text-danger');
                                newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);
                */
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

                //CARD CONTENT MEDIA-CONTENT FIGURE
                //<i class="fa-solid fa-user-large fa-5x mb-4"></i>

                var newCardHeaderButtonSpanI2 = document.createElement("i");
                newCardHeaderButtonSpanI2.classList.add('fa-solid');
                newCardHeaderButtonSpanI2.classList.add('fa-user-large');
                newCardHeaderButtonSpanI2.classList.add('fa-3x');
                newCardHeaderButtonSpanI2.classList.add('mb-4');
                newCardContentMediaContent.appendChild(newCardHeaderButtonSpanI2);
                /*
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
                newCardContentMediaContentTitle.innerHTML = jsonArray[i][1] + " " + jsonArray[i][3];
                newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardContentMediaContentSubtitle = document.createElement("p");
                newCardContentMediaContentSubtitle.classList.add('subtitle');
                newCardContentMediaContentSubtitle.classList.add('is-6');
                newCardContentMediaContentSubtitle.innerHTML = "@" + jsonArray[i][0];
                newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);

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

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function generateUserList3(searchTerm) {
    $.post("./classes/load-user-live-search.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][0]:
                    console.clear();
                    console.log("Username")
                    indicator.innerHTML = "Username";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    break;

                case jsonArray[i][1]:
                    console.clear();
                    console.log("First Name")
                    indicator.innerHTML = "First Name";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    break;

                case jsonArray[i][2]:
                    console.clear();
                    console.log("Middle Name")
                    indicator.innerHTML = "Middle Name";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    return "Success";

                case jsonArray[i][3]:
                    console.clear();
                    console.log("Last Name")
                    indicator.innerHTML = "Last Name";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    break;

                case jsonArray[i][1] + " " + jsonArray[i][2] + " " + jsonArray[i][3]:
                    console.clear();
                    console.log("Full Name")
                    indicator.innerHTML = "Full Name";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    break;

                case jsonArray[i][4]:
                    console.clear();
                    console.log("Role")
                    indicator.innerHTML = "Role";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1], jsonArray[i][2], jsonArray[i][3], jsonArray[i][4]);
                    break;
            }

        }

    });

}
function generateUserList4(usernameVar, firstNameVar, middleNameVar, lastNameVar, roleNameVar) {
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
    newCardHeaderParagraph.innerHTML = roleNameVar;
    newCardHeader.appendChild(newCardHeaderParagraph);
    /*
        //CARD HEADER BUTTON
        var newCardHeaderButton = document.createElement("button");
        newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + usernameVar + "')");
        newCardHeaderButton.classList.add('card-header-icon');
        newCardHeader.appendChild(newCardHeaderButton);
    
        var newCardHeaderButtonSpan = document.createElement("span");
        newCardHeaderButtonSpan.classList.add('icon');
        newCardHeaderButton.appendChild(newCardHeaderButtonSpan);
    
        var newCardHeaderButtonSpanI = document.createElement("i");
        newCardHeaderButtonSpanI.classList.add('fa-solid');
        newCardHeaderButtonSpanI.classList.add('fa-trash-can');
        newCardHeaderButtonSpanI.classList.add('has-text-danger');
        newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);
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
    newCardHeaderButtonSpanI2.classList.add('fa-user-large');
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
    newCardContentMediaContentTitle.innerHTML = firstNameVar + " " + lastNameVar;
    newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardContentMediaContentSubtitle = document.createElement("p");
    newCardContentMediaContentSubtitle.classList.add('subtitle');
    newCardContentMediaContentSubtitle.classList.add('is-6');
    newCardContentMediaContentSubtitle.innerHTML = "@" + usernameVar;
    newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardFooter = document.createElement("footer");
    newCardFooter.classList.add('card-footer');
    newCard.appendChild(newCardFooter);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
    var newCardFooterLink = document.createElement("a");
    newCardFooterLink.setAttribute("onclick", "openEdit('" + usernameVar + "')");
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.classList.add('has-text-info');
    newCardFooterLink.innerHTML = "<i class='fa-solid fa-pen-to-square p-1 mr-1'></i> Edit";
    newCardFooter.appendChild(newCardFooterLink);

    var newCardFooterLink2 = document.createElement("a");
    newCardFooterLink2.setAttribute("onclick", "deleteAjax('" + usernameVar + "')");
    newCardFooterLink2.classList.add('card-footer-item');
    newCardFooterLink2.innerHTML = "<i class='fa-solid fa-trash-can p-1 mr-1'></i> Delete";
    newCardFooterLink2.classList.add('has-text-danger');
    newCardFooter.appendChild(newCardFooterLink2);

    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}

function refreshList() {
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList1();
}

window.addEventListener('scroll', () => {
    let scrollable = document.documentElement.scrollHeight - window.innerHeight;
    let scrollable2 = scrollable * 0.80;
    let scrolled = window.scrollY;

    if (Math.ceil(scrolled) > scrollable2) {
        currentPageNumber = currentPageNumber + 1;
        generateUserList1();
    }

});

selectSort.addEventListener('change', () => {

    test_indicator.innerHTML = selectSort.value;
    refreshList();


});
/*
searchBarInput.addEventListener('input', () => {
    generateUserList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        refreshList();

    }
});
*/

function employeeNumberValidator() {
    $.post("./classes/load-employee-number.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            if (employeeNumberAdd.value == jsonArray[i][0]) {
                employeeNumberAdd.className = "input is-danger is-rounded"
                employeeNumberAddHelp.className = "help is-danger"
                employeeNumberAddHelp.innerText = "This employee number already exists!";
                submitAddForm.setAttribute("disabled", "");
                break;
            }
            if (employeeNumberAdd.value != jsonArray[i][0] && employeeNumberAdd.value != "") {
                employeeNumberAdd.className = "input is-primary is-rounded"
                employeeNumberAddHelp.className = "help is-primary"
                employeeNumberAddHelp.innerText = "This employee number is available!";
                submitAddForm.removeAttribute("disabled");
            }
        }
    });
}

function usernameValidator() {
    $.post("./classes/load-user-all.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            if (usernameAdd.value == jsonArray[i][0]) {
                usernameAdd.className = "input is-danger is-rounded"
                usernameAddHelp.className = "help is-danger"
                usernameAddHelp.innerText = "This username already exists!";
                submitAddForm.setAttribute("disabled", "");
                break;
            }
            if (usernameAdd.value != jsonArray[i][0] && usernameAdd.value != "") {
                usernameAdd.className = "input is-primary is-rounded"
                usernameAddHelp.className = "help is-primary"
                usernameAddHelp.innerText = "This username is available!";
                submitAddForm.removeAttribute("disabled");
            }
        }
    });
}

employeeNumberAdd.addEventListener('input', () => {
    //alert('INPUT');

    if (employeeNumberAdd.value == "") {
        //alert('EMPTY');
        employeeNumberAdd.className = "input is-rounded"
        employeeNumberAddHelp.className = "help"
        employeeNumberAddHelp.innerText = "";
        submitAddForm.removeAttribute("disabled");
    } else {
        employeeNumberValidator();
    }

});

usernameAdd.addEventListener('input', () => {
    //alert('INPUT');

    if (usernameAdd.value == "") {
        //alert('EMPTY');
        usernameAdd.className = "input is-rounded"
        usernameAddHelp.className = "help"
        usernameAddHelp.innerText = "";
        submitAddForm.removeAttribute("disabled");
    } else {
        usernameValidator();
    }

});


refreshList();
