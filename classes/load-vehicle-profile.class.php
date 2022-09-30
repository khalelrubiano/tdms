<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    shipment_number
    FROM shipment
    WHERE plate_number = :plate_number";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":plate_number", $param1, PDO::PARAM_STR);
    $param1 = $_SESSION["plateNumberVehicle"];

    $stmt->execute();
    $row = $stmt->fetchAll();
    $json = json_encode($row);

    echo $json;
} catch (Exception $ex) {
    echo $ex;
    /*
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();*/
}
