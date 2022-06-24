//PART OF NEW SYSTEM

let usernameAdd = document.getElementById('usernameAdd')
let passwordAdd = document.getElementById('passwordAdd')
let confirmPasswordAdd = document.getElementById('confirmPasswordAdd')

let firstNameAdd = document.getElementById('firstNameAdd')
let middleNameAdd = document.getElementById('middleNameAdd')
let lastNameAdd = document.getElementById('lastNameAdd')

let usernameAddHelp = document.getElementById('usernameAddHelp')
let passwordAddHelp = document.getElementById('passwordAddHelp')
let confirmPasswordAddHelp = document.getElementById('confirmPasswordAddHelp')

let firstNameAddHelp = document.getElementById('firstNameAddHelp')
let middleNameAddHelp = document.getElementById('middleNameAddHelp')
let lastNameAddHelp = document.getElementById('lastNameAddHelp')

let signUpUserForm = document.getElementById('signUpUserForm')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/



signUpUserForm.addEventListener('submit', (e) => {
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

const companyNameSelect = document.getElementById('companyNameSelect')

function populateSelect() {
    $.post("./classes/load-company-select.class.php", {
    }, function (data1) {

        var jsonArray1 = JSON.parse(data1);

        for (var i = 0; i < jsonArray1.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray1[i][0];
            newOption.innerHTML = jsonArray1[i][0];
            companyNameSelect.options.add(newOption);
        }

        //closeSelect();
    });
}
populateSelect();

/*
  function removeSelect(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
       selectElement.remove(i);
    }
 }
 */