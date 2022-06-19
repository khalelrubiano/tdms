<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    payslip.payslipNumber,
    payslip.dateIssued,
    payslip.vehiclePlateNumber,
    vehicle.ownerUsername,
    payslip.billingInvoiceNumber
    FROM payslip
    INNER JOIN vehicle
    ON payslip.vehiclePlateNumber = vehicle.vehiclePlateNumber
    AND payslip.companyName = vehicle.companyName
    WHERE payslip.companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramCompanyName = $_SESSION["companyName"];

    $stmt->execute();
    $row = $stmt->fetchAll();
    $json = json_encode($row);

    echo $json;

} catch (Exception $ex) {
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
}

