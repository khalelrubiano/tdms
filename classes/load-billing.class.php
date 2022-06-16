<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

//join billing, billedShipment and shipment. get truck rate then do computation of render function
try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    *
    FROM billing
    WHERE companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    //$stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumber, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    //$paramBillingInvoiceNumber = $_GET['billingInvoiceNumberVar'];
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

