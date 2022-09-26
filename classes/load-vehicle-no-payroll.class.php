<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

function vehicleValidator($var1, $var2)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT
    payroll.plate_number, payroll.billing_id
    FROM payroll
    WHERE payroll.billing_id = :billing_id 
    AND payroll.plate_number = :plate_number";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);
        $stmt->bindParam(":plate_number", $param2, PDO::PARAM_STR);

        $param1 = $var1;
        $param2 = $var2;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();

            if (count($row) > 0) {
                $returnValue = false;
            } else {
                $returnValue = true;
            }
        } else {
        }

        unset($stmt);

        return $returnValue;
    }
    unset($pdoVessel);
}


try {
    $configObj = new Config();
    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT billedshipment.billing_id, shipment.plate_number
    FROM billedshipment
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    WHERE billedshipment.billing_id = :billing_id GROUP BY shipment.plate_number";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

    $param1 = $_POST["billingId"];


    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";
        if (vehicleValidator($row[$i][0], $row[$i][1])) {
            //$childArray = array($row[$i][1]);
            //array_push($parentArray, $childArray);
            array_push($parentArray, $row[$i][1]);
        }
    }

    $jsonData = json_encode($parentArray);

    echo $jsonData;

    //echo invoiceValidator($row[0][0]);

} catch (Exception $ex) {
    session_start();
    $_SESSION['prompt'] = "Something went wrong!";
    header('location: ../prompt.php');
    exit();
}
