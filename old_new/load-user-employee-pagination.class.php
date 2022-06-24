<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$currentPageNumber = $_POST["currentPageNumber"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 2;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    user.username, 
    user.role, 
    user.firstName, 
    user.middleName, 
    user.lastName, 
    user.createdAt 
    FROM permission 
    INNER JOIN user 
    ON permission.role = user.role 
    WHERE permission.accountType = :accountType AND permission.companyName = :companyName 
    LIMIT " . $startingLimitNumber . ',' . '2';

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":accountType", $paramAccountType, PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);

    $paramAccountType = "Default";
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
