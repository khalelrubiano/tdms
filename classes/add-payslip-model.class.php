<?php
if ( !isset($_SESSION) ) {
    session_start();
}
require_once "../config.php";

class AddPayslipModel{
    private $payslipNumberAdd;
    private $dateIssuedAdd;
    private $dropOffAdd;
    private $penaltyAdd;
    private $withholdingTaxAdd;
    private $commissionRateAdd;
    private $vehiclePlateNumberAdd;
    private $billingInvoiceNumberAdd;
    private $companyName;

    public function __construct(
        $payslipNumberAdd, 
        $dateIssuedAdd, 
        $dropOffAdd,
        $penaltyAdd,
        $withholdingTaxAdd, 
        $commissionRateAdd, 
        $vehiclePlateNumberAdd,
        $billingInvoiceNumberAdd,
        $companyName
        ){

        $this->payslipNumberAdd = $payslipNumberAdd;
        $this->dateIssuedAdd = $dateIssuedAdd;
        $this->dropOffAdd = $dropOffAdd;
        $this->penaltyAdd = $penaltyAdd;
        $this->withholdingTaxAdd = $withholdingTaxAdd;
        $this->commissionRateAdd = $commissionRateAdd;
        $this->vehiclePlateNumberAdd = $vehiclePlateNumberAdd;
        $this->billingInvoiceNumberAdd = $billingInvoiceNumberAdd;
        $this->companyName = $companyName;
    }

    public function addPayslipRecord(){

        $this->addPayslipSubmit();

    }

    public function addPayslipSubmit(){
    
        $sql = "INSERT INTO 
                payslip(
                payslipNumber, 
                dateIssued,
                dropOff,
                penalty,
                withholdingTax,
                commissionRate,
                billingInvoiceNumber,
                vehiclePlateNumber,
                companyName
                ) 
                VALUES( 
                :payslipNumber, 
                :dateIssued,
                :dropOff,
                :penalty,
                :withholdingTax,
                :commissionRate,
                :billingInvoiceNumber,
                :vehiclePlateNumber,
                :companyName
                )";

        $configObj = new Config();
    
        $pdoVessel = $configObj->pdoConnect();

        if($stmt = $pdoVessel->prepare($sql)){

            $stmt->bindParam(":payslipNumber", $paramPayslipNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":dateIssued", $paramDateIssuedAdd, PDO::PARAM_STR);
            $stmt->bindParam(":dropOff", $paramDropOffAdd, PDO::PARAM_STR);
            $stmt->bindParam(":penalty", $paramPenaltyAdd, PDO::PARAM_STR);
            $stmt->bindParam(":withholdingTax", $paramWithholdingTaxAdd, PDO::PARAM_STR);
            $stmt->bindParam(":commissionRate", $paramCommissionRateAdd, PDO::PARAM_STR);
            $stmt->bindParam(":billingInvoiceNumber", $paramBillingInvoiceNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":vehiclePlateNumber", $paramVehiclePlateNumberAdd, PDO::PARAM_STR);
            $stmt->bindParam(":companyName", $paramCompanyName, PDO::PARAM_STR);
            
            $paramPayslipNumberAdd = $this->payslipNumberAdd;
            $paramDateIssuedAdd = $this->dateIssuedAdd;
            $paramDropOffAdd = $this->dropOffAdd;
            $paramPenaltyAdd = $this->penaltyAdd;
            $paramWithholdingTaxAdd = $this->withholdingTaxAdd;
            $paramCommissionRateAdd = $this->commissionRateAdd;
            $paramBillingInvoiceNumberAdd = $this->billingInvoiceNumberAdd;
            $paramVehiclePlateNumberAdd = $this->vehiclePlateNumberAdd;
            $paramCompanyName = $this->companyName;

            if($stmt->execute()){
                echo "Successfully added a record!";
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