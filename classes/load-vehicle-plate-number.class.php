<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT trackerId, vehiclePlateNumber FROM tracker WHERE trackerId = :trackerId AND companyName = :companyName";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":trackerId", $paramTrackerId, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
    $paramTrackerId = $_POST["trackerId"];
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
