//ADD AJAX CALLS WITH VALIDATION
let submitEditForm = document.getElementById('submitEditForm'); //save changes button
let submitEditFormHelp = document.getElementById('submitEditFormHelp'); //save changes button

let groupNameEdit = document.getElementById('groupNameEdit')
let groupOwnerEdit = document.getElementById('groupOwnerEdit')

let groupNameEditHelp = document.getElementById('groupNameEditHelp')


function editAjax() {
    $.post("./classes/edit-subcontractor-group-controller.class.php", {
        groupNameEdit: groupNameEdit.value,
        groupOwnerEdit: groupOwnerEdit.value
    }, function (data) {
        $("#submitEditFormHelp").html(data);
        //$("#submitEditFormHelp").attr('class', 'help is-success');
        //clearEditFormHelp();
        //clearEditFormInput();
        //editModal.classList.remove('is-active');
        refreshList();
    });
}