<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT * 
    FROM billing 
    INNER JOIN client
    ON billing.client_id = client.client_id
    WHERE billing.billing_id = :billing_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["billingId"];

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
