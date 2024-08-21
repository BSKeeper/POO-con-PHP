<!DOCTYPE html> <!-- Define el tipo de documento y la versión de HTML (en este caso HTML5) -->
<html lang="es"> <!-- Define el idioma de la página como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres como UTF-8, que soporta todos los caracteres especiales -->
    <title>Generar tabla</title> <!-- Título de la página que aparece en la pestaña del navegador -->
</head>
<body>
    <h2>Generar tabla</h2> <!-- Encabezado principal de la página -->

<?php
// Definición de la clase TablaMultiplicar
class TablaMultiplicar {
    // Atributo privado para almacenar el número
    private $numero;
    private $conexion; // Atributo privado para almacenar la conexión a la base de datos

    // Constructor para inicializar el número y la conexión a la base de datos
    public function __construct($numero, $conexion) {
        $this->numero = $numero; // Asigna el valor del número
        $this->conexion = $conexion; // Asigna la conexión a la base de datos
    }

    // Método para generar la tabla de multiplicar y guardar los resultados en la base de datos
    public function generarTabla() {
        echo "<h3>Tabla de multiplicar del número " . $this->numero . ":</h3>"; // Muestra el encabezado de la tabla de multiplicar
        
        // Bucle para calcular la multiplicación del número del 1 al 10
        for ($i = 1; $i <= 10; $i++) {
            $resultado = $this->numero * $i; // Calcula el resultado de la multiplicación
            echo $this->numero . " x " . $i . " = " . $resultado . "<br>"; // Muestra el resultado de la multiplicación
            
            // Inserta el resultado en la base de datos
            mysqli_query($this->conexion, "INSERT INTO tabla_multiplicar (multiplicando, multiplicador, resultado) VALUES ('" . $this->numero . "', $i, $resultado)")
                or die("Problemas en el INSERT: " . mysqli_error($this->conexion)); // Muestra un error si la inserción falla
        }
    }

    // Destructor para cerrar la conexión a la base de datos
    public function __destruct() {
        // Cerrar la conexión a la base de datos
        mysqli_close($this->conexion); // Cierra la conexión a la base de datos
        unset($this->numero); // Elimina el atributo número
        unset($this->conexion); // Elimina el atributo conexión
    }
}

// Establece la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "POO") or die("Problemas con la conexión"); // Conecta a la base de datos y muestra un error si falla

// Verifica si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"]; // Obtiene el número enviado por el formulario
    $tablaMultiplicar = new TablaMultiplicar($numero, $conexion); // Crea una instancia de la clase TablaMultiplicar
    
    // Verifica que el número no esté vacío y sea numérico
    if (!empty($numero) && is_numeric($numero)) {
        $tablaMultiplicar->generarTabla(); // Llama al método para generar la tabla de multiplicar
    } else {
        echo "Por favor, ingrese un número válido."; // Mensaje de error si el número no es válido
    }
}
?>
<!-- Enlace para volver al formulario -->
    <br><br>
    <a href="index.php">Volver</a> <!-- Enlace para regresar al formulario principal -->
</body>
</html>
