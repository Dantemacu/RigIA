document.addEventListener("DOMContentLoaded", function() {
    const puntosOpen = document.querySelectorAll(".punto-open");
    const drawer = document.querySelector(".drawer");
    const drawerBackground = document.getElementById("drawer-background");
  
    puntosOpen.forEach(function(punto) {
      punto.addEventListener("click", function() {
        drawer.classList.add("open");
        drawerBackground.style.display = "block";
      });
    });
  
    drawerBackground.addEventListener("click", function() {
      drawer.classList.remove("open");
      drawerBackground.style.display = "none";
    });

});

  