let navbarBurger = document.getElementById("navbarBurger")
let sideNavbarBurger = document.getElementById("sideNavbarBurger")
let navbarLinks = document.getElementById("navbarLinks")

let userAccountBtn = document.getElementById("userAccountBtn")
let logoutBtn = document.getElementById("logoutBtn")

let dashboardBtn = document.getElementById("dashboardBtn")
let shipmentGroupBtn = document.getElementById("shipmentGroupBtn")
let payslipBtn = document.getElementById("payslipBtn")
let shipmentIndividualBtn = document.getElementById("shipmentIndividualBtn")
let vehicleBtn = document.getElementById("vehicleBtn")
let accountBtn = document.getElementById("accountBtn")
let manageLabel = document.getElementById("manageLabel")

let sideNavbarClass = document.querySelector(".sideNavbarClass")


navbarBurger.addEventListener('click', () => {
    navbarLinks.classList.toggle('is-active');
    sideNavbarClass.classList.remove('sideNavbarOpen');
});

sideNavbarBurger.addEventListener('click', () => {
    sideNavbarClass.classList.toggle('sideNavbarOpen');
    navbarLinks.classList.remove('is-active');
});

logoutBtn.addEventListener('click', () => {
    window.location.href = "logout.php";
});

dashboardBtn.addEventListener('click', () => {
    window.location.href = "dashboard-subcontractor.php";
});

/*
shipmentGroupBtn.addEventListener('click', () => {
    window.location.href = "shipment.php";
});
*/

payslipBtn.addEventListener('click', () => {
    window.location.href = "payroll-individual.php";
});


shipmentIndividualBtn.addEventListener('click', () => {
    window.location.href = "shipment-individual.php";
});

vehicleBtn.addEventListener('click', () => {
    window.location.href = "vehicle-list-subcontractor.php";
});
/*
accountBtn.addEventListener('click', () => {
    window.location.href = "subcontractor-group.php";
});*/

userBtn.addEventListener('click', () => {
    window.location.href = "user-profile-subcontractor.php";
});