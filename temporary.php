//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let usernameEdit = document.getElementById('usernameEdit')
let passwordEdit = document.getElementById('passwordEdit')
let confirmPasswordEdit = document.getElementById('confirmPasswordEdit')
let firstNameEdit = document.getElementById('firstNameEdit')
let middleNameEdit = document.getElementById('middleNameEdit')
let lastNameEdit = document.getElementById('lastNameEdit')
let roleNameEdit = document.getElementById('roleNameEdit')

let usernameEditHelp = document.getElementById('usernameEditHelp')
let passwordEditHelp = document.getElementById('passwordEditHelp')
let confirmPasswordEditHelp = document.getElementById('confirmPasswordEditHelp')
let firstNameEditHelp = document.getElementById('firstNameEditHelp')
let middleNameEditHelp = document.getElementById('middleNameEditHelp')
let lastNameEditHelp = document.getElementById('lastNameEditHelp')

function editAjax() {
    $.post("./classes/edit-employee-controller.class.php", {
        usernameEdit: usernameEdit.value,
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

    let usernameEditMessages = []
    let passwordEditMessages = []
    let confirmPasswordEditMessages = []

    let firstNameEditMessages = []
    let middleNameEditMessages = []
    let lastNameEditMessages = []

    //Username Validation

    if (pattern1.test(usernameEdit.value) == false) {
        usernameEdit.className = "input is-danger is-rounded"
        usernameEditHelp.className = "help is-danger"
        usernameEditMessages.push('Username should only consist of numbers, letters, or an underscore!')
    }

    if (usernameEdit.value === "" || usernameEdit.value == null) {
        usernameEdit.className = "input is-danger is-rounded"
        usernameEditHelp.className = "help is-danger"
        usernameEditMessages.push('Username is required!')
    }
    if (usernameEdit.value.length <= 6) {
        usernameEdit.className = "input is-danger is-rounded"
        usernameEditHelp.className = "help is-danger"
        usernameEditMessages.push('Username must be longer than 6 characters!')
    }

    if (usernameEdit.value.length >= 20) {
        usernameEdit.className = "input is-danger is-rounded"
        usernameEditHelp.className = "help is-danger"
        usernameEditMessages.push('Username must be less than 20 characters!')
    }

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
    if (usernameEditMessages.length > 0) {
        e.preventDefault()
        usernameEditHelp.innerText = usernameEditMessages.join(', ');
    }

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
        usernameEditMessages.length <= 0 &&
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
    usernameEdit.className = "input is-rounded"
    usernameEditHelp.className = "help"
    usernameEditHelp.innerText = ""

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
    usernameEdit.value = null;
    passwordEdit.value = null;
    confirmPasswordEdit.value = null;
    firstNameEdit.value = null;
    middleNameEdit.value = null;
    lastNameEdit.value = null;
}
