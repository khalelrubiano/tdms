<?php
if (!isset($_SESSION)) {
    session_start();
}

header("Refresh: 1; url = payroll.php");
?>

<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!--AJAX CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    let billingId = '<?php echo $_SESSION["invoiceNumberPDF"] ?>';


    function generateBatchPDF() {
        $.post("./classes/load-payroll-id.class.php", {
            billingId: billingId
        }, function(data) {
            var jsonArray = JSON.parse(data);

            for (var i = 0; i < jsonArray.length; i++) {
                setVariable(jsonArray[i][0]);
                //alert(jsonArray[i][0]);
            }

            //alert(jsonArray[0][0]);
        });
    }

    function setVariable(payrollIdVar) {
        $.post("./classes/load-payslip-batch-pdf.class.php", {
            payrollId: payrollIdVar
        }, function(data) {
            //alert(data);

            var jsonArray = JSON.parse(data);
            var json3 = jsonArray[3];

            if (jsonArray[3] == null) {
                json3 = ' ';
            }

            let currentDate = new Date();
            let cDay = ("0" + currentDate.getDate()).slice(-2);
            let cMonth = ("0" + (currentDate.getMonth() + 1)).slice(-2);
            let cYear = currentDate.getFullYear();
            let finalDate = cYear + "-" + cMonth + "-" + cDay;

            var plateNumberVar = jsonArray[1];
            var ownerVar = jsonArray[0];
            var invoiceNumberVar = jsonArray[12];

            var finalString = plateNumberVar + '_' + ownerVar + '_' + invoiceNumberVar + '_' + finalDate + '.pdf';

            var opt = {
                margin: 0.75,
                filename: finalString,
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
                        <h1>Owner: ` + jsonArray[0] + ` </h1>
                        <h1>PLATE No.: ` + jsonArray[1] + ` </h1>
                        <h1>Date: ` + jsonArray[2] + ` </h1>
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
                        <p> ` + json3 + ` </p>
                    </div>

                    <div class="parentDiv" style="border-bottom: 1px solid black; margin-bottom: 25px;">
                        <div class="childDiv" style="padding: 25px;">
                            <table id="feesTable1">

                                <tbody id="tableTbody">
                                    <tr>
                                        <td>TRUCK RATE:</td>
                                        <td> ` + jsonArray[4] + ` </td>
                                    </tr>
                                    <tr>
                                        <td>DROP OFF:</td>
                                        <td> ` + jsonArray[5] + ` </td>
                                    </tr>
                                    <tr>
                                        <td>PENALTY:</td>
                                        <td> ` + jsonArray[6] + ` </td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td> ` + jsonArray[7] + ` </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="childDiv" style="padding: 25px;">
                            <table id="feesTable2">

                                <tbody id="tableTbody">
                                    <tr>
                                        <td>WHT 1%</td>
                                        <td> ` + jsonArray[8] + ` </td>
                                    </tr>
                                    <tr>
                                        <td>Less  ` + jsonArray[9] + ` %</td>
                                        <td> ` + jsonArray[10] + ` </td>
                                    </tr>
                                    <tr>
                                        <td>Net Pay</td>
                                        <td> ` + jsonArray[11] + ` </td>
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

            let completehtml = tophtml + jsonArray[13] + bottomhtml;

            html2pdf(completehtml, opt);

            //alert('')
        });
    }

    generateBatchPDF();
</script>

</html>