//MANIPULATING MODALS
const editModal = document.getElementById('editModal');

function openEdit(){
    //document.getElementById('vehiclePlateNumberEdit').setAttribute('value', editVal);
    editModal.classList.add('is-active');
}

function closeEdit(){
  //clearEditFormHelp();
  //clearEditFormInput();
    editModal.classList.remove('is-active');
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button

let passwordEdit = document.getElementById('passwordEdit')

let passwordEditHelp = document.getElementById('passwordEditHelp')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

function editAjax(){
    $.post("./classes/edit-password-employee-controller.class.php", {
      passwordEdit : passwordEdit.value
    }, function(data){
    $("#submitEditFormHelp").html(data);
    $("#submitEditFormHelp").attr('class', 'help is-success');
    //clearEditFormHelp();
    //clearEditFormInput();
    //editModal.classList.remove('is-active');
    });
}

submitEditForm.addEventListener('click', (e) => {
    //clearEditFormHelp();

    let passwordEditMessages = []
    let confirmPasswordEditMessages = []

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

  //Messages
  if (passwordEditMessages.length > 0) {
    e.preventDefault()
    passwordEditHelp.innerText = passwordEditMessages.join(', ')
  }

  if (confirmPasswordEditMessages.length > 0) {
    e.preventDefault()
    confirmPasswordEditHelp.innerText = confirmPasswordEditMessages.join(', ')
  }

  if(
    passwordEditMessages.length <= 0 && 
    confirmPasswordEditMessages.length <= 0
    ){
        editAjax();
    }
})

function clearEditFormHelp(){
  //RESETTING FORM ELEMENTS
  passwordEdit.className = "input is-rounded"
  passwordEditHelp.className = "help"
  passwordEditHelp.innerText = ""

  confirmPasswordEdit.className = "input is-rounded"
  confirmPasswordEditHelp.className = "help"
  confirmPasswordEditHelp.innerText = ""

}
function clearEditFormInput(){
  passwordEdit.value = null;
  confirmPasswordEdit.value = null;
}

function generateCompanyInfo() {
  $.post("./classes/load-company-info.class.php", {}, function (data) {
      var jsonArray = JSON.parse(data);
  });
}