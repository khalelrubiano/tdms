<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT * FROM shipment WHERE shipmentNumber = :shipmentNumber AND companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramShipmentNumber = $_POST["shipmentNumber"];
    $paramCompanyName = $_POST["companyName"];
    
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