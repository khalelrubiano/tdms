<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT user.user_name, user.first_name, user.middle_name, user.last_name, permission.role_name FROM permission INNER JOIN user ON permission.permission_id = user.permission_id WHERE permission.account_type = :account_type AND permission.company_id = :company_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":account_type", $paramAccountType, PDO::PARAM_STR);
    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

    $paramAccountType = "Employee";
    $paramCompanyId = '2';

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