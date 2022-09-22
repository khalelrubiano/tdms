<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";


$currentPageNumber = $_POST["currentPageNumber"];
$orderBy = $_POST["orderBy"];

//$test = 2;
$startingLimitNumber = ($currentPageNumber - 1) * 4;

//echo $startingLimitNumber;


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    employee.username, 
    employee.first_name, 
    employee.middle_name, 
    employee.last_name, 
    permission.role_name, 
    employee.employee_id, 
    employee.employee_number
    FROM permission INNER JOIN employee ON permission.permission_id = employee.permission_id 
    WHERE permission.company_id = :company_id " . 
    "ORDER BY " . $orderBy . " ASC " .  
    "LIMIT ". $startingLimitNumber . ',' . '4';

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

    $paramCompanyId = $_SESSION["companyId"];

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
