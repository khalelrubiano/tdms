<p class="title is-4 is-hidden" id="isOwnerHidden"><?php echo $_SESSION["isOwner"] ?></p>
<p class="title is-4 is-hidden" id="isDriverHidden"><?php echo $_SESSION["isDriver"] ?></p>
<p class="title is-4 is-hidden" id="isHelperHidden"><?php echo $_SESSION["isHelper"] ?></p>

<!--EXTERNAL JAVASCRIPT-->
<script src="js/payroll-individual.js"></script>

<script>
  let isOwnerHidden = document.getElementById('isOwnerHidden')
  let isDriverHidden = document.getElementById('isDriverHidden')
  let isHelperHidden = document.getElementById('isHelperHidden')

  logoutBtn.classList.remove("is-hidden");
  userBtn.innerHTML = "<?php echo $_SESSION['username'] ?>";
  userBtn.classList.remove("is-hidden");
  payslipBtn.classList.add("is-active");

  if (isOwnerHidden.innerHTML == "Yes") {
    //shipmentGroupBtn.classList.remove("is-hidden");
    shipmentIndividualBtn.classList.remove("is-hidden");
    payslipBtn.classList.remove("is-hidden");
    vehicleBtn.classList.remove("is-hidden");
  };

  if (isDriverHidden.innerHTML == "Yes" || isHelperHidden.innerHTML == "Yes") {
    shipmentIndividualBtn.classList.remove("is-hidden");
  };
</script>

<?php
//SESSION START
if (!isset($_SESSION)) {
  session_start();
}
/*
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["shipmentAccess"] === 'No') {
  header("location: dashboard-default.php");
  exit;
}*/

include_once 'navbar-subcontractor.php';

?>