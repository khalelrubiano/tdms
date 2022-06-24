<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABLE TEST</title>

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!--AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--BULMA CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!--FONTAWESOME CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--NAVBAR CSS-->
    <link rel="stylesheet" href="navbar.css">

    <!--INTERNAL CSS-->
    <style>

    </style>
</head>

<body>
    <section class="section">
        <div class="container">

            <table class="table is-fullwidth" id="myTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="tableTbody">

                </tbody>
            </table>

            <nav class="pagination mt-6">
                <ul class="pagination-list">
                    <li>
                        <a class="pagination-link is-current" id="paginationIndicatorBtn">1</a>
                        <a class="pagination-link is-hidden" id="arrayLengthHidden"></a>
                    </li>
                </ul>
                <a class="pagination-previous is-disabled" id="paginationPreviousBtn">Previous</a>
                <a class="pagination-next" id="paginationNextBtn">Next page</a>
            </nav>
        </div>
    </section>
</body>

<!--EXTERNAL JAVASCRIPT
<script src="js/login.js"></script>
-->
<!--INTERNAL JAVASCRIPT-->
<script>
    let paginationIndicatorBtn = document.getElementById('paginationIndicatorBtn')
    let arrayLengthHidden = document.getElementById('arrayLengthHidden')
    let paginationPreviousBtn = document.getElementById('paginationPreviousBtn')
    let paginationNextBtn = document.getElementById('paginationNextBtn')
    let tableTbody = document.getElementById('tableTbody')
    let myTable = document.getElementById('myTable')

    function generateEmployeeListTable1() {
        $.post("./classes/load-user-employee.class.php", {}, function(data) {

            var jsonArray = JSON.parse(data);

            arrayLengthHidden.innerHTML = Math.ceil(jsonArray.length / 2); //1 is the number of results per page
        });
    }

    function generateEmployeeListTable2(currentPageNumberVar) {
        $.post("./classes/load-user-employee-pagination.class.php", {
            currentPageNumber: currentPageNumberVar
        }, function(data) {

            var jsonArray = JSON.parse(data);

            tableTbody.innerHTML = ''
            
            //HTML TABLE (FLICKER JAVASCRIPT)
            for (var i = 0; i < jsonArray.length; i++) {

                var newTableRow = document.createElement("tr");

                var newTableData1 = document.createElement("td");
                var newTableData2 = document.createElement("td");
                var newTableData3 = document.createElement("td");
                var newTableData4 = document.createElement("td");
                var newTableData5 = document.createElement("td");
                var newTableData6 = document.createElement("td");

                newTableData1.setAttribute("data-label", "Username");
                newTableData2.setAttribute("data-label", "Role");
                newTableData3.setAttribute("data-label", "First Name");
                newTableData4.setAttribute("data-label", "Middle Name");
                newTableData5.setAttribute("data-label", "Last Name");
                newTableData6.setAttribute("data-label", "Created At");

                newTableData1.innerHTML = jsonArray[i][0];
                newTableData2.innerHTML = jsonArray[i][1];
                newTableData3.innerHTML = jsonArray[i][2];
                newTableData4.innerHTML = jsonArray[i][3];
                newTableData5.innerHTML = jsonArray[i][4];
                newTableData6.innerHTML = jsonArray[i][5];
                /*
                            newTableData1.innerHTML = "sample";
                            newTableData2.innerHTML = "sample";
                            newTableData3.innerHTML = "sample";
                            newTableData4.innerHTML = "sample";
                            newTableData5.innerHTML = "sample";
                            newTableData6.innerHTML = "sample";
                */
                newTableRow.appendChild(newTableData1);
                newTableRow.appendChild(newTableData2);
                newTableRow.appendChild(newTableData3);
                newTableRow.appendChild(newTableData4);
                newTableRow.appendChild(newTableData5);
                newTableRow.appendChild(newTableData6);

                tableTbody.appendChild(newTableRow);

            }
        });
    }

    generateEmployeeListTable1();
    generateEmployeeListTable2(1);

    let currentPageNumber = 1;

    //var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

    paginationNextBtn.addEventListener('click', () => {

        if (currentPageNumber < parseInt(arrayLengthHidden.innerHTML)) {
            //tableTbody.innerHTML = "";
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
            //tableTbody.innerHTML = "";
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
</script>

</html>