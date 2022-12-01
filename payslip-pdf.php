<?php
if (!isset($_SESSION)) {
    session_start();
}

header("Refresh: 1; url = payslip-profile.php");
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

        h1,
        p {
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
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Generating PDF...</h1>
</body>

<script>
    let pdfbody = document.getElementById('pdfbody');

    let tophtml = `
    <html>
    <head>
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

        h1, p {
            font-size: 14px;
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
            font-size: 12px;
        }
        </style>
        </head>
    <body>
    <div id="pdfbody">
        <div style="text-align: center; margin-bottom: 10px;">
            <h1>Owner: ` + `<?php echo $_SESSION["ownerHeader"] ?>` + ` </h1>
            <h1>PLATE No.: ` + `<?php echo $_SESSION["plateNumberHeader"] ?>` + ` </h1>
            <h1>Date: ` + `<?php echo $_SESSION["dateHeader"] ?>` + ` </h1>
        </div>

        <div style="min-height: 300px">
            <table id="shipmentTable" style="margin-bottom: 10px;">
                <thead>
                    <tr style="background-color: lightgray;">
                        <td>DATE</td>
                        <td>SHIPMENT No.</td>
                        <td>DESTINATION</td>
                        <td>AREA</td>
                        <td>RATE</td>
                        <td>DROP OFF</td>
                        <td>PENALTY</td>
                    </tr>
                </thead>
                <tbody id="tableTbody">`
    let bottomhtml = `</tbody>
            </table>
        </div>

        <div style="margin-bottom: 10px; min-height: 75px; border: 1px solid black; padding: 10px;">
            <h1>Remarks:</h1>
            <p> ` + `<?php echo $_SESSION["remarksHeader"] ?>` + ` </p>
        </div>

        <div class="parentDiv" style="border-bottom: 1px solid black; margin-bottom: 25px;">
            <div class="childDiv" style="padding: 25px;">
                <table id="feesTable1">

                    <tbody id="tableTbody">
                        <tr>
                            <td>TRUCK RATE:</td>
                            <td> ` + `<?php echo $_SESSION["truckRateTD"] ?>` + ` </td>
                        </tr>
                        <tr>
                            <td>DROP OFF:</td>
                            <td> ` + `<?php echo $_SESSION["dropOffTD"] ?>` + ` </td>
                        </tr>
                        <tr>
                            <td>PENALTY:</td>
                            <td> ` + `<?php echo $_SESSION["penaltyTD"] ?>` + ` </td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                            <td> ` + `<?php echo $_SESSION["totalTD"] ?>` + ` </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="childDiv" style="padding: 25px;">
                <table id="feesTable2">

                    <tbody id="tableTbody">
                        <tr>
                            <td>WHT 1%</td>
                            <td> ` + `<?php echo $_SESSION["taxTD"] ?>` + ` </td>
                        </tr>
                        <tr>
                            <td>Less  ` + `<?php echo $_SESSION["lessTDHeader"] ?>` + ` %</td>
                            <td> ` + `<?php echo $_SESSION["lessTD"] ?>` + ` </td>
                        </tr>
                        <tr>
                            <td>Net Pay</td>
                            <td> ` + `<?php echo $_SESSION["netPayTD"] ?>` + ` </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div style="margin-left: 35%;">
            <h1>Received by:</h1>
            <h1>_______________________________________</h1>
            <h1 style="margin-left: 25px;">Signature Over Printed Name/Date</h1>
        </div>
    </div>
</body></html>`

    let currentDate = new Date();
    let cDay = ("0" + currentDate.getDate()).slice(-2);
    let cMonth = ("0" + (currentDate.getMonth() + 1)).slice(-2);
    let cYear = currentDate.getFullYear();
    let finalDate = cYear + "-" + cMonth + "-" + cDay;

    let pdfname = '2GO_202201_2022-11-29';

    var opt = {
        margin: 0.75,
        filename: '<?php echo $_SESSION["plateNumberHeader"] ?>' + '_' + '<?php echo $_SESSION["ownerHeader"] ?>' + '_' + '<?php echo $_SESSION["invoiceNumberHeader"] ?>' + '_' + finalDate + '.pdf',
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

    let completehtml = tophtml + '<?php echo $_SESSION["shipmenthtml"] ?>' + bottomhtml;

    var var1 = '<?php echo $_SESSION["shipmenthtml"] ?>';

    //alert(var1);



    html2pdf(completehtml, opt);
</script>

</html>