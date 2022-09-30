<?php

require_once "../config.php";

class DeleteModel{
    private $payrollId;
    
    public function __construct( $payrollId){
        $this->payrollId = $payrollId;
    }

    public function deleteRecord(){
        $this->deleteSubmit();
    }

    public function deleteSubmit(){

        $sql = "DELETE FROM payroll WHERE payroll_id = :payroll_id";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":payroll_id", $param1, PDO::PARAM_STR);

            $param1 = $this->payrollId;

            if($stmt->execute()){
                echo "Successfully deleted a record!";
            } else{
                echo "Something went wrong, unable to delete invoice!";
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}