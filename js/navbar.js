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
let billingBtn = document.getElementById("billingBtn")
let payrollBtn = document.getElementById("payrollBtn")
let employeeViewListBtn = document.getElementById("employeeViewListBtn")
let employeePermissionBtn = document.getElementById("employeePermissionBtn")
let subcontractorViewListBtn = document.getElementById("subcontractorViewListBtn")
let subcontractorVehicleBtn = document.getElementById("subcontractorVehicleBtn")
let subcontractorGroupBtn = document.getElementById("subcontractorGroupBtn")
let clientViewListBtn = document.getElementById("clientViewListBtn")

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

billingBtn.addEventListener('click', () => {
    window.location.href = "billing.php";
});

payrollBtn.addEventListener('click', () => {
    window.location.href = "payroll.php";
});

employeeViewListBtn.addEventListener('click', () => {
    window.location.href = "employee-view-list.php";
});

employeePermissionBtn.addEventListener('click', () => {
    window.location.href = "employee-permission.php";
});

subcontractorViewListBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-view-list.php";
});

subcontractorVehicleBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-vehicle.php";
});

subcontractorGroupBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-group.php";
});

clientViewListBtn.addEventListener('click', () => {
    window.location.href = "client-view-list.php";
});