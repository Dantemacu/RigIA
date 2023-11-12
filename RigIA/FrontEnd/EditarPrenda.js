document.addEventListener('DOMContentLoaded', function () {
    var prendasLink = document.getElementById('prendas-filters');
    var etiquetasLink = document.getElementById('etiquetas-filters');
    var prendasColumn = document.getElementById('prendas-column');
    var etiquetasColumn = document.getElementById('etiquetas-column');
    var prendascolumnbackground = document.getElementById('prendas-column-background');
    var etiquetascolumnbackground = document.getElementById('etiquetas-column-background');

    prendasLink.addEventListener('click', function () {
        prendasColumn.style.display = (prendasColumn.style.display === 'none' || prendasColumn.style.display === '') ? 'block' : 'none';
        etiquetasColumn.style.display = 'none';
        prendascolumnbackground.style.display = 'block';
        etiquetascolumnbackground.style.display = 'none';
    });

    etiquetasLink.addEventListener('click', function () {
        etiquetasColumn.style.display = (etiquetasColumn.style.display === 'none' || etiquetasColumn.style.display === '') ? 'block' : 'none';
        prendasColumn.style.display = 'none';
        prendascolumnbackground.style.display = 'none';
        etiquetascolumnbackground.style.display = 'block';
    });

    prendascolumnbackground.addEventListener('click', function () {
        prendasColumn.style.display = 'none';
        prendascolumnbackground.style.display = 'none';

    });

    etiquetascolumnbackground.addEventListener('click', function () {
        etiquetasColumn.style.display = 'none';
        etiquetascolumnbackground.style.display = 'none';

    });
});
