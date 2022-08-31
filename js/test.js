/*
refresh
placeholder text
icons
colors

*/



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

function refreshList() {
  ancestorTile.innerHTML = "";
  currentPageNumber = 1;
  generateUserList1();

  //generateUserList2(1, selectSort.value);
}

refreshList();
closeAdd();

clearAddFormHelp();
clearAddFormInput();

function clearAddFormHelp() {
  //RESETTING FORM ELEMENTS
  clientNameAdd.className = "input is-rounded"
  clientNameAddHelp.className = "help"
  clientNameAddHelp.innerText = ""
}

function clearAddFormInput() {
  clientNameAdd.value = null;

}