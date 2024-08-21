<!DOCTYPE html> <!-- Define el tipo de documento y la versión de HTML (en este caso HTML5) -->
<html lang="es"> <!-- Define el idioma de la página como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres como UTF-8, que soporta todos los caracteres especiales -->
    <title>Tablas de Multiplicar</title> <!-- Título de la página que aparece en la pestaña del navegador -->
</head>
<body>
    <h2>Tablas de Multiplicar</h2> <!-- Encabezado principal de la página -->

    <!-- Formulario para ingresar un número -->
    <form action="generar_tabla.php" method="post"> <!-- Define el formulario que envía los datos al archivo 'generar_tabla.php' usando el método POST -->
        Número: <!-- Etiqueta para el campo de entrada -->
        <input type="text" name="numero" required> <!-- Campo de entrada para el número, marcado como obligatorio -->
        <br><br> <!-- Dos saltos de línea para espaciar el formulario -->
        <button type="submit">Generar Tabla</button> <!-- Botón para enviar el formulario con el texto 'Generar Tabla' -->
    </form>
</body>
</html>
