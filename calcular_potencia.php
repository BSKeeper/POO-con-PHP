<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><!--  Define la codificación de caracteres para el documento HTML -->
    <title>Calcular Potencia</title> <!-- Título de la página -->
</head>
<body>
    <h2>Calcular Potencia</h2> <!-- Encabezado principal -->

    <!-- Formulario para ingresar la base y la potencia -->
    <form action="calcular_potencia.php" method="POST">
        <!-- Campo de entrada para la base -->
        <label for="base">Base:</label>
        <input type="number" id="base" name="base" required><br> <!-- Input de número obligatorio para la base -->
        
        <!-- Campo de entrada para la potencia -->
        <label for="potencia">Potencia:</label>
        <input type="number" id="potencia" name="potencia" required><br><br> <!-- Input de número obligatorio para la potencia -->
        
        <input type="submit" value="Calcular"> <!-- Botón para enviar el formulario -->
    </form>

    <br> <!-- Salto de línea -->
    <?php
    // Verifica si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {//$_SERVER["REQUEST_METHOD"] devuelve el método HTTP utilizado para acceder a la página, como GET o POST.
		//La condición == "POST" comprueba si el formulario fue enviado usando el método POST, que es comúnmente utilizado para enviar datos de forma segura y no visible en la URL.
        // Definición de la clase Potencia
        class Potencia {
            private $base;     // Variable privada para almacenar la base
            private $potencia; // Variable privada para almacenar la potencia

            // Constructor que inicializa la base y la potencia
            public function __construct($base, $potencia) {
                $this->base = $base;           // Asigna el valor de la base
                $this->potencia = $potencia;   // Asigna el valor de la potencia
            }

            // Método para calcular la potencia (aunque no se usa en este caso)
            public function calcularPotencia() {
                $resultado = 1; // Inicializa el resultado en 1
                // Bucle para multiplicar la base por sí misma según la potencia
                for ($i = 0; $i < $this->potencia; $i++) {
                    $resultado *= $this->base; // Multiplica el resultado por la base en cada iteración
                }
            }

            // Método para mostrar el resultado de la potencia
            public function mostrarResultado() {
                $resultado = 1; // Inicializa el resultado en 1
                // Bucle para calcular la potencia
                for ($i = 0; $i < $this->potencia; $i++) {
                    $resultado *= $this->base; // Multiplica el resultado por la base en cada iteración
                }
                echo "<h3>Resultado</h3>"; // Muestra el encabezado del resultado
                echo "<h4>Base $this->base potencia $this->potencia = "; // Muestra la base y la potencia
                
                // Bucle para mostrar la multiplicación paso a paso
                for ($i = 1; $i <= $this->potencia; $i++) {
                    if ($i > 1) echo " * "; // Muestra el símbolo de multiplicación entre valores
                    echo $this->base;       // Muestra la base
                }
                echo " = $resultado</h4>"; // Muestra el resultado final de la potencia
            }

            // Destructor que limpia los recursos utilizados
            public function __destruct() {
                unset($this->base);     // Elimina la variable base
                unset($this->potencia); // Elimina la variable potencia
            }
        }

        // Obtención de los valores de la base y la potencia desde el formulario
        $base = intval($_POST["base"]);           // Convierte el valor de la base a entero
        $potencia = intval($_POST["potencia"]);   // Convierte el valor de la potencia a entero

        // Creación del objeto Potencia y llamada al método mostrarResultado
        $potenciaCalc = new Potencia($base, $potencia); // Crea una instancia de la clase Potencia
        $potenciaCalc->mostrarResultado();             // Llama al método para mostrar el resultado
    }
    ?>

    <!-- Enlace para volver a la página anterior -->
    <a href="index.php">Volver</a>
</body>
</html>
