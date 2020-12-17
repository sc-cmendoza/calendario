<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/notifier.js"></script>
    <script type="text/javascript" src="../js/calendario.js"></script>
    <script type="text/javascript" src="../js/index.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <form id="form" action="" method="POST" class="calendar_form">
        <button type="submit" disabled style="display: none" aria-hidden="true"></button>

        <div>
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="text" name="fecha_inicio" id="fecha_inicio" value="12-2006">
        </div>
        
        <div>
            <label for="fecha_fin">Fecha final:</label>
            <input type="text" name="fecha_fin" id="fecha_fin" value="02-2007">
        </div>

        <div>
            <label for="columns">Columnas:</label>
            <select name="" id="columns" de>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3" selected>03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
            </select> 
        </div>
        
        <button id='smtbtn'>Enviar</button>
    </form>
    <div id="calendario">
    </div>
</body>
</html>