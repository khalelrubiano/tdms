const paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
const arrayLengthHidden = document.getElementById('arrayLengthHidden')
const paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
const paginationNextBtn = document.getElementById('paginationNextBtn')
const tableTbody = document.getElementById('tableTbody')

function generateEmployeeListTable1() {
    $.post("./classes/load-user-employee.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 2); //1 is the number of results per page

        if (parseInt(arrayLengthHidden.innerHTML) == 1) {
            paginationNextBtn.classList.add("is-disabled");
        }

    });
}

function generateEmployeeListTable2(currentPageNumberVar) {
    $.post("./classes/load-user-employee-pagination.class.php", {
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        tableTbody.innerHTML = "";

        //HTML TABLE (FLICKER JAVASCRIPT)
        for (var i = 0; i < jsonArray.length; i++) {

            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");
            var newTableData2 = document.createElement("td");
            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");
            var newTableData5 = document.createElement("td");
            var newTableData6 = document.createElement("td");

            var newEditBtn = document.createElement("button");
            newEditBtn.classList.add('button');
            newEditBtn.innerHTML = "Edit";

            newTableData1.setAttribute("data-label", "Username");

            newTableData6.appendChild(newEditBtn);


            newTableData1.setAttribute("data-label", "Username");
            newTableData2.setAttribute("data-label", "Role");
            newTableData3.setAttribute("data-label", "First Name");
            newTableData4.setAttribute("data-label", "Middle Name");
            newTableData5.setAttribute("data-label", "Last Name");
            newTableData6.setAttribute("data-label", "");

            newTableData1.innerHTML = jsonArray[i][0];
            newTableData2.innerHTML = jsonArray[i][1];
            newTableData3.innerHTML = jsonArray[i][2];
            newTableData4.innerHTML = jsonArray[i][3];
            newTableData5.innerHTML = jsonArray[i][4];

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);
            newTableRow.appendChild(newTableData5);
            newTableRow.appendChild(newTableData6);

        }
    });
}

generateEmployeeListTable1();
generateEmployeeListTable2(1);

let currentPageNumber = 1;

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

paginationNextBtn.addEventListener('click', () => {

    if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {

        currentPageNumber = currentPageNumber + 1;
        paginationIndicatorBtn.innerHTML = currentPageNumber;
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
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
        generateEmployeeListTable2(paginationIndicatorBtn.innerHTML);
    }

    if (currentPageNumber == 1) {
        paginationPreviousBtn.classList.add("is-disabled");
    }

    if (currentPageNumber != parseInt(arrayLengthHidden.innerHTML)) {
        paginationNextBtn.classList.remove("is-disabled");
    }

});