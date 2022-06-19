<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

class CalculatePayslipModel{
    private $payslipNumberCalculate;
    private $usernameCalculate;
    private $companyName;

    public function __construct(
        $payslipNumberCalculate, 
        $usernameCalculate, 
        $companyName
        ){

        $this->payslipNumberCalculate = $payslipNumberCalculate;
        $this->usernameCalculate = $usernameCalculate;
        $this->companyName = $companyName;
    }

    public function calculatePayslipRecord(){

        $this->addPayslipSubmit();

    }

    public function addPayslipSubmit(){
    
        $sql = 'SELECT SUM(payslipcalculation.totalAmount)
        FROM payslip
        INNER JOIN payslipcalculation 
        ON payslipcalculation.payslipNumber = payslip.payslipNumber
        INNER JOIN shipment 
        ON shipment.shipmentNumber = payslipcalculation.shipmentNumber
        INNER JOIN vehicle 
        ON vehicle.vehiclePlateNumber = shipment.vehiclePlateNumber
        WHERE payslip.companyName = :companyName 
        AND shipment.companyName = :companyName
        AND payslipcalculation.companyName = :companyName
        AND payslipcalculation.payslipNumber = :payslipNumber
        AND vehicle.ownerUsername = :username';

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":payslipNumber", $paramPayslipNumberCalculate, PDO::PARAM_STR);
            $stmt->bindParam(":username", $paramUsernameCalculate, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramPayslipNumberCalculate = $this->payslipNumberCalculate;
            $paramUsernameCalculate = $this->usernameCalculate;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                $row = $stmt->fetch();
                echo 'Net Pay: ' . $row[0];
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}