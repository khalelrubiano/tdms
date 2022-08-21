<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once "../config.php";

function getBilledShipment()
{
    $configObj = new Config();

    $pdoVessel = $configObj->pdoConnect();

    $sql = "SELECT shipment.shipment_id 
    FROM billing 
    INNER JOIN billedshipment
    ON billing.billing_id = billedshipment.billing_id
    INNER JOIN shipment
    ON billedshipment.shipment_id = shipment.shipment_id
    WHERE billing.billing_id = :billing_id";

    if ($stmt = $pdoVessel->prepare($sql)) {

        $stmt->bindParam(":billing_id", $param1, PDO::PARAM_STR);

        $param1 = 10;

        if ($stmt->execute()) {
            $row = $stmt->fetchAll();

            for ($i = 0; $i < count($row); $i++) {
                echo "ID: " . $row[$i][0] . "<br>";
            }



        } else {
            session_start();
            $_SESSION["prompt"] = "Something went wrong!";
            header('location: ../prompt.php');
            exit();
        }

        unset($stmt);
    }
    unset($pdoVessel);
}
getBilledShipment();