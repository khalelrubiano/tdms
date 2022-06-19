

<?php
//PART OF NEW SYSTEM
include 'navbar.php';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Sign-up</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>

  </style>
</head>

<body>
  <div class="section">
    <div class="container">
      <form id="signUpUserForm" action="classes/sign-up-user-controller.class.php" class="box has-background-white-ter" method="POST">

        <h3 class="title is-3"> <i class="fas fa-user-cog mr-3"></i> User Account</h3>

        <div class="field">
          <label for="" class="label">Username</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter username here" class="input is-rounded" name="usernameAdd" id="usernameAdd">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
          <p class="help" id="usernameAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Password</label>
          <div class="control has-icons-left">
            <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordAdd" id="passwordAdd">
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <p class="help" id="passwordAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Confirm Password</label>
          <div class="control has-icons-left">
            <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordAdd" id="confirmPasswordAdd">
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <p class="help" id="confirmPasswordAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">First Name</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter first name here" class="input is-rounded" name="firstNameAdd" id="firstNameAdd">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
          <p class="help" id="firstNameAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Middle Name</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter middle name here" class="input is-rounded" name="middleNameAdd" id="middleNameAdd">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
          <p class="help" id="middleNameAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Last Name</label>
          <div class="control has-icons-left">
            <input type="text" placeholder="Enter last name here" class="input is-rounded" name="lastNameAdd" id="lastNameAdd">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
          <p class="help" id="lastNameAddHelp"></p>
        </div>

        <div class="field">
          <label for="" class="label">Company Name</label>
          <div class="control">
            <div class="select is-rounded" id="companyNameSelectDiv">
              <select id="companyNameSelect" name="companyNameSelect">
              </select>
            </div>
          </div>
          <p class="help" id="companyNameSelectHelp"></p>
        </div>

        <div class="field mt-5">
          <button class="button has-background-link has-text-white is-rounded" type="submit" name="submitAddForm" id="submitAddForm">
            <i class="fas fa-paper-plane mr-3"></i>Submit
          </button>
        </div>

      </form>
    </div>
  </div>

  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
      </p>
    </div>
  </footer>

</body>

<script src="js/sign-up-user.js"></script>

<script>
  let shipmentBtn = document.getElementById('shipmentBtn')
  let clientTrackingBtn = document.getElementById('clientTrackingBtn')

  let manageBtn = document.getElementById('manageBtn')
  let employeeBtn = document.getElementById('employeeBtn')
  let subcontractorBtn = document.getElementById('subcontractorBtn')


  let signupBtn = document.getElementById('signupBtn')
  let loginBtn = document.getElementById('loginBtn')
  let logoutBtn = document.getElementById('logoutBtn')

  if (<?php echo !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ?>) {

    clientTrackingBtn.classList.remove("is-hidden");

    signupBtn.classList.remove("is-hidden");
    loginBtn.classList.remove("is-hidden");
  }
</script>

</html>