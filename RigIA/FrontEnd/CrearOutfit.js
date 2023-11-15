function cambiarEtiqueta(nuevaEtiqueta) {
    var etiquetaLink = document.getElementById('etiqueta-link');
    etiquetaLink.innerHTML =  nuevaEtiqueta + ' <i class="fa-solid fa-angle-down"></i>';
    var etiquetaoptions = document.getElementById('etiqueta-options');
    etiquetaoptions.style.display = 'none'; 

}

// Quiero que se vuelva a poder abrir etiqueta-dropdown
 function abrirEtiquetaDropdown() {
    var etiquetaoptions = document.getElementById('etiqueta-options');
    etiquetaoptions.style.display = 'block';
}

