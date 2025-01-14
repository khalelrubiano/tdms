
<?php
//PART OF NEW SYSTEM

require_once "../config.php";

class EditPayslipModel
{
    private $payrollId;

    public function __construct(
        $payrollId
    ) {
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
        payroll_status = 'Settled',
        date_settled = :date_settled
        WHERE
        payroll_id = :payroll_id";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":payroll_id", $param1, PDO::PARAM_STR);
            $stmt->bindParam(":date_settled", $param2, PDO::PARAM_STR);

            $param1 = $this->payrollId;
            $param2 = date("Y-m-d");

            if ($stmt->execute()) {
                //$this->getBilledShipment();
                //$this->editDateSubmit();
                /*
                session_start();
                $_SESSION["prompt"] = "Sign-up was successful!";
                header('location: ../prompt.php');
                exit();
                */
                echo "Payslip status was updated!";
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
