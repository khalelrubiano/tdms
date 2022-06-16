<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    shipment.dateOfDelivery,
    shipment.shipmentNumber,
    shipment.destination,
    shipment.areaRate
    FROM payslip
    INNER JOIN billedshipment
    ON payslip.billingInvoiceNumber = billedshipment.billingInvoiceNumber
    AND payslip.companyName = billedshipment.companyName
    INNER JOIN shipment
    ON billedshipment.shipmentNumber = shipment.shipmentNumber
    AND payslip.vehiclePlateNumber = shipment.vehiclePlateNumber
    AND billedshipment.companyName = shipment.companyName
    WHERE payslip.payslipNumber = :payslipNumber
    AND payslip.companyName = :companyName";


    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":payslipNumber", $paramPayslipNumber, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramPayslipNumber = $_GET["payslipNumber"];
    $paramCompanyName = $_SESSION["companyName"];
    
    $stmt->execute();
    $row = $stmt->fetchAll();
    $json = json_encode($row);

    echo $json;

} catch (Exception $ex) {
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../modal-prompt.php');
    exit();
}