const username = document.getElementById('username')
const password = document.getElementById('password')
const usernameHelp = document.getElementById('usernameHelp')
const passwordHelp = document.getElementById('passwordHelp')
const loginForm = document.getElementById('loginForm')

loginForm.addEventListener('submit', (e) => {

  //Resetting form elements
  username.className = "input is-rounded"
  usernameHelp.className = "help"
  usernameHelp.innerText = ""

  password.className = "input is-rounded"
  passwordHelp.className = "help"
  passwordHelp.innerText = ""

  let usernameMessages = []
  let passwordMessages = []
  
  //Username Validation

  if (username.value === "" || username.value == null) {
    username.className = "input is-danger is-rounded"
    usernameHelp.className = "help is-danger"
    usernameMessages.push('Username is required!')
  }

  //Password Validation
  if (password.value === "" || password.value == null) {
    password.className = "input is-danger is-rounded"
    passwordHelp.className = "help is-danger"
    passwordMessages.push('Password is required!')
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
})





var username_variable = username.value;