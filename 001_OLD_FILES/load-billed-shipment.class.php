<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    shipment.shipmentNumber,
    shipment.vehiclePlateNumber,
    shipment.dateOfDelivery,
    shipment.areaRate
    FROM billedshipment
    INNER JOIN shipment
    ON billedshipment.shipmentNumber = shipment.shipmentNumber
    AND billedshipment.companyName = shipment.companyName
    WHERE billedshipment.billingInvoiceNumber = :billingInvoiceNumber AND billedshipment.companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumber, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramBillingInvoiceNumber = $_GET["billedShipmentData"];
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