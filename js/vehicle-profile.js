let returnBtn = document.getElementById('returnBtn')
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')
let currentPageNumber = 1;
const editModal = document.getElementById('editModal');
const addModal = document.getElementById('addModal');

const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const areaIdHidden = document.getElementById('areaIdHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')

function generateClientAreaListTable1() {
    $.post("./classes/load-vehicle-profile.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 5); //1 is the number of results per page
        //arrayLengthHidden.innerHTML = jsonArray.length;
        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}

function generateClientAreaListTable2(currentPageNumberVar) {
    $.post("./classes/load-vehicle-profile-pagination.class.php", {
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        tableTbody.innerHTML = "";


        for (var i = 0; i < jsonArray.length; i++) {
            //console.log(jsonArray[i][1]);

            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");

            var newTableData2 = document.createElement("td");

            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");

            newTableData1.setAttribute("data-label", "Shipment Number");

            newTableData2.setAttribute("data-label", "Shipment Status");

            newTableData3.setAttribute("data-label", "Billing");

            newTableData4.setAttribute("data-label", "Payroll");

            if (jsonArray[i][2] == "true") {
                var newBillingIcon = document.createElement("i");
                newBillingIcon.classList.add('fa-solid');
                newBillingIcon.classList.add('fa-check');
                newTableData3.appendChild(newBillingIcon);
            } else {
                var newBillingIcon = document.createElement("i");
                newBillingIcon.classList.add('fa-solid');
                newBillingIcon.classList.add('fa-xmark');
                newTableData3.appendChild(newBillingIcon);
            }

            if (jsonArray[i][3] == "true") {
                var newPayrollIcon = document.createElement("i");
                newPayrollIcon.classList.add('fa-solid');
                newPayrollIcon.classList.add('fa-check');
                newTableData4.appendChild(newPayrollIcon);
            } else {
                var newPayrollIcon = document.createElement("i");
                newPayrollIcon.classList.add('fa-solid');
                newPayrollIcon.classList.add('fa-xmark');
                newTableData4.appendChild(newPayrollIcon);
            }

            newTableData1.innerHTML = jsonArray[i][0];
            newTableData2.innerHTML = jsonArray[i][1];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);


        }
    });
}

function refreshTable() {
    generateClientAreaListTable1();
    generateClientAreaListTable2(1);
    currentPageNumber = 1;
}

generateClientAreaListTable1();
generateClientAreaListTable2(1);
//populateSelect5();

returnBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-vehicle.php";
});

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateClientAreaListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != 1) {
        paginationPreviousBtn.classList.remove("is-disabled");
    }

});

paginationPreviousBtn.addEventListener('click', () => {

    if (currentPageNumber > 1) {
        currentPageNumber = currentPageNumber - 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateClientAreaListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});

/*
selectSort.addEventListener('change', () => {

    indicator.innerHTML = selectSort.value;
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

populateSelect1();
populateSelect2();

generateUserList1();
generateUserList2(1, selectSort.value);*/