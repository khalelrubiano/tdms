//PART OF NEW SYSTEM
const employeeNumberAdd = document.getElementById('employeeNumberAdd')
const username = document.getElementById('username')
const password = document.getElementById('password')

const confirmPassword = document.getElementById('confirmPassword')

const companyName = document.getElementById('companyName')
const companyEmail = document.getElementById('companyEmail')
const companyNumber = document.getElementById('companyNumber')
const companyAddress = document.getElementById('companyAddress')
const region = document.getElementById('region')
const province = document.getElementById('province')
const city = document.getElementById('city')
const barangay = document.getElementById('barangay')
const tin = document.getElementById('tin')

const usernameHelp = document.getElementById('usernameHelp')
const passwordHelp = document.getElementById('passwordHelp')

const confirmPasswordHelp = document.getElementById('confirmPasswordHelp')
const companyNameHelp = document.getElementById('companyNameHelp')
const companyEmailHelp = document.getElementById('companyEmailHelp')
const companyNumberHelp = document.getElementById('companyNumberHelp')
const companyAddressHelp = document.getElementById('companyAddressHelp')
const regionHelp = document.getElementById('regionHelp')
const provinceHelp = document.getElementById('provinceHelp')
const cityHelp = document.getElementById('cityHelp')
const barangayHelp = document.getElementById('barangayHelp')
const tinHelp = document.getElementById('tinHelp')

const regionDiv = document.getElementById('regionDiv')
const provinceDiv = document.getElementById('provinceDiv')
const cityDiv = document.getElementById('cityDiv')
const barangayDiv = document.getElementById('barangayDiv')

const signUpCompanyForm = document.getElementById('signUpCompanyForm')

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/
var pattern4 = /^[0-9]+$/

//var strongRegex = new RegExp("^[a-zA-Z0-9_-]$");


signUpCompanyForm.addEventListener('submit', (e) => {

  //Resetting form elements
  username.className = "input is-rounded"
  usernameHelp.className = "help"
  usernameHelp.innerText = ""

  password.className = "input is-rounded"
  passwordHelp.className = "help"
  passwordHelp.innerText = ""

  confirmPassword.className = "input is-rounded"
  confirmPasswordHelp.className = "help"
  confirmPasswordHelp.innerText = ""

  companyName.className = "input is-rounded"
  companyNameHelp.className = "help"
  companyNameHelp.innerText = ""

  companyEmail.className = "input is-rounded"
  companyEmailHelp.className = "help"
  companyEmailHelp.innerText = ""

  companyNumber.className = "input is-rounded"
  companyNumberHelp.className = "help"
  companyNumberHelp.innerText = ""

  companyAddress.className = "input is-rounded"
  companyAddressHelp.className = "help"
  companyAddressHelp.innerText = ""

  regionDiv.className = "select is-rounded"
  regionHelp.className = "help"
  regionHelp.innerText = ""

  provinceDiv.className = "select is-rounded"
  provinceHelp.className = "help"
  provinceHelp.innerText = ""

  cityDiv.className = "select is-rounded"
  cityHelp.className = "help"
  cityHelp.innerText = ""

  barangayDiv.className = "select is-rounded"
  barangayHelp.className = "help"
  barangayHelp.innerText = ""

  let usernameMessages = []
  let passwordMessages = []

  let confirmPasswordMessages = []
  let companyNameMessages = []
  let companyEmailMessages = []
  let companyNumberMessages = []
  let companyAddressMessages = []
  let regionMessages = []
  let provinceMessages = []
  let cityMessages = []
  let barangayMessages = []

  //Username Validation

  if (pattern1.test(username.value) == false) {
    username.className = "input is-danger is-rounded"
    usernameHelp.className = "help is-danger"
    usernameMessages.push('Username should only consist of numbers, letters, or an underscore!')
  }

  if (username.value === "" || username.value == null) {
    username.className = "input is-danger is-rounded"
    usernameHelp.className = "help is-danger"
    usernameMessages.push('Username is required!')
  }
  if (username.value.length <= 6) {
    username.className = "input is-danger is-rounded"
    usernameHelp.className = "help is-danger"
    usernameMessages.push('Username must be longer than 6 characters!')
  }

  if (username.value.length >= 30) {
    username.className = "input is-danger is-rounded"
    usernameHelp.className = "help is-danger"
    usernameMessages.push('Username must be less than 20 characters!')
  }

  //Password Validation
  if (password.value === "" || password.value == null) {
    password.className = "input is-danger is-rounded"
    passwordHelp.className = "help is-danger"
    passwordMessages.push('Password is required!')
  }
  if (password.value.length <= 6) {
    password.className = "input is-danger is-rounded"
    passwordHelp.className = "help is-danger"
    passwordMessages.push('Password must be longer than 6 characters!')
  }

  if (password.value.length >= 20) {
    password.className = "input is-danger is-rounded"
    passwordHelp.className = "help is-danger"
    passwordMessages.push('Password must be less than 20 characters!')
  }

  //Confirm Password Validation
  if (confirmPassword.value != password.value) {
    confirmPassword.className = "input is-danger is-rounded"
    confirmPasswordHelp.className = "help is-danger"
    confirmPasswordMessages.push('Password does not match!')
  }

  //Company Name Validation

  if (companyName.value === "" || companyName.value == null) {
    companyName.className = "input is-danger is-rounded"
    companyNameHelp.className = "help is-danger"
    companyNameMessages.push('Company name is required!')
  }
  if (companyName.value.length < 1) {
    companyName.className = "input is-danger is-rounded"
    companyNameHelp.className = "help is-danger"
    companyNameMessages.push('Company name must be longer than 1 character!')
  }

  if (companyName.value.length >= 255) {
    companyName.className = "input is-danger is-rounded"
    companyNameHelp.className = "help is-danger"
    companyNameMessages.push('Company name must be less than 50 characters!')
  }

  //Company Email Validation
  if (pattern3.test(companyEmail.value) == false) {
    companyEmail.className = "input is-danger is-rounded"
    companyEmailHelp.className = "help is-danger"
    companyEmailMessages.push('Please provide a valid email!')
  }

  if (companyEmail.value === "" || companyEmail.value == null) {
    companyEmail.className = "input is-danger is-rounded"
    companyEmailHelp.className = "help is-danger"
    companyEmailMessages.push('Company email is required!')
  }
  //Company Contact Number Validation
  if (pattern4.test(companyNumber.value) == false) {
    companyNumber.className = "input is-danger is-rounded"
    companyNumberHelp.className = "help is-danger"
    companyNumberMessages.push('Company contact number should only consist of numbers!')
  }

  if (companyNumber.value === "" || companyNumber.value == null) {
    companyNumber.className = "input is-danger is-rounded"
    companyNumberHelp.className = "help is-danger"
    companyNumberMessages.push('Company contact number is required!')
  }

  if (companyNumber.value.length != 8 && companyNumber.value.length != 11) {
    companyNumber.className = "input is-danger is-rounded"
    companyNumberHelp.className = "help is-danger"
    companyNumberMessages.push('Please provide a valid 8 or 11 digit phone number!')
  }
  //Company Address Validation

  if (pattern2.test(companyAddress.value) == false) {
    companyAddress.className = "input is-danger"
    companyAddressHelp.className = "help is-danger"
    companyAddressMessages.push('Company address should only consist of numbers and letters!')
  }

  if (companyAddress.value === "" || companyAddress.value == null) {
    companyAddress.className = "input is-danger is-rounded"
    companyAddressHelp.className = "help is-danger"
    companyAddressMessages.push('Company address is required!')
  }
  if (companyAddress.value.length < 1) {
    companyAddress.className = "input is-danger is-rounded"
    companyAddressHelp.className = "help is-danger"
    companyAddressMessages.push('Company address must be longer than 1 character!')
  }

  if (companyAddress.value.length > 100) {
    companyAddress.className = "input is-danger is-rounded"
    companyAddressHelp.className = "help is-danger"
    companyAddressMessages.push('Company address must be less than 60 characters!')
  }
  //Region Validation
  if (region.value === "" || region.value == null) {
    regionDiv.className = "select is-danger is-rounded"
    regionHelp.className = "help is-danger"
    regionMessages.push('Region is required!')
  }

  //Province Validation
  if (province.value === "" || province.value == null) {
    provinceDiv.className = "select is-danger is-rounded"
    provinceHelp.className = "help is-danger"
    provinceMessages.push('Province is required!')
  }

  //City Validation
  if (city.value === "" || city.value == null) {
    cityDiv.className = "select is-danger is-rounded"
    cityHelp.className = "help is-danger"
    cityMessages.push('City is required!')
  }

  //Barangay Validation
  if (barangay.value === "" || barangay.value == null) {
    barangayDiv.className = "select is-danger is-rounded"
    barangayHelp.className = "help is-danger"
    barangayMessages.push('Barangay is required!')
  }

  //Messages
  if (usernameMessages.length > 0) {
    e.preventDefault()
    usernameHelp.innerText = usernameMessages.join(', ')
  }

  if (passwordMessages.length > 0) {
    e.preventDefault()
    passwordHelp.innerText = passwordMessages.join(', ')
  }

  if (confirmPasswordMessages.length > 0) {
    e.preventDefault()
    confirmPasswordHelp.innerText = confirmPasswordMessages.join(', ')
  }

  if (companyNameMessages.length > 0) {
    e.preventDefault()
    companyNameHelp.innerText = companyNameMessages.join(', ')
  }

  if (companyEmailMessages.length > 0) {
    e.preventDefault()
    companyEmailHelp.innerText = companyEmailMessages.join(', ')
  }

  if (companyNumberMessages.length > 0) {
    e.preventDefault()
    companyNumberHelp.innerText = companyNumberMessages.join(', ')
  }

  if (companyAddressMessages.length > 0) {
    e.preventDefault()
    companyAddressHelp.innerText = companyAddressMessages.join(', ')
  }

  if (regionMessages.length > 0) {
    e.preventDefault()
    regionHelp.innerText = regionMessages.join(', ')
  }

  if (provinceMessages.length > 0) {
    e.preventDefault()
    provinceHelp.innerText = provinceMessages.join(', ')
  }

  if (cityMessages.length > 0) {
    e.preventDefault()
    cityHelp.innerText = cityMessages.join(', ')
  }

  if (barangayMessages.length > 0) {
    e.preventDefault()
    barangayHelp.innerText = barangayMessages.join(', ')
  }

})