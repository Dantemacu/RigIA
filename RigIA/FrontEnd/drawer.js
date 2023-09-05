document.addEventListener("DOMContentLoaded", function() {
const opendrawer = document.getElementById("open-drawer");
const closedrawer = document.getElementById("close-drawer");
const drawer = document.querySelector(".drawer");

opendrawer.addEventListener("click", function() {
    drawer.classList.add("open");
});

closedrawer.addEventListener("click", function() {
    drawer.classList.remove("open");
});

})
