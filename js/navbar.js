let navbarBurger = document.getElementById("navbarBurger")
let sideNavbarBurger = document.getElementById("sideNavbarBurger")
let navbarLinks = document.getElementById("navbarLinks")

let clientTrackingBtn = document.getElementById("clientTrackingBtn")

let userAccountBtn = document.getElementById("userAccountBtn")
let signUpBtn = document.getElementById("signUpBtn")
let loginBtn = document.getElementById("loginBtn")
let logoutBtn = document.getElementById("logoutBtn")

let dashboardBtn = document.getElementById("dashboardBtn")
let shipmentBtn = document.getElementById("shipmentBtn")
let employeeViewListBtn = document.getElementById("employeeViewListBtn")
let employeePermissionBtn = document.getElementById("employeePermissionBtn")
let subcontractorGroupBtn = document.getElementById("subcontractorGroupBtn")


let sideNavbarClass = document.querySelector(".sideNavbarClass")


navbarBurger.addEventListener('click', () => {
    navbarLinks.classList.toggle('is-active');
    sideNavbarClass.classList.remove('sideNavbarOpen');
});

sideNavbarBurger.addEventListener('click', () => {
    sideNavbarClass.classList.toggle('sideNavbarOpen');
    navbarLinks.classList.remove('is-active');
});

signUpBtn.addEventListener('click', () => {
    window.location.href = "sign-up-company.php";
});

loginBtn.addEventListener('click', () => {
    window.location.href = "login.php";
});

logoutBtn.addEventListener('click', () => {
    window.location.href = "logout.php";
});

dashboardBtn.addEventListener('click', () => {
    window.location.href = "dashboard.php";
});


shipmentBtn.addEventListener('click', () => {
    window.location.href = "shipment.php";
});

employeeViewListBtn.addEventListener('click', () => {
    window.location.href = "employee-view-list.php";
});