<?php

require_once "../config.php";

class DeletePayslipModel{
    private $payslipNumberDelete;
    private $companyName;

    public function __construct( $payslipNumberDelete, $companyName){
        $this->payslipNumberDelete = $payslipNumberDelete;
        $this->companyName = $companyName;
    }

    public function deletePayslipRecord(){

    $this->deletePayslipSubmit();

    }

    public function deletePayslipSubmit(){

        $sql = "DELETE FROM payslip 
        WHERE payslipNumber = :payslipNumber
        AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":payslipNumber", $paramPayslipNumberDelete, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramPayslipNumberDelete = $this->payslipNumberDelete;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
               session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }

            unset($stmt);
        }
        unset($pdoVessel);
    }

}