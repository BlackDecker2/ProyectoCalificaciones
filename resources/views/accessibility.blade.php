<button id="accessibility-button" class="btn btn-light">
    <i class="fas fa-universal-access" style=" color: rgb(182, 47, 47);"></i> Accesibilidad <i class="fas fa-chevron-down fa-xs"></i>
</button>
<div id="accessibility-menu" class="accessibility-menu">
    <button id="increase-font-size" style="align-content: center; margin-top:1px;">A+</button>
    <button id="decrease-font-size">A-</button>
    <button id="change-color-scheme">Cambiar Esquema de Color</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Obtén el tamaño de fuente actual
        var currentFontSize = parseInt($('body').css('font-size'));

        // Incrementa el tamaño de fuente
        $('#increase-font-size').on('click', function () {
            currentFontSize += 2;
            $('body').css('font-size', currentFontSize + 'px');
        });

        // Disminuye el tamaño de fuente
        $('#decrease-font-size').on('click', function () {
            currentFontSize -= 2;
            $('body').css('font-size', currentFontSize + 'px');
        });

        // Cambia el esquema de color
        var darkMode = false;

$('#change-color-scheme').on('click', function () {
    if (darkMode) {
        // Cambia a esquema de color claro
        $('body').removeClass('dark-mode');
        $('table').removeClass('dark-mode');
        $('section').removeClass('dark-mode');
        $('div').removeClass('dark-mode');
        $('nav').removeClass('dark-mode');
        $('h, table, td, p, div, li').css('color', ''); // Restaura el color original del texto
    } else {
        // Cambia a esquema de color oscuro
        $('body').addClass('dark-mode');
        $('table').addClass('dark-mode');
        $('section').addClass('dark-mode');
        $('div').addClass('dark-mode');
        $('nav').removeClass('dark-mode');
        $('h5, table, td, p, div, li').css('color', '#fff'); // Establece el color del texto a blanco
    }

    darkMode = !darkMode;
});



    });
</script>
