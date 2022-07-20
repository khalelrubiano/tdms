<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$currentPageNumber = $_POST["currentPageNumber"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 5;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    *
    FROM clientarea
    WHERE client_id = :client_id
    ORDER BY area_name ASC
    LIMIT " . $startingLimitNumber . ',' . '5';

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":client_id", $paramClientId, PDO::PARAM_STR);
    $paramClientId = $_SESSION["clientId"];

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
    exit();
    */
}
