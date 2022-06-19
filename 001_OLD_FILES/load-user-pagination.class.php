<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$currentPageNumber = $_POST['currentPageNumber'];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 1;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT * FROM user WHERE companyName = :companyName LIMIT " . $startingLimitNumber . ',' . '1';

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
