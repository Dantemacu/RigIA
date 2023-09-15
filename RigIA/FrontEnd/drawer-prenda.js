document.addEventListener("DOMContentLoaded", function() {
    const boton = document.getElementById("open-drawer");
    const drawer = document.querySelector(".drawer");
    const drawerBackground = document.getElementById("drawer-background");
  
    boton.addEventListener("click", function() {
        drawer.classList.add("open");
        drawerBackground.style.display = "block";
    });
  
    drawerBackground.addEventListener("click", function() {
        if (drawer.classList.contains("open")) {
            drawer.classList.remove("open");
            drawerBackground.style.display = "none";
        }
    });
});
