<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT trackerId, vehiclePlateNumber FROM tracker WHERE companyName = :companyName";

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
    header('location: ../modal-prompt.php');
    exit();
}
