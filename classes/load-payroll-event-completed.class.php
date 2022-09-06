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
    billing.billing_id, 
    vehicle.plate_number,
    payrolldate.created_at
    FROM billing
    INNER JOIN billedshipment
    ON billing.billing_id = billedshipment.billing_id
    INNER JOIN billingdate
    ON billing.billing_id = billingdate.billing_id
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    INNER JOIN clientarea
    ON shipment.area_id = clientarea.area_id
    INNER JOIN shipmentprogress
    ON shipment.shipment_id = shipmentprogress.shipment_id
    LEFT JOIN vehicle
    ON shipment.vehicle_id = vehicle.vehicle_id
    INNER JOIN ownergroup
    ON vehicle.group_id = ownergroup.group_id
    INNER JOIN subcontractor
    ON ownergroup.owner_id = subcontractor.subcontractor_id
    INNER JOIN payroll
    ON shipment.shipment_id = payroll.shipment_id
    LEFT JOIN payrolldate
    ON payroll.payroll_id = payrolldate.payroll_id
    WHERE shipmentprogress.progress_description = 'Delivery Completed'
    GROUP BY vehicle.plate_number";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array('title' => 'Batch #' . $row[$i][0], 'description' => "Payslip for vehicle #" . $row[$i][1] . " was settled on " . $row[$i][2], 'start' => $row[$i][2], 'color' => '#c8e6c9', 'textColor' => '#000000');

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