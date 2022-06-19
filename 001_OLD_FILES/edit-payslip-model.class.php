<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

class EditPayslipModel{
    private $payslipNumberEdit;
    private $dateIssuedEdit;
    private $shipmentNumberEdit;
    private $areaRateEdit;
    private $commissionRateEdit;
    private $penaltyEdit;
    private $companyName;

    public function __construct(
        $payslipNumberEdit, 
        $dateIssuedEdit, 
        $shipmentNumberEdit, 
        $areaRateEdit, 
        $commissionRateEdit,
        $penaltyEdit,
        $companyName
        ){

        $this->payslipNumberEdit = $payslipNumberEdit;
        $this->dateIssuedEdit = $dateIssuedEdit;
        $this->shipmentNumberEdit = $shipmentNumberEdit;
        $this->areaRateEdit = $areaRateEdit;
        $this->commissionRateEdit = $commissionRateEdit;
        $this->penaltyEdit = $penaltyEdit;
        $this->companyName = $companyName;
    }

    public function editPayslipRecord(){

        if($this->emptyValidator() == false || $this->lengthValidator() == false || $this->patternValidator() == false ){
            
            $_SESSION['prompt'] = "The information you entered are not valid!";
            header('location: ../modal-prompt.php');
            exit();
        }

        if($this->shipmentNumberValidator() == true){
            
            $_SESSION['prompt'] = "The shipment number you entered is not registered in the system!";
            header('location: ../modal-prompt.php');
            exit();
        }

        $this->editPayslipSubmit();
        $this->editPayslipCalculationSubmit();

    }

    public function editPayslipSubmit(){
    
        $sql = "UPDATE 
                payslip 
                SET
                dateIssued = :dateIssued 
                WHERE payslipNumber = :payslipNumber 
                AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":payslipNumber", $paramPayslipNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":dateIssued", $paramDateIssuedEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramPayslipNumberEdit = $this->payslipNumberEdit;
            $paramDateIssuedEdit = $this->dateIssuedEdit;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully edited a record!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
    
    public function editPayslipCalculationSubmit(){

        $sql = "UPDATE 
                payslipcalculation
                SET
                areaRate =  :areaRate,
                commissionRate = :commissionRate,
                penalty = :penalty,
                totalAmount = :totalAmount,
                payslipNumber = :payslipNumber
                WHERE shipmentNumber = :shipmentNumber 
                AND companyName = :companyName";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumberEdit, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            $stmt->bindParam(":areaRate", $paramAreaRateEdit, PDO::PARAM_STR);
            $stmt->bindParam(":commissionRate", $paramCommissionRateEdit, PDO::PARAM_STR);
            $stmt->bindParam(":penalty", $paramPenaltyEdit, PDO::PARAM_STR);
            $stmt->bindParam(":totalAmount", $paramTotalAmountEdit, PDO::PARAM_STR);
            $stmt->bindParam(":payslipNumber", $paramPayslipNumberEdit, PDO::PARAM_STR);
            
            $paramShipmentNumberEdit = $this->shipmentNumberEdit;
            $paramCompanyName = $this->companyName;
            $paramAreaRateEdit = $this->areaRateEdit;
            $paramCommissionRateEdit = $this->commissionRateEdit;
            $paramPenaltyEdit = $this->penaltyEdit;
            $paramTotalAmountEdit = $this->areaRateEdit - ($this->penaltyEdit + ( $this->areaRateEdit * ($this->commissionRateEdit / 100)));
            $paramPayslipNumberEdit = $this->payslipNumberEdit;

            if($stmt->execute()){
                echo "Successfully edited a record!";
            } else{
               
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }

    private function emptyValidator(){
        if(
            empty(trim($this->payslipNumberEdit)) || 
            empty(trim($this->dateIssuedEdit)) || 
            empty(trim($this->shipmentNumberEdit)) || 
            empty(trim($this->areaRateEdit)) || 
            empty(trim($this->commissionRateEdit)) || 
            empty(trim($this->penaltyEdit)) || 
            empty(trim($this->companyName))
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function lengthValidator(){
        if(
            strlen(trim($this->payslipNumberEdit)) < 1 && strlen(trim($this->payslipNumberEdit)) > 255 && 
            strlen(trim($this->shipmentNumberEdit)) < 1 && strlen(trim($this->shipmentNumberEdit)) > 255 && 
            strlen(trim($this->areaRateEdit)) < 1 && strlen(trim($this->areaRateEdit)) > 255 && 
            trim($this->commissionRateEdit) < 1 && trim($this->commissionRateEdit) > 100 &&
            strlen(trim($this->penaltyEdit)) < 1 && strlen(trim($this->penaltyEdit)) > 255
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function patternValidator(){
        if(
            !preg_match('/^[0-9]+$/', trim($this->payslipNumberEdit)) ||
            !preg_match('/^[0-9]+$/', trim($this->shipmentNumberEdit)) ||
            !preg_match('/^[0-9]+$/', trim($this->areaRateEdit)) ||
            !preg_match('/^[0-9]+$/', trim($this->commissionRateEdit)) ||
            !preg_match('/^[0-9]+$/', trim($this->penaltyEdit)) 
            ){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function shipmentNumberValidator(){
        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();
    
        $sql = "SELECT * FROM shipment WHERE shipmentNumber = :shipmentNumber AND companyName = :companyName";
            
        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":shipmentNumber", $paramShipmentNumber, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramShipmentNumber = $this->shipmentNumberEdit;
            $paramCompanyName = $this->companyName;
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $result = false;
                }
                else{
                    $result = true;
                }
    
            } else{
                session_start();
                $_SESSION ["prompt"] = "Something went wrong!";
                header('location: ../modal-prompt.php');
                exit();
            }
    
            unset($stmt);

            return $result;
        }
        unset($pdoVessel);
    }
    
}