<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";



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
                    $returnValue = $row[$i][2] . " " . $row[$i][4];
                }
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}


try {

    $currentPageNumber = $_POST["currentPageNumber"];
    $orderBy = $_POST["orderBy"];

    //$test = 2;
    $startingLimitNumber = ($currentPageNumber - 1) * 4;

    //echo $startingLimitNumber;

    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    vehicle_id,
    plate_number,
    commission_rate, 
    driver_id, 
    helper_id,
    vehicle_status, 
    vehicle_type,
    status_remark 
    FROM vehicle
    WHERE group_id = :group_id
    ORDER BY " . $orderBy . " LIMIT " . $startingLimitNumber . ',' . '4';

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":group_id", $paramGroupId, PDO::PARAM_STR);

    $paramGroupId = $_SESSION["groupId"];

    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";

        $childArray = array($row[$i][0], $row[$i][1], $row[$i][2], $row[$i][5], getSubcontractorDetails($row[$i][3]), getSubcontractorDetails($row[$i][4]), $row[$i][6], $row[$i][7]);

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
