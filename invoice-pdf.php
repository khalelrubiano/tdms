<?php
if (!isset($_SESSION)) {
    session_start();
}

header("Refresh: 1; url = billing-profile.php");
?>

<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .parentDiv {
            display: flex;
            justify-content: center;

        }

        .parentDiv2 {
            display: flex;
        }

        .parentDiv3 {
            display: flex;
            justify-content: space-around;
        }

        img {
            height: 75px;
            margin-right: 50px;

        }

        h1 {
            font-size: 12px;
        }

        .companyh1 {
            font-size: 12px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            text-align: center;
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Generating PDF...</h1>
</body>

<script>
    var var1 = 'test';

    var pdfbody = '<html><head><style>.parentDiv {display: flex;justify-content: center;} .parentDiv2 {display: flex;} .parentDiv3 {display: flex;justify-content: space-around;} img {height: 75px;margin-right: 50px;} h1 {font-size: 12px;} .companyh1 {font-size: 12px;} table {width: 100%;table-layout: fixed;} table,th,td {border: 1px solid black;border-collapse: collapse;} td {text-align: center;padding-top: 5px;padding-bottom: 5px;} </style></head>' +
        '<body><div id="pdfbody">' +
        '<h1 style="text-align: center; font-size: 20px;">' + '<?php echo $_SESSION["companyNameTD"] ?>' + '</h1>' +
        '<div class="parentDiv" style="border-bottom: 1px solid black; margin-bottom: 10px;"><div class="childDiv">' +
        '<img src="' + '<?php echo $_SESSION["companyLogoHidden"] ?>' + '"></div><div class="childDiv">' +
        '<h1 class="companyh1">' + '<?php echo $_SESSION["companyAddressTD"] ?>' + '</h1>' +
        '<h1 class="companyh1">' + '<?php echo $_SESSION["companyTinTD"] ?>' + '</h1>' +
        '<h1 class="companyh1">' + '<?php echo $_SESSION["companyEmailTD"] ?>' + '</h1>' +
        '<h1 class="companyh1">' + '<?php echo $_SESSION["companyNumberTD"] ?>' + '</h1></div></div>' +
        '<div class="parentDiv2" style="margin-bottom: 30px;">' +
        '<div class="childDiv">' +
        '<h1>' + '<?php echo $_SESSION["invoiceNumberTD"] ?>' + '</h1>' +
        '<h1>' + '<?php echo $_SESSION["coveredDateTD"] ?>' + '</h1>' +
        '<h1>' + '<?php echo $_SESSION["invoiceDateTD"] ?>' + '</h1>' +
        '</div>' +
        '</div>' +
        '<div class="parentDiv2" style="margin-bottom: 30px;">' +
        '<div class="childDiv">' +
        '<h1>' + '<?php echo $_SESSION["clientTD"] ?>' + '</h1>' +
        '<h1>' + '<?php echo $_SESSION["clientTinTD"] ?>' + '</h1>' +
        '<h1>' + '<?php echo $_SESSION["clientAddressTD"] ?>' + '</h1>' +
        '</div>' +
        '</div>' +
        '<div style="margin-bottom: 30px;">' +
        '<h1>This is to bill you for trucking service:</h1>' +
        '<table>' +
        '<tbody>' +
        '<tr>' +
        '<td class="table1TD">TRUCK COST:</td>' +
        '<td class="table1TD" id="truckCostTD">' + '<?php echo $_SESSION["truckCostTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">DROP FEE:</th>' +
        '<td class="table1TD" id="dropFeeTD">' + '<?php echo $_SESSION["dropFeeTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">PARKING FEE:</td>' +
        '<td class="table1TD" id="parkingFeeTD">' + '<?php echo $_SESSION["parkingFeeTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">TOLL FEE:</td>' +
        '<td class="table1TD" id="tollFeeTD">' + '<?php echo $_SESSION["tollFeeTD"] ?>'+ '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">FUEL CHARGE:</td>' +
        '<td class="table1TD" id="fuelChargeTD">' + '<?php echo $_SESSION["fuelChargeTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">EXTRA HELPER:</td>' +
        '<td class="table1TD" id="extraHelperTD">' + '<?php echo $_SESSION["extraHelperTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">DEMURRAGE:</td>' +
        '<td class="table1TD" id="demurrageTD">' + '<?php echo $_SESSION["demurrageTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">OTHER MISC FEE:</td>' +
        '<td class="table1TD" id="miscFeeTD">' + '<?php echo $_SESSION["miscFeeTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">SUBTOTAL:</td>' +
        '<td class="table1TD" id="subtotalTD">' + '<?php echo $_SESSION["subtotalTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">12% VAT:</td>' +
        '<td class="table1TD" id="vatTD">' + '<?php echo $_SESSION["vatTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">LESS PENALTIES:</td>' +
        '<td class="table1TD" id="penaltyTD">' + '<?php echo $_SESSION["penaltyTD"] ?>' + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="table1TD">TOTAL TRUCKING CHARGES:</td>' +
        '<td class="table1TD" id="totalTD">' + '<?php echo $_SESSION["totalTD"] ?>' + '</td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '<h1>TERMS: Balance due in 30 days.</h1>' +
        '</div>' +
        '<div class="parentDiv3">' +
        '<div class="childDiv" style="margin-right: 100px;">' +
        '<h1>Received by:_______________</h1>' +
        '</div>' +
        '<div class="childDiv">' +
        '<h1 style="margin-bottom: 50px;">________________________________________</h1>' +
        '<h1 style="text-align: center;">LOGISTIC MANAGER</h1>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</body>' +
        '</html>'

    var opt = {
        margin: 0.5,
        filename: 'invoice.pdf',
        image: {
            type: 'jpeg',
            quality: 1
        },
        html2canvas: {
            scale: 1
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    };

    html2pdf(pdfbody, opt);
</script>

</html>