<?php
include 'navbar.php';

if ( !isset($_SESSION) ) {
  session_start();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Editor-2.0.5/css/editor.dataTables.css">

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
    <script type="text/javascript" src="Editor-2.0.5/js/dataTables.editor.js"></script>
    
  </head>
  <body>

  <section class="hero has-background-white is-fullheight">
  <div class="hero-body">

    <div class="container">

      <div class="columns is-centered">
        <div class="column is-8-mobile is-8-tablet is-6-desktop is-6-widescreen">

          <form id="signUpForm" action="classes/sign-up-controller.class.php" class="box has-background-white-ter" method="POST">

            <h3 class="title is-3"> <i class="fas fa-user-cog mr-3"></i> Company Admin Account</h3>

            <div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter username here" class="input is-rounded" name="username" id="username" >
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </div>
              <p class="help" id="usernameHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Enter password here" class="input is-rounded" name="password" id="password" >
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="passwordHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Confirm Password</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="Enter password again here" class="input is-rounded" name="confirmPassword" id="confirmPassword" >
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <p class="help" id="confirmPasswordHelp"></p>
            </div>

            <h3 class="title is-3 mt-6"> <i class="fas fa-building mr-3"></i>Company Information</h3>

            <div class="field">
              <label for="" class="label">Company Name</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter company name here" class="input is-rounded" name="companyName" id="companyName">
                <span class="icon is-small is-left">
                <i class="fas fa-id-badge"></i>
                </span>
              </div>
              <p class="help" id="companyNameHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Company Email</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter company email here" class="input is-rounded" name="companyEmail" id="companyEmail">
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
                </span>
              </div>
              <p class="help" id="companyEmailHelp"></p>
            </div>

            <div class="field">
              <label for="" class="label">Company Contact Number</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter company telephone here" class="input is-rounded" name="companyNumber" id="companyNumber">
                <span class="icon is-small is-left">
                <i class="fas fa-phone"></i>
                </span>
              </div>
              <p class="help" id="companyNumberHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Company Address (Unit/Floor + House/Building Name + Street Number + Street Name)</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="Enter company address here" class="input is-rounded" name="companyAddress" id="companyAddress">
                <span class="icon is-small is-left">
                <i class="fas fa-map-marker-alt"></i>
                </span>
              </div>
              <p class="help" id="companyAddressHelp"></p>
            </div>
            
            <div class="field">
            <label for="" class="label">Region</label>
              <div class="control">
                <div class="select is-rounded" id="regionDiv">
                  <select id="region" name="region">
                  </select>
                </div>
              </div>
              <p class="help" id="regionHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label"> Province</label>
              <div class="control">
                <div class="select is-rounded" id="provinceDiv">
                  
                  <select id="province" name="province">

                  </select>
                </div>
              </div>
              <p class="help" id="provinceHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">City</label>
              <div class="control">
                <div class="select is-rounded" id="cityDiv">
                  
                  <select id="city" name="city">

                  </select>
                </div>
              </div>
              <p class="help" id="cityHelp"></p>
            </div>

            <div class="field">
            <label for="" class="label">Barangay</label>
              <div class="control">
                <div class="select is-rounded" id="barangayDiv">
                  <select id="barangay" name="barangay">

                  </select>
                </div>
              </div>
              <p class="help" id="barangayHelp"></p>
            </div>

            <div class="field mt-5">
              <button class="button has-background-link has-text-white is-rounded" type="submit" name="submit" id="submitForm">
              <i class="fas fa-paper-plane mr-3"></i>Submit
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
        <!-- script type="text/javascript" src="../../jquery.ph-locations.js"></script -->
        <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script -->
        <script type="text/javascript">
            
            var my_handlers = {

                fill_provinces:  function(){

                    var region_code = $(this).val();
                    $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
                    
                },

                fill_cities: function(){

                    var province_code = $(this).val();
                    $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
                },


                fill_barangays: function(){

                    var city_code = $(this).val();
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
                }
            };

            $(function(){
                $('#region').on('change', my_handlers.fill_provinces);
                $('#province').on('change', my_handlers.fill_cities);
                $('#city').on('change', my_handlers.fill_barangays);

                $('#region').ph_locations({'location_type': 'regions'});
                $('#province').ph_locations({'location_type': 'provinces'});
                $('#city').ph_locations({'location_type': 'cities'});
                $('#barangay').ph_locations({'location_type': 'barangays'});

                $('#region').ph_locations('fetch_list');
            });
        </script>
        <script>

  </script>
  </body>
  
 <script src="js/sign-up.js"></script>
 
 <script>
  const shipmentBtn = document.getElementById('shipmentBtn')
  const trackingBtn = document.getElementById('trackingBtn')
  const payslipBtn = document.getElementById('payslipBtn')
  const manageBtn = document.getElementById('manageBtn')
  const billingBtn = document.getElementById('billingBtn')
  const clientTrackingBtn = document.getElementById('clientTrackingBtn')
  
  if(<?php echo !isset($_SESSION["loggedin"])?>){
    shipmentBtn.className = "navbar-item is-hidden";
    trackingBtn.className = "navbar-item is-hidden";
    payslipBtn.className = "navbar-item is-hidden";
    manageBtn.className = "navbar-item is-hidden";
    billingBtn.className = "navbar-item is-hidden";
    clientTrackingBtn.className = "navbar-item";
  }

</script>
</html>