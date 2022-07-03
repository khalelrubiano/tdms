const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')

const addModal = document.getElementById('addModal');

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

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-user-controller.class.php", {
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

let usernameAdd = document.getElementById('usernameAdd')
let passwordAdd = document.getElementById('passwordAdd')
let confirmPasswordAdd = document.getElementById('confirmPasswordAdd')
let firstNameAdd = document.getElementById('firstNameAdd')
let middleNameAdd = document.getElementById('middleNameAdd')
let lastNameAdd = document.getElementById('lastNameAdd')
let roleNameAdd = document.getElementById('roleNameAdd')

let usernameAddHelp = document.getElementById('usernameAddHelp')
let passwordAddHelp = document.getElementById('passwordAddHelp')
let confirmPasswordAddHelp = document.getElementById('confirmPasswordAddHelp')
let firstNameAddHelp = document.getElementById('firstNameAddHelp')
let middleNameAddHelp = document.getElementById('middleNameAddHelp')
let lastNameAddHelp = document.getElementById('lastNameAddHelp')

function addAjax() {
    $.post("./classes/add-user-controller.class.php", {
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

    let usernameAddMessages = []
    let passwordAddMessages = []
    let confirmPasswordAddMessages = []

    let firstNameAddMessages = []
    let middleNameAddMessages = []
    let lastNameAddMessages = []

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
    usernameAdd.value = null;
    passwordAdd.value = null;
    confirmPasswordAdd.value = null;
    firstNameAdd.value = null;
    middleNameAdd.value = null;
    lastNameAdd.value = null;
}

function populateSelect() {
    $.post("./classes/load-company-role-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            roleNameAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

populateSelect();

//EMPLOYEE LIST
function generateUserList1() {
    $.post("./classes/load-user-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;
    });
}

function generateUserList2(currentPageNumberVar, orderByVar) {
    $.post("./classes/load-user-order-by-name.class.php", {
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);


        if (currentPageNumber <= arrayLengthHidden.innerHTML) {
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
                newChildTile.appendChild(newCard);

                //CARD HEADER
                var newCardHeader = document.createElement("header");
                newCardHeader.classList.add('card-header');
                newCard.appendChild(newCardHeader);

                //CARD HEADER PARAGRAPH
                var newCardHeaderParagraph = document.createElement("p");
                newCardHeaderParagraph.classList.add('card-header-title');
                newCardHeaderParagraph.innerHTML = jsonArray[i][4];
                newCardHeader.appendChild(newCardHeaderParagraph);

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
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View Profile";
                newCardFooter.appendChild(newCardFooterLink);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}

function generateUserList3(searchTerm) {
    $.post("./classes/load-user-live-search.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);

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
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.innerHTML = "View Profile";
    newCardFooter.appendChild(newCardFooterLink);

    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}

function refreshList() {
    generateUserList1();
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList2(1, selectSort.value);
}

window.addEventListener('scroll', () => {
    let scrollable = document.documentElement.scrollHeight - window.innerHeight;
    let scrolled = window.scrollY;

    if (Math.ceil(scrolled) === scrollable) {
        currentPageNumber = currentPageNumber + 1;
        generateUserList2(currentPageNumber, selectSort.value);
    }

});

selectSort.addEventListener('change', () => {

    test_indicator.innerHTML = selectSort.value;
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

generateUserList1();

generateUserList2(1, selectSort.value);
