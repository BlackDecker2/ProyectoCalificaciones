<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestor Calificaciones - Univalle</title>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #c21b1b;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 65px;
            height: 65px;
        }

        .menu {
            display: flex;
            align-items: center;
        }

        .menu a {
            color: #ffffff; /* Cambia el color del texto a uno que te guste */
            text-decoration: none;
            margin: 10px;
            font-size: 18px;
            font-weight: bold; /* Agrega negritas al texto */
            transition: color 0.3s; /* Añade una transición de color al pasar el mouse sobre los enlaces */
        }

        .menu a:hover {
            color: #979797; /* Cambia el color cuando se pasa el mouse sobre los enlaces */
        }


       

        .welcome-container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 30px auto;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-login {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .news-section {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 30px auto;
            max-width: 1000px;
        }

        .owl-carousel {
            margin-top: 20px;
        }

        .owl-carousel .item img {
            display: block;
            width: 100%;
            height: auto;
        }

        .sectioninfo-card {
            margin: 30px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }

        .sectioninfo-card .card-header {
            background: #007BFF;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .sectioninfo-card h2 {
            font-size: 24px;
            margin: 0;
        }

        .sectioninfo-card .card-body {
            padding: 20px;
        }

        .ul-quick-help, .ul-topics-of-interest {
            list-style: none;
            padding: 0;
        }

        .ul-quick-help li, .ul-topics-of-interest li {
            margin: 10px 0;
        }

        .ul-quick-help li a, .ul-topics-of-interest li a {
            text-decoration: none;
            color: #000000;
        }

        .ul-quick-help li a:hover, .ul-topics-of-interest li a:hover {
            text-decoration: underline;
        }

        .sectioninfo-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        flex: 1;
    }

    .sectioninfo-card .card-header {
        background-color: #ff0000;
        color: #fff;
        padding: 10px;
    }

    .sectioninfo-card .card-body ul {
        list-style: none;
        padding: 0;
    }

    .sectioninfo-card .card-body li {
        margin: 10px 0;
    }

    .sectioninfo-card .card-body li a {
        color: #ff0000;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .sectioninfo-card .card-body li a:hover {
        color: #442828;
    }
    
    .sectioninfo-card .card-body p {
        margin: 10px 0;
        font-size: 16px;
    }

    .sectioninfo-card .card-body p img {
        vertical-align: middle;
        margin-right: 10px;
    }

    .sectioninfo-card .card-body a {
        color: #007BFF;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .sectioninfo-card .card-body a:hover {
        color: #0056b3;
    }
    .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
</style>


</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('img/logorojo.png') }}" alt="Logo">
        </div>
        <div class="menu">
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registro</a>
        </div>
    </div>


    <div class="news-section">
        <h2>Últimas Noticias</h2>
        <div class="owl-carousel">
            <div class="item"><img src="{{ asset('images/anuciopower.jpg') }}" alt="Noticia 1"></div>
            <div class="item"><img src="{{ asset('images/anunciodocumento.png') }}" alt="Noticia 2"></div>
            <div class="item"><img src="{{ asset('images/background.jpg') }}" alt="Noticia 3"></div>
        </div>
    </div>

    <div id="row-sectioninfo-cards" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">

        <div style="display: flex;">
            <div class="sectioninfo-card" style="flex: 1; margin-right: 10px;">
                <div class="card-header">
                    <h2>Ayudas Rápidas</h2>
                </div>
                <div class="card-body quick-help-card-body">
                    <ul id="ul-quick-help" class="list-unstyled">
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/login/forgot_password.php" target="_blank">Recuperar contraseña</a></li>
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/local/infocvuv/instruccion-inscripciones-cursos.php" target="_blank">Inscribir un curso</a></li>
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/local/infocvuv/tutoriales.php" target="_blank">Tutoriales</a></li>
                        <li><a href="https://docs.moodle.org/all/es/Gu%C3%ADa_r%C3%A1pida_del_profesor" target="_blank">Guía rápida de Moodle</a></li>
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/local/infocvuv/preguntas-frecuentes.php" target="_blank">Preguntas frecuentes</a></li>
                    </ul>
                </div>
            </div>
            <div class="card sectioninfo-card" style="flex: 1; margin-right: 10px;">
                <div class="card-header">
                    <h2>Atención y soporte</h2>
                </div>
                <div class="card-body">
                    <div class="container pl-0 pr-0">
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-0">
                                    <img src="https://campusvirtual.univalle.edu.co/moodle/theme/mooveuv/pix/icon/email.png" width="20" height="20"> 
                                    <a href="mailto:campusvirtual@correounivalle.edu.co">campusvirtual@correounivalle.edu.co</a>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="mt-3">
                                    <img src="https://campusvirtual.univalle.edu.co/moodle/theme/mooveuv/pix/icon/phone.png" width="20" height="20"> 602 318 26 49 o 602 318 26 53
                                </p>
                            </div>
                        </div>

                                Atención personalizada con cita previa.


                    </div>
                </div>
            </div>
            <div class="sectioninfo-card" style="flex: 1;">
                <div class="card-header">
                    <h2>Recursos Académicos</h2>
                </div>
                <div class="card-body topics-of-interest-card-body">
                    <ul id="ul-topics-of-interest">
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/course/view.php?id=72800" target="_blank">Recordando las matemáticas del colegio</a></li>
                        <li><a href="https://campusvirtual.univalle.edu.co/moodle/course/view.php?id=58943" target="_blank">Recordando las ciencias naturales del colegio</a></li>
                        <!-- Agrega más elementos de la lista aquí -->
                    </ul>
                </div>
            </div>
        </div>
        

    <footer class="footer">
        <p>© 2023 DataDocumentCalificacion_. Todos los derechos reservados.</p>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Owl Carousel Initialization -->
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                dots: true,
                nav: false
            });
        });
    </script>
</body>
</html>
