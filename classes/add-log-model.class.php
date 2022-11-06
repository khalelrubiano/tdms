<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../config.php";

class AddLogModel
{
    private $logDescription;
    private $companyId;


    public function __construct(
        $logDescription,
        $companyId
    ) {

        $this->logDescription = $logDescription;
        $this->companyId = $companyId;
    }

    public function addLogRecord()
    {

        $this->addLogSubmit();
        
    }

    public function addLogSubmit()
    {

        $sql = "INSERT INTO 
                log(
                log_description,
                company_id
                ) 
                VALUES( 
                :log_description,
                :company_id
                )";

        $configObj = new Config();

        $pdoVessel = $configObj->pdoConnect();

        if ($stmt = $pdoVessel->prepare($sql)) {

            $stmt->bindParam(":log_description", $paramLogDescription, PDO::PARAM_STR);
            $stmt->bindParam(":company_id", $paramCompanyId, PDO::PARAM_STR);

            $paramLogDescription = $this->logDescription;
            $paramCompanyId = $this->companyId;

            if ($stmt->execute()) {
                //echo "Successfully added a record!";
            } else {

                //echo "Something went wrong, shipment was not successfully added!";
            }


            unset($stmt);
        }
        unset($pdoVessel);
    }
}
