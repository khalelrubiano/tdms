<?php
//PART OF NEW SYSTEM
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
    $subcontractorId = $_POST['subcontractorId'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST["lastName"];
    $groupId = $_POST['groupId'];
    $groupName = $_POST['groupName'];
    $companyId = $_SESSION["companyId"];*/

    $_SESSION["companyNameTD"] = $_POST['companyNameTD'];
    $_SESSION["companyAddressTD"] = $_POST['companyAddressTD'];
    $_SESSION["companyTinTD"] = $_POST['companyTinTD'];
    $_SESSION["companyEmailTD"] = $_POST['companyEmailTD'];
    $_SESSION["companyNumberTD"] = $_POST['companyNumberTD'];
    $_SESSION["invoiceNumberTD"] = $_POST['invoiceNumberTD'];
    $_SESSION["coveredDateTD"] = $_POST['coveredDateTD'];
    $_SESSION["invoiceDateTD"] = $_POST['invoiceDateTD'];
    $_SESSION["clientTD"] = $_POST['clientTD'];
    $_SESSION["clientTinTD"] = $_POST['clientTinTD'];
    $_SESSION["clientAddressTD"] = $_POST['clientAddressTD'];
    $_SESSION["truckCostTD"] = $_POST['truckCostTD'];
    $_SESSION["dropFeeTD"] = $_POST['dropFeeTD'];
    $_SESSION["parkingFeeTD"] = $_POST['parkingFeeTD'];
    $_SESSION["tollFeeTD"] = $_POST['tollFeeTD'];
    $_SESSION["fuelChargeTD"] = $_POST['fuelChargeTD'];
    $_SESSION["extraHelperTD"] = $_POST['extraHelperTD'];
    $_SESSION["demurrageTD"] = $_POST['demurrageTD'];
    $_SESSION["miscFeeTD"] = $_POST['miscFeeTD'];
    $_SESSION["subtotalTD"] = $_POST['subtotalTD'];
    $_SESSION["vatTD"] = $_POST['vatTD'];
    $_SESSION["penaltyTD"] = $_POST['penaltyTD'];
    $_SESSION["totalTD"] = $_POST['totalTD'];
    $_SESSION["companyLogoHidden"] = $_POST['companyLogoHidden'];
    $_SESSION["invoiceNumberHidden"] = $_POST['invoiceNumberHidden'];
    $_SESSION["clientHidden"] = $_POST['clientHidden'];

    //header("location: ../subcontractor-group-profile.php");
    //exit();
    echo $_SESSION["companyNameTD"] 
    . "<br>" . $_SESSION["companyAddressTD"] 
    . "<br>" . $_SESSION["companyTinTD"] 
    . "<br>" . $_SESSION["companyEmailTD"] 
    . "<br>" . $_SESSION["companyNumberTD"] 
    . "<br>" . $_SESSION["invoiceNumberTD"] 
    . "<br>" . $_SESSION["coveredDateTD"] 
    . "<br>" . $_SESSION["invoiceDateTD"] 
    . "<br>" . $_SESSION["clientTD"] 
    . "<br>" . $_SESSION["clientTinTD"] 
    . "<br>" . $_SESSION["clientAddressTD"] 
    . "<br>" . $_SESSION["truckCostTD"] 
    . "<br>" . $_SESSION["dropFeeTD"] 
    . "<br>" . $_SESSION["parkingFeeTD"] 
    . "<br>" . $_SESSION["tollFeeTD"] 
    . "<br>" . $_SESSION["fuelChargeTD"] 
    . "<br>" . $_SESSION["extraHelperTD"] 
    . "<br>" . $_SESSION["demurrageTD"] 
    . "<br>" . $_SESSION["miscFeeTD"] 
    . "<br>" . $_SESSION["subtotalTD"] 
    . "<br>" . $_SESSION["vatTD"] 
    . "<br>" . $_SESSION["penaltyTD"] 
    . "<br>" . $_SESSION["totalTD"] 
    . "<br>" . $_SESSION["companyLogoHidden"];
}
