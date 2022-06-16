<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    billing.billingInvoiceNumber,
    billing.client,
    SUM(shipment.areaRate),
    billing.dropFee,
    billing.parkingFee,
    billing.demurrage,
    billing.otherCharges,
    billing.lessPenalties
    FROM billing
    INNER JOIN billedshipment
    ON billing.billingInvoiceNumber = billedshipment.billingInvoiceNumber
    AND billing.companyName = billedshipment.companyName
    INNER JOIN shipment
    ON billedshipment.shipmentNumber = shipment.shipmentNumber
    AND billedshipment.companyName = shipment.companyName
    WHERE billing.billingInvoiceNumber = :billingInvoiceNumber AND billing.companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumber, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramBillingInvoiceNumber = $_POST["billingInvoiceNumber"];
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