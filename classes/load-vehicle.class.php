<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    vehicle.vehiclePlateNumber, 
    vehicle.ownerUsername, 
    user.firstName, 
    user.middleName, 
    user.lastName, 
    vehicle.createdAt
    FROM vehicle
    INNER JOIN user 
    ON vehicle.ownerUsername = user.username
    WHERE vehicle.companyName = :companyName";

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

