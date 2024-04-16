<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Marvel API Demo</title>

    <!-- Inclusiones de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#comicsSection">Comics</a></li>
                <li><a href="#seriesList">Series</a></li>
                <li><a href="#contacta">Contacta</a></li>
            </ul>
        </nav>
        <section>
            <label for="buscar" id="buscar">Buscador</label>
            <!-- Aquí llamamos a la función filterComicsAndSeries desde app.js -->
            <input type="search" name="buscar" onclick="filterComicsAndSeries(event)">

        </section>
    </header>

    <main id="mainContent">
        <section id="comicsSection">
            <h2>Comics Populares</h2>
            <ul id="comicsList"></ul>
        </section>
        <section id="seriesSection">
            <h2>Series Populares</h2>
            <ul id="seriesList"></ul>
        </section>
        <!-- Ventana modal para mostrar información detallada -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </main>



    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="js/app.js"></script>


</body>

</html>