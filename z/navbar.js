//PART OF NEW SYSTEM

let burger_1 = document.getElementById("burger_1")
let burger_2 = document.getElementById("burger_2")
let nav_links = document.getElementById("nav_links")

let dashboardBtn = document.getElementById("dashboardBtn")
let shipmentBtn = document.getElementById("shipmentBtn")
let defaultViewListBtn = document.getElementById("defaultViewListBtn")

let sidenav_class = document.querySelector(".sidenav_class")


burger_1.addEventListener('click', () => {
    nav_links.classList.toggle('is-active');
    sidenav_class.classList.remove('sidenav_open');
});

burger_2.addEventListener('click', () => {
    sidenav_class.classList.toggle('sidenav_open');
    nav_links.classList.remove('is-active');
});

dashboardBtn.addEventListener('click', () => {
    window.location.href = "index.php";
});

shipmentBtn.addEventListener('click', () => {
    window.location.href = "shipment.php";
});

defaultViewListBtn.addEventListener('click', () => {
    window.location.href = "default-users-view-list.php";
});