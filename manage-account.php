<?php
if ( !isset($_SESSION) ) {
  session_start();
}

include 'navbar.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SESSION["accessType"] != "Admin" && $_SESSION["accessType"] != "Full"){
  // Unset all of the session variables
  $_SESSION = array();
 
  // Destroy the session.
  session_destroy();
   
  // Redirect to login page
  header("location: login.php");
  exit;
}

//echo $_SESSION["accessType"];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.0.5/css/editor.dataTables.css">
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.0.5/js/dataTables.editor.js"></script>


</head>

<body>
    
    <section class="hero has-background-white">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-full">
                    <h1 class="is-size-3 mb-5 has-text-weight-bold"><i class="fas fa-user-circle mr-3"></i> Manage Account </h1>
                        <table id="userTable" class="table is-bordered is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Access Type</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Created At</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                        </table>
                        <button class="button is-info is-rounded mt-6" onclick="openAdd()"> <i class="fas fa-plus mr-3"></i>Add User </button>
                        <button class="button is-success is-rounded mt-6" onclick="refreshTable()"><i class="fas fa-redo mr-3"></i> Refresh </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- ADD MODAL -->
<div class="modal" id="addModal">
  <div class="modal-background" id="addModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-info">
      <p class="modal-card-title has-text-white"> <i class="fas fa-plus mr-3"></i>Add User</p>
      <button class="delete" aria-label="close" onclick="closeAdd()"></button>
    </header>

    <section class="modal-card-body">

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
                <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordAdd" id="passwordAdd" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="passwordAddHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Confirm Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordAdd" id="confirmPasswordAdd" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="confirmPasswordAddHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Access Type</label>
              <div class="control">
                <div class="select is-rounded" id="accessTypeAddDiv">
                  <select id="accessTypeAdd" name="accessTypeAdd">
                    <option>Full</option>
                    <option>Partial</option>
                  </select>
                </div>
              </div>
              <p class="help" id="accessTypeAddHelp"></p>
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
              <button class="button is-info has-text-white is-rounded" name="submitAddForm" id="submitAddForm">
              <i class="fas fa-paper-plane mr-3"></i>Submit
              </button>
              <p class="help" id="submitAddFormHelp"></p>
            </div>
    </section>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal" id="editModal">
  <div class="modal-background" id="editModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-edit mr-3"></i>Edit User</p>
      <button class="delete" aria-label="close" onclick="closeEdit()"></button>
    </header>

    <section class="modal-card-body">

            <div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter username here" class="input is-rounded" name="usernameEdit" id="usernameEdit" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="usernameEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Enter password here" class="input is-rounded" name="passwordEdit" id="passwordEdit" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="passwordEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Confirm Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Confirm password here" class="input is-rounded" name="confirmPasswordEdit" id="confirmPasswordEdit" >
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="confirmPasswordEditHelp"></p>
            </div>

            <div class="field" id="accessTypeEditField">
            <label for="" class="label">Access Type</label>
              <div class="control">
                <div class="select is-rounded" id="accessTypeEditDiv">
                  <select id="accessTypeEdit" name="accessTypeEdit">
                    <option>Full</option>
                    <option>Partial</option>
                  </select>
                </div>
              </div>
              <p class="help" id="accessTypeEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">First Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter first name here" class="input is-rounded" name="firstNameEdit" id="firstNameEdit">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="firstNameEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Middle Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter middle name here" class="input is-rounded" name="middleNameEdit" id="middleNameEdit">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="middleNameEditHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Last Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter last name here" class="input is-rounded" name="lastNameEdit" id="lastNameEdit">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="lastNameEditHelp"></p>
            </div>

            <div class="field">
              <button class="button has-background-grey-dark has-text-white is-rounded" name="submitEditForm" id="submitEditForm">
              <i class="fas fa-check mr-3"></i>Save changes
              </button>
              <p class="help" id="submitEditFormHelp"></p>
            </div>
    </section>
  </div>
</div>
 
<!-- DELETE MODAL -->
<div class="modal" id="deleteModal">
  <div class="modal-background" id="deleteModalBg"></div>
  <div class="modal-card">

    <header class="modal-card-head has-background-grey-dark">
      <p class="modal-card-title has-text-white"><i class="fas fa-trash-alt mr-3"></i>Delete User</p>
      <button class="delete" aria-label="close" onclick="closeDelete()"></button>
    </header>

    <section class="modal-card-body">

            <div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter username here" class="input is-rounded" name="usernameDelete" id="usernameDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="usernameDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter password here" class="input is-rounded" name="passwordDelete" id="passwordDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="passwordDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Access Type</label>
              <div class="control has-icons-left">
                <input type="text" class="input is-rounded" name="accessTypeDelete" id="accessTypeDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="accessTypeDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">First Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter first name here" class="input is-rounded" name="firstNameDelete" id="firstNameDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="firstNameDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Middle Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter middle name here" class="input is-rounded" name="middleNameDelete" id="middleNameDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="middleNameDeleteHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Last Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter last name here" class="input is-rounded" name="lastNameDelete" id="lastNameDelete" readonly>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="lastNameDeleteHelp"></p>
            </div>

            <div class="field">
              <button class="button has-background-grey-dark has-text-white is-rounded" name="submitDeleteForm" id="submitDeleteForm">
              <i class="fas fa-exclamation mr-3"></i>Delete
              </button>
              <p class="help" id="submitDeleteFormHelp"></p>
            </div>
    </section>
  </div>
</div>

<script src="js/manage-account.js"></script>

<script>
const logoutBtn = document.getElementById('logoutBtn')
const loginBtn = document.getElementById('loginBtn')
const signupBtn = document.getElementById('signupBtn')
const userBtn = document.getElementById('userBtn')

if(<?php echo isset($_SESSION["loggedin"])?> == true ){
    logoutBtn.className = "button has-background-dark is-rounded has-text-white";
    loginBtn.className = "button has-background-grey-lighter is-rounded is-hidden";
    signupBtn.className = "button is-link is-rounded is-hidden";
    userBtn.className = "navbar-item has-text-weight-bold";
}

</script>
</html>