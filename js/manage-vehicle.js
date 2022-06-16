//GENERATING DATATABLE
var vehicleDatatable = $('#vehicleTable').DataTable({
    "ajax": {
        "url": "classes/load-vehicle.class.php",
        "dataSrc": ""
    },
    "columns": [
        {"data": "vehiclePlateNumber"},
        {"data": "ownerUsername"},
        {"data": "firstName"},
        {"data": "middleName"},
        {"data": "lastName"},
        {"data": "createdAt"},
        {"data": null, "width": "115px","render": function(s_data, s_type, s_row){

            return '<button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openEdit(' + "'" + s_row[0] + "'" + ')"> <i class="fas fa-edit"></i> </button> <button style="width: 20px;" class="button has-background-grey-dark is-size-6 has-text-white" onclick="openDelete(' + "'" + s_row[0] + "'" + ', ' + "'" + s_row[1] + "'" + ')"> <i class="fas fa-trash-alt"></i> </button>';
        }}
    ]
});

//MANIPULATING MODALS
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');
const deleteModal = document.getElementById('deleteModal');

function openAdd(){
    addModal.classList.add('is-active');
    populateUsernameAdd();
}

function closeAdd(){
    clearAddFormHelp();
    clearAddFormInput();
    addModal.classList.remove('is-active');
    removeSelectAdd(document.getElementById('usernameAdd'));
}

function openEdit(editVal){
    document.getElementById('vehiclePlateNumberEdit').setAttribute('value', editVal);
    editModal.classList.add('is-active');
    populateUsernameEdit();
}

function closeEdit(){
  //clearEditFormHelp();
  //clearEditFormInput();
    editModal.classList.remove('is-active');
    removeSelectAdd(document.getElementById('usernameEdit'));
}

function openDelete(deleteVal1, deleteVal2){

    document.getElementById('vehiclePlateNumberDelete').setAttribute('value', deleteVal1);
    document.getElementById('usernameDelete').setAttribute('value', deleteVal2);
    deleteModal.classList.add('is-active');
}

function closeDelete(){
    deleteModal.classList.remove('is-active');
}

function refreshTable(){
  vehicleDatatable.ajax.reload();
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button

let vehiclePlateNumberAdd = document.getElementById('vehiclePlateNumberAdd')
let usernameAdd = document.getElementById('usernameAdd')

let vehiclePlateNumberAddHelp = document.getElementById('vehiclePlateNumberAddHelp')
let usernameAddHelp = document.getElementById('usernameAddHelp')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern5 = /^[a-zA-Z0-9]+$/

function addAjax(){
    $.post("./classes/add-vehicle-controller.class.php", {
      vehiclePlateNumberAdd : vehiclePlateNumberAdd.value,
        usernameAdd : usernameAdd.value
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

    let vehiclePlateNumberAddMessages = []
    let usernameAddMessages = []

  //Vehicle Plate Number Validation
  if (pattern1.test(vehiclePlateNumberAdd.value) == false) {
    vehiclePlateNumberAdd.className = "input is-danger is-rounded"
    vehiclePlateNumberAddHelp.className = "help is-danger"
    vehiclePlateNumberAddMessages.push('Vehicle Plate Number should only consist of numbers and letters!')
  }

  if (vehiclePlateNumberAdd.value === "" || vehiclePlateNumberAdd.value == null) {
    vehiclePlateNumberAdd.className = "input is-danger is-rounded"
    vehiclePlateNumberAddHelp.className = "help is-danger"
    vehiclePlateNumberAddMessages.push('Vehicle Plate Number is required!')
  }

  if (vehiclePlateNumberAdd.value.length < 1) {
    vehiclePlateNumberAdd.className = "input is-danger is-rounded"
    vehiclePlateNumberAddHelp.className = "help is-danger"
    vehiclePlateNumberAddMessages.push('Vehicle Plate Number must be longer than 1 character!')
  }

  if (vehiclePlateNumberAdd.value.length > 255) {
    vehiclePlateNumberAdd.className = "input is-danger is-rounded"
    vehiclePlateNumberAddHelp.className = "help is-danger"
    vehiclePlateNumberAddMessages.push('Vehicle Plate Number must be less than 255 characters!')
  }

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

  //Messages
  if (vehiclePlateNumberAddMessages.length > 0) {
    e.preventDefault()
    vehiclePlateNumberAddHelp.innerText = vehiclePlateNumberAddMessages.join(', ')
  }

  if (usernameAddMessages.length > 0) {
    e.preventDefault()
    usernameAddHelp.innerText = usernameAddMessages.join(', ');
  }

    if(
        vehiclePlateNumberAddMessages.length <= 0 && 
        usernameAddMessages.length <= 0
        ){
            addAjax();
        }
})

function clearAddFormHelp(){
  //RESETTING FORM ELEMENTS
  vehiclePlateNumberAdd.className = "input is-rounded"
  vehiclePlateNumberAddHelp.className = "help"
  vehiclePlateNumberAddHelp.innerText = ""

  usernameAdd.className = "input is-rounded"
  usernameAddHelp.className = "help"
  usernameAddHelp.innerText = ""

}

function clearAddFormInput(){
  vehiclePlateNumberAdd.value = null;
  usernameAdd.value = null;
}

function populateUsernameAdd(){
  $.post("./classes/load-username-select.class.php", {
    }, function(data2){
      
      var jsonArray2 = JSON.parse(data2);

      for(var i=0;i < jsonArray2.length;i++){
      var newOption2 = document.createElement("option");
      newOption2.value = jsonArray2[i][0];
      newOption2.innerHTML = jsonArray2[i][0];
      usernameAdd.options.add(newOption2);
      }

      //closeSelect();
    });
    
}

function removeSelectAdd(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
    selectElement.remove(i);
   }
}

//EDIT AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button

let vehiclePlateNumberEdit = document.getElementById('vehiclePlateNumberEdit')
let usernameEdit = document.getElementById('usernameEdit')

let vehiclePlateNumberEditHelp = document.getElementById('vehiclePlateNumberEditHelp')
let usernameEditHelp = document.getElementById('usernameEditHelp')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern5 = /^[a-zA-Z0-9]+$/

function editAjax(){
    $.post("./classes/edit-vehicle-controller.class.php", {
      vehiclePlateNumberEdit : vehiclePlateNumberEdit.value,
        usernameEdit : usernameEdit.value
    }, function(data){
    $("#submitEditFormHelp").html(data);
    $("#submitEditFormHelp").attr('class', 'help is-success');
    clearEditFormHelp();
    clearEditFormInput();
    editModal.classList.remove('is-active');
    removeSelectAdd(document.getElementById('usernameEdit'));
    });
}

submitEditForm.addEventListener('click', (e) => {
    clearEditFormHelp();

    let vehiclePlateNumberEditMessages = []
    let usernameEditMessages = []

  //Vehicle Plate Number Validation
  if (pattern1.test(vehiclePlateNumberEdit.value) == false) {
    vehiclePlateNumberEdit.className = "input is-danger is-rounded"
    vehiclePlateNumberEditHelp.className = "help is-danger"
    vehiclePlateNumberEditMessages.push('Vehicle Plate Number should only consist of numbers and letters!')
  }

  if (vehiclePlateNumberEdit.value === "" || vehiclePlateNumberEdit.value == null) {
    vehiclePlateNumberEdit.className = "input is-danger is-rounded"
    vehiclePlateNumberEditHelp.className = "help is-danger"
    vehiclePlateNumberEditMessages.push('Vehicle Plate Number is required!')
  }

  if (vehiclePlateNumberEdit.value.length < 1) {
    vehiclePlateNumberEdit.className = "input is-danger is-rounded"
    vehiclePlateNumberEditHelp.className = "help is-danger"
    vehiclePlateNumberEditMessages.push('Vehicle Plate Number must be longer than 1 character!')
  }

  if (vehiclePlateNumberEdit.value.length > 255) {
    vehiclePlateNumberEdit.className = "input is-danger is-rounded"
    vehiclePlateNumberEditHelp.className = "help is-danger"
    vehiclePlateNumberEditMessages.push('Vehicle Plate Number must be less than 255 characters!')
  }

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

  //Messages
  if (vehiclePlateNumberEditMessages.length > 0) {
    e.preventDefault()
    vehiclePlateNumberEditHelp.innerText = vehiclePlateNumberEditMessages.join(', ')
  }

  if (usernameEditMessages.length > 0) {
    e.preventDefault()
    usernameEditHelp.innerText = usernameEditMessages.join(', ');
  }

    if(
        vehiclePlateNumberEditMessages.length <= 0 && 
        usernameEditMessages.length <= 0
        ){
            editAjax();
        }
})

function clearEditFormHelp(){
  //RESETTING FORM ELEMENTS
  vehiclePlateNumberEdit.className = "input is-rounded"
  vehiclePlateNumberEditHelp.className = "help"
  vehiclePlateNumberEditHelp.innerText = ""

  usernameEdit.className = "input is-rounded"
  usernameEditHelp.className = "help"
  usernameEditHelp.innerText = ""

}

function clearEditFormInput(){
  usernameEdit.value = null;
}

function populateUsernameEdit(){
  $.post("./classes/load-username-select.class.php", {
    }, function(data2){
      
      var jsonArray2 = JSON.parse(data2);

      for(var i=0;i < jsonArray2.length;i++){
      var newOption2 = document.createElement("option");
      newOption2.value = jsonArray2[i][0];
      newOption2.innerHTML = jsonArray2[i][0];
      usernameEdit.options.add(newOption2);
      }

      //closeSelect();
    });
    
}

//DELETE
let submitDeleteForm = document.getElementById('submitDeleteForm');
let vehiclePlateNumberDelete = document.getElementById('vehiclePlateNumberDelete');

function deleteAjax(){
    $.post("./classes/delete-vehicle-controller.class.php", {
      vehiclePlateNumberDelete : vehiclePlateNumberDelete.value
    }, function(data){
    });
    vehicleDatatable.ajax.reload();
}

submitDeleteForm.addEventListener('click', (e) => {
    deleteAjax();
    vehicleDatatable.ajax.reload();
    deleteModal.classList.remove('is-active');
})
