//GENERATING DATATABLE
var userDatatable = $('#userTable').DataTable({
    "ajax": {
        "url": "classes/load-user.class.php",
        "dataSrc": ""
    },
    "columns": [
        {"data": "username"},
        {"data": "password"},
        {"data": "accessType"},
        {"data": "firstName"},
        {"data": "middleName"},
        {"data": "lastName"},
        {"data": "createdAt"},
        {"data": null, "width": "115px", "render": function(s_data, s_type, s_row){
            if(s_row[2] == "Admin"){
              
              return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openEditAdmin(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-edit"></i> </button>';
            }
            else{
            return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openEdit(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-edit"></i> </button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openDelete(' + "'" + s_row[0] + "'" + ', ' + "'" + s_row[1] + "'" + ', ' + "'" + s_row[2] + "'" + ', ' + "'" + s_row[3] + "'" + ', ' + "'" + s_row[4] + "'" + ', ' + "'" + s_row[5] + "'" + ')"> <i class="fas fa-trash-alt"></i> </button>';}
        }}
    ]
});
var adminEditVar;
//MANIPULATING MODALS
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');
const deleteModal = document.getElementById('deleteModal');
const accessTypeEditField = document.getElementById('accessTypeEditField');

function openAdd(){
    addModal.classList.add('is-active');
}

function closeAdd(){
    clearAddFormHelp();
    clearAddFormInput();
    addModal.classList.remove('is-active');
}




function openEdit(editVal){
    accessTypeEditField.className = 'field';
    adminEditVar = "";
    document.getElementById('usernameEdit').setAttribute('value', editVal);
    editModal.classList.add('is-active');
}



function openEditAdmin(editVal){
  
  accessTypeEditField.className = 'field is-hidden';

  adminEditVar = "Admin";
  document.getElementById('usernameEdit').setAttribute('value', editVal);
  editModal.classList.add('is-active');
}

function closeEdit(){
  clearEditFormHelp();
  clearEditFormInput();
    editModal.classList.remove('is-active');
}

function openDelete(deleteVal1, deleteVal2, deleteVal3, deleteVal4, deleteVal5, deleteVal6){

    document.getElementById('usernameDelete').setAttribute('value', deleteVal1);
    document.getElementById('passwordDelete').setAttribute('value', deleteVal2);
    document.getElementById('accessTypeDelete').setAttribute('value', deleteVal3);
    document.getElementById('firstNameDelete').setAttribute('value', deleteVal4);
    document.getElementById('middleNameDelete').setAttribute('value', deleteVal5);
    document.getElementById('lastNameDelete').setAttribute('value', deleteVal6);
    deleteModal.classList.add('is-active');
}

function closeDelete(){
    deleteModal.classList.remove('is-active');
}

function refreshTable(){
  userDatatable.ajax.reload();
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let usernameAdd = document.getElementById('usernameAdd')
let passwordAdd = document.getElementById('passwordAdd')
let confirmPasswordAdd = document.getElementById('confirmPasswordAdd')
let accessTypeAdd = document.getElementById('accessTypeAdd')
let firstNameAdd = document.getElementById('firstNameAdd')
let middleNameAdd = document.getElementById('middleNameAdd')
let lastNameAdd = document.getElementById('lastNameAdd')

let usernameAddHelp = document.getElementById('usernameAddHelp')
let passwordAddHelp = document.getElementById('passwordAddHelp')
let confirmPasswordAddHelp = document.getElementById('confirmPasswordAddHelp')
let accessTypeAddHelp = document.getElementById('accessTypeAddHelp')
let firstNameAddHelp = document.getElementById('firstNameAddHelp')
let middleNameAddHelp = document.getElementById('middleNameAddHelp')
let lastNameAddHelp = document.getElementById('lastNameAddHelp')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

function addAjax(){
    $.post("./classes/add-user-controller.class.php", {
        usernameAdd : usernameAdd.value,
        passwordAdd : passwordAdd.value, 
        accessTypeAdd : accessTypeAdd.value,
        firstNameAdd : firstNameAdd.value,
        middleNameAdd : middleNameAdd.value, 
        lastNameAdd : lastNameAdd.value
    }, function(data){
    $("#submitAddFormHelp").html(data);
    $("#submitAddFormHelp").attr('class', 'help is-success');
    clearAddFormHelp();
    clearAddFormInput();
    //addModal.classList.remove('is-active');
    });
}

submitAddForm.addEventListener('click', (e) => {
    clearAddFormHelp();
    let usernameAddMessages = []
    let passwordAddMessages = []
    let confirmPasswordAddMessages = []
    let accessTypeAddMessages = []
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

  //Access Type Validation
  if (accessTypeAdd.value === "" || accessTypeAdd.value == null) {
    accessTypeAdd.className = "input is-danger is-rounded"
    accessTypeAddHelp.className = "help is-danger"
    accessTypeAddMessages.push('Access type is required!')
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

  if (accessTypeAddMessages.length > 0) {
    e.preventDefault()
    accessTypeAddHelp.innerText = accessTypeAddMessages.join(', ')
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

    if(
        usernameAddMessages.length <= 0 && 
        passwordAddMessages.length <= 0 && 
        confirmPasswordAddMessages.length <= 0 && 
        accessTypeAddMessages.length <= 0 &&
        firstNameAddMessages.length <= 0 && 
        middleNameAddMessages.length <= 0 && 
        lastNameAddMessages.length <= 0
        ){
            addAjax();
        }
})

function clearAddFormHelp(){
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

  accessTypeAdd.className = "select is-rounded"
  accessTypeAddHelp.className = "help"
  accessTypeAddHelp.innerText = ""

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

function clearAddFormInput(){
  usernameAdd.value = null;
  passwordAdd.value = null;
  confirmPasswordAdd.value = null;
  firstNameAdd.value = null;
  middleNameAdd.value = null;
  lastNameAdd.value = null;
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button

let usernameEdit = document.getElementById('usernameEdit')
let passwordEdit = document.getElementById('passwordEdit')

let confirmPasswordEdit = document.getElementById('confirmPasswordEdit')
let accessTypeEdit = document.getElementById('accessTypeEdit')
let firstNameEdit = document.getElementById('firstNameEdit')
let middleNameEdit = document.getElementById('middleNameEdit')
let lastNameEdit = document.getElementById('lastNameEdit')

let usernameEditHelp = document.getElementById('usernameEditHelp')
let passwordEditHelp = document.getElementById('passwordEditHelp')

let confirmPasswordEditHelp = document.getElementById('confirmPasswordEditHelp')
let accessTypeEditHelp = document.getElementById('accessTypeEditHelp')
let firstNameEditHelp = document.getElementById('firstNameEditHelp')
let middleNameEditHelp = document.getElementById('middleNameEditHelp')
let lastNameEditHelp = document.getElementById('lastNameEditHelp')



var accessTypeSpecial;

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

function editAjax(){
  if(adminEditVar == "Admin"){
    accessTypeSpecial = adminEditVar;
    //accessTypeSpecial = accessTypeEdit.value;
  }else{
    //accessTypeSpecial = adminEditVar;
    accessTypeSpecial = accessTypeEdit.value;
  }
    $.post("./classes/edit-user-controller.class.php", {
        usernameEdit : usernameEdit.value,
        passwordEdit : passwordEdit.value, 
        accessTypeEdit : accessTypeSpecial,
        firstNameEdit : firstNameEdit.value,
        middleNameEdit : middleNameEdit.value, 
        lastNameEdit : lastNameEdit.value
    }, function(data){
    $("#submitEditFormHelp").html(data);
    $("#submitEditFormHelp").attr('class', 'help is-success');
    clearEditFormHelp();
    clearEditFormInput();
    editModal.classList.remove('is-active');
    });
}

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();
    let usernameEditMessages = []
    let passwordEditMessages = []
    let confirmPasswordEditMessages = []
    let accessTypeEditMessages = []
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

  if (passwordEdit.value.length >= 255) {
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

  //Access Type Validation
  if (accessTypeEdit.value === "" || accessTypeEdit.value == null) {
    accessTypeEdit.className = "input is-danger is-rounded"
    accessTypeEditHelp.className = "help is-danger"
    accessTypeEditMessages.push('Access type is required!')
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

  if (middleNameEdit.value.length >= 255) {
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

  if (lastNameEdit.value.length >= 255) {
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

  if (accessTypeEditMessages.length > 0) {
    e.preventDefault()
    accessTypeEditHelp.innerText = accessTypeEditMessages.join(', ')
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

    if(
        usernameEditMessages.length <= 0 && 
        passwordEditMessages.length <= 0 && 
        confirmPasswordEditMessages.length <= 0 && 
        accessTypeEditMessages.length <= 0 &&
        firstNameEditMessages.length <= 0 && 
        middleNameEditMessages.length <= 0 && 
        lastNameEditMessages.length <= 0
        ){
            editAjax();
        }
})

function clearEditFormHelp(){
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

  accessTypeEdit.className = "select is-rounded"
  accessTypeEditHelp.className = "help"
  accessTypeEditHelp.innerText = ""

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
function clearEditFormInput(){
  passwordEdit.value = null;
  confirmPasswordEdit.value = null;
  firstNameEdit.value = null;
  middleNameEdit.value = null;
  lastNameEdit.value = null;
  
}

//DELETE
let submitDeleteForm = document.getElementById('submitDeleteForm');
let usernameDelete = document.getElementById('usernameDelete');

function deleteAjax(){
    $.post("./classes/delete-user-controller.class.php", {
      usernameDelete : usernameDelete.value
    }, function(data){
    });
    userDatatable.ajax.reload();
}

submitDeleteForm.addEventListener('click', (e) => {
    deleteAjax();
    userDatatable.ajax.reload();
    deleteModal.classList.remove('is-active');
})
