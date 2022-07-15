let returnBtn = document.getElementById('returnBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden');
//const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')

const addModal = document.getElementById('addModal');

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
    //populateUsernameAdd();
}

function closeAdd() {
    /*
    clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""
*/
    addModal.classList.remove('is-active');
    
    //removeSelectAdd(document.getElementById('usernameAdd'));
}

returnBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-group.php";
});