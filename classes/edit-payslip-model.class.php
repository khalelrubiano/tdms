
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditPayslipModel
{
    private $dropOffEdit;
    private $penaltyEdit;
    private $remarksEdit;
    private $payrollId;

    public function __construct(
        $dropOffEdit,
        $penaltyEdit,
        $remarksEdit,
        $payrollId
    ) {
        $this->dropOffEdit = $dropOffEdit;
        $this->penaltyEdit = $penaltyEdit;
        $this->remarksEdit = $remarksEdit;
        $this->payrollId = $payrollId;
    }

    public function editPayslipRecord()
    {
        $this->editSubmit();
    }

    private function editSubmit()
    {
        $sql = "UPDATE
        payroll 
        SET
        drop_off = :drop_off,
        penalty = :penalty,
        remarks = :remarks
        WHERE
        payroll_id = :payroll_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":drop_off", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":penalty", $param2, PDO::PARAM_STR);
            $stmt->bindParam(":remarks", $param3, PDO::PARAM_STR);
            $stmt->bindParam(":payroll_id", $param4, PDO::PARAM_STR);

            $param1 = $this->dropOffEdit;
            $param2 = $this->penaltyEdit;
            $param3 = $this->remarksEdit;
            $param4 = $this->payrollId;

            if ($stmt->execute()) {
                //$this->getBilledShipment();
                //$this->editDateSubmit();
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Payslip was updated!";
            } else {
                /*
                $_SESSION["prompt"] = "Something went wrong!";
                header('location: ../prompt.php');
                exit();*/
                echo "Something went wrong, update was not successful!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}
