
const tableTbody = document.getElementById('tableTbody')

function generateDefaultUsersTable() {
    $.post("./classes/load-user.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newTableRow = document.createElement("tr");
            tableTbody.appendChild(newTableRow);

            var newTableData1 = document.createElement("td");
            var newTableData2 = document.createElement("td");
            var newTableData3 = document.createElement("td");
            var newTableData4 = document.createElement("td");
            var newTableData5 = document.createElement("td");
            var newTableData6 = document.createElement("td");

            newTableData1.setAttribute("data-label","Username");
            newTableData2.setAttribute("data-label","Role");
            newTableData3.setAttribute("data-label","First Name");
            newTableData4.setAttribute("data-label","Middle Name");
            newTableData5.setAttribute("data-label","Last Name");
            newTableData6.setAttribute("data-label","Created At");

            newTableRow.appendChild(newTableData1);
            newTableRow.appendChild(newTableData2);
            newTableRow.appendChild(newTableData3);
            newTableRow.appendChild(newTableData4);
            newTableRow.appendChild(newTableData5);
            newTableRow.appendChild(newTableData6);

            newTableData1.innerHTML = jsonArray[i][0];
            newTableData2.innerHTML = jsonArray[i][6];
            newTableData3.innerHTML = jsonArray[i][2];
            newTableData4.innerHTML = jsonArray[i][3];
            newTableData5.innerHTML = jsonArray[i][4];
            newTableData6.innerHTML = jsonArray[i][5];
        }
    });
}

generateDefaultUsersTable();