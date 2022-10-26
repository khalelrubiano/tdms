<?php
//PART OF NEW SYSTEM

if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

function invoiceValidator($idVar)
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT * 
    FROM billedshipment
    LEFT JOIN payrollshipment
    ON billedshipment.shipment_id = payrollshipment.shipment_id
    WHERE billedshipment.billing_id = :billing_id 
    AND payrollshipment.payrollshipment_id IS NULL";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

        $param1 = $idVar;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();

            if (count($row) > 0) {
                $returnValue = true;
            } else {
                $returnValue = false;
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

    $sql = "SELECT billing_id, invoice_number
    FROM billing
    INNER JOIN client
    ON billing.client_id = client.client_id
    WHERE client.company_id = :company_id";

    $stmt = $pdoVessel->prepare($sql);

    $stmt->bindParam(":company_id", $param1, PDO::PARAM_STR);

    $param1 = $_SESSION["companyId"];


    $stmt->execute();
    $row = $stmt->fetchAll();

    $parentArray = array();

    for ($i = 0; $i < count($row); $i++) {
        //echo $row[$i][1] . "<br>";
        if (invoiceValidator($row[$i][0])) {
            $childArray = array($row[$i][0], $row[$i][1]);
            array_push($parentArray, $childArray);
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
