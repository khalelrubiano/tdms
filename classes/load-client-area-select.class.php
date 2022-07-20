<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";


try {
	$configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    *
    FROM clientarea
    WHERE client_id = :client_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":client_id", $paramClientId, PDO::PARAM_STR);
    $paramClientId = $_POST["clientId"];

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

