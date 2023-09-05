document.addEventListener("DOMContentLoaded", function() {
    const openButton = document.getElementById("barra-opn");
    const closeButton = document.getElementById("barra-close");
    const navBar = document.querySelector(".barra-options");

    openButton.addEventListener("click", function() {
        navBar.classList.add("open");
    });
    
    closeButton.addEventListener("click", function() {
        navBar.classList.remove("open");
    });

})
