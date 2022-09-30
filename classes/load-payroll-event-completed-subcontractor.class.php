<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

/*
function getSubcontractorDetails($idVar)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    subcontractor_id,
    username, 
    first_name, 
    middle_name, 
    last_name
    FROM subcontractor
    WHERE company_id = :company_id";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

        $paramCompanyId = $_SESSION["companyId"];

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();

            for ($i = 0; $i < count($row); $i++) {

                if ($idVar == $row[$i][0]) {
                    $returnValue = $row[$i][2] . " " . $row[$i][3] . " " . $row[$i][4];
                }
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}
*/

try {

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT 
    billing.invoice_number, 
    payroll.plate_number,
    payroll.date_settled
    FROM payroll 
    INNER JOIN billing 
    ON payroll.billing_id = billing.billing_id 
    INNER JOIN vehicle 
    ON vehicle.plate_number = payroll.plate_number 
    INNER JOIN ownergroup 
    ON ownergroup.group_id = vehicle.group_id 
    WHERE ownergroup.owner_id = :owner_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":owner_id", $param1, PDO::PARAM_STR);

    $param1 = $_SESSION["subcontractorId"];

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array('title' => 'Invoice #' . $row[$i][0], 'description' => "Payslip for vehicle #" . $row[$i][1] . " was settled on " . $row[$i][2], 'start' => $row[$i][2], 'color' => '#c8e6c9', 'textColor' => '#000000');

        array_push($parentArray, $childArray);
    }

    $jsonData = json_encode($parentArray);

    echo $jsonData;

} catch (Exception $ex) {

    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
    
}


/*
title(shipment_number or logo?), start(date_completed), description()
*/