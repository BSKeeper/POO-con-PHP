<!DOCTYPE html> <!-- Declara el tipo de documento y la versión de HTML -->
<html lang="es"> <!-- Define el idioma del documento como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres como UTF-8 -->
    <title>Promedio de Notas</title> <!-- Título de la página que se muestra en la pestaña del navegador -->
</head>
<body>
    <h2>Promedio de Notas</h2> <!-- Encabezado principal de la página -->

    <!-- Formulario inicial para ingresar el número de estudiantes -->
    <form action="calcular_promedio.php" method="POST"> <!-- Formulario que envía datos al archivo calcular_promedio.php usando el método POST -->
        <label for="numEstudiantes">Número de Estudiantes:</label> <!-- Etiqueta para el campo del número de estudiantes -->
        <input type="number" id="numEstudiantes" name="numEstudiantes" min="2" required> <!-- Campo de entrada para el número de estudiantes con un valor mínimo de 2 y obligatorio -->
        <input type="submit" value="Enviar"> <!-- Botón para enviar el formulario -->
    </form>

    <?php
    // Definición de la interfaz para estudiantes
    interface IEstudiante { 
        public function mostrarNotas(); // Declaración del método mostrarNotas que debe ser implementado por cualquier clase que use esta interfaz
    }

    // Clase abstracta que implementa la interfaz IEstudiante
    abstract class EstudianteBase implements IEstudiante { 
        protected $nombre; // Variable protegida para almacenar el nombre del estudiante. 
        //La clase Estudiante, que hereda de EstudianteBase, puede acceder a estas variables para usarlas en su propia implementación del método mostrarNotas.
        protected $notas; // Variable protegida para almacenar las notas del estudiante
		//El acceso directo a estas variables desde fuera de estas clases no es posible, asegurando que 
        // Constructor que inicializa la base de datos y las notas. Solo las clases autorizadas puedan modificar o utilizar estos datos.
        public function __construct($nombre, $notas) { 
            $this->nombre = $nombre; // Asigna el valor del nombre
            $this->notas = $notas; // Asigna el valor de las notas
        }

        // Método que se puede sobreescribir en la clase hija
        public function mostrarNotas() { 
            // Implementación básica en la clase padre
            echo "<h4>Datos del Estudiante:</h4>"; // Muestra el encabezado de los datos del estudiante
            echo "Nombre: $this->nombre<br>"; // Muestra el nombre del estudiante
            echo "Notas: "; // Muestra el texto "Notas:"
            foreach ($this->notas as $corte => $nota) { // Itera sobre las notas del estudiante
                echo ucfirst($corte) . ": $nota<br>"; // Muestra el nombre del corte y la nota correspondiente
                //ucfirst es una función de PHP que convierte el primer carácter de una cadena en mayúscula.
            }
        }

        // Destructor que limpia los recursos utilizados
        public function __destruct() { 
            unset($this->nombre); // Elimina la variable nombre
            unset($this->notas); // Elimina la variable notas
        }
    }

    // Clase Estudiante que hereda de EstudianteBase
    class Estudiante extends EstudianteBase { 
        // Sobreescritura del método mostrarNotas
        public function mostrarNotas() { 
            $primerCorte = $this->notas['primerCorte']; // Obtiene la nota del primer corte
            $segundoCorte = $this->notas['segundoCorte']; // Obtiene la nota del segundo corte
            $tercerCorte = $this->notas['tercerCorte']; // Obtiene la nota del tercer corte
            $notaFinal = ($primerCorte * 0.3) + ($segundoCorte * 0.3) + ($tercerCorte * 0.4); // Calcula la nota final

            // Llamada al método padre para mostrar la información básica
            parent::mostrarNotas(); // Llama al método mostrarNotas de la clase base

            // Implementación específica en la clase hija
            echo "<h4>Notas Detalladas:</h4>"; // Muestra el encabezado de notas detalladas
            echo "Primer Corte: $primerCorte (30%)<br>"; // Muestra la nota del primer corte y su peso
            echo "Segundo Corte: $segundoCorte (30%)<br>"; // Muestra la nota del segundo corte y su peso
            echo "Tercer Corte: $tercerCorte (40%)<br>"; // Muestra la nota del tercer corte y su peso
            echo "Nota Final: $notaFinal<br>"; // Muestra la nota final calculada

            // Mensaje de honor si la nota final es mayor o igual a 4.5
            if ($notaFinal >= 4.5) { 
                echo "<strong>¡Felicidades! Este estudiante ha alcanzado un nivel de honor.</strong><br>"; // Muestra un mensaje de felicitaciones si la nota final es alta
            }
            echo "<br>"; // Salto de línea
        }
    }

    // Verifica si el formulario para ingresar el número de estudiantes fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["nombre1"])) { //$_SERVER["REQUEST_METHOD"] devuelve el método HTTP utilizado para acceder a la página, como GET o POST.
		//== "POST" Compara el valor de $_SERVER["REQUEST_METHOD"] con la cadena "POST".
		//Esto verifica si la solicitud se hizo usando el método HTTP POST, que se usa comúnmente para enviar datos de formularios.
		//isset($_POST["nombre1"]) verifica si el índice "nombre1" está definido en la variable $_POST y no es null
        $numEstudiantes = intval($_POST["numEstudiantes"]); // Obtiene y convierte el número de estudiantes a entero

        // Verifica que el número de estudiantes sea al menos 2
        if ($numEstudiantes < 2) { 
            echo "<p>El número mínimo de estudiantes es 2. Por favor, vuelva a intentarlo.</p>"; // Muestra un mensaje de error si el número de estudiantes es menor a 2
        } else {
            // Mostrar formulario para ingresar datos de los estudiantes
            echo "<h3>Ingrese los datos de los estudiantes:</h3>"; // Muestra el encabezado para ingresar los datos
            echo "<form action='calcular_promedio.php' method='POST'>"; // Abre un nuevo formulario para enviar los datos de los estudiantes
            echo "<input type='hidden' name='numEstudiantes' value='$numEstudiantes'>"; // Campo oculto para enviar el número de estudiantes al siguiente formulario
            for ($i = 1; $i <= $numEstudiantes; $i++) { // Itera para mostrar campos de entrada para cada estudiante
                echo "<h4>Estudiante $i</h4>"; // Muestra el encabezado para el estudiante actual
                echo "<label for='nombre$i'>Nombre:</label>"; // Etiqueta para el campo de nombre
                echo "<input type='text' id='nombre$i' name='nombre$i' required><br>"; // Campo de entrada para el nombre del estudiante
                echo "<label for='primerCorte$i'>Nota Primer Corte:</label>"; // Etiqueta para el campo de nota del primer corte
                echo "<input type='number' id='primerCorte$i' name='primerCorte$i' step='0.01' required><br>"; // Campo de entrada para la nota del primer corte
                echo "<label for='segundoCorte$i'>Nota Segundo Corte:</label>"; // Etiqueta para el campo de nota del segundo corte
                echo "<input type='number' id='segundoCorte$i' name='segundoCorte$i' step='0.01' required><br>"; // Campo de entrada para la nota del segundo corte
                echo "<label for='tercerCorte$i'>Nota Tercer Corte:</label>"; // Etiqueta para el campo de nota del tercer corte
                echo "<input type='number' id='tercerCorte$i' name='tercerCorte$i' step='0.01' required><br>"; // Campo de entrada para la nota del tercer corte
            }
            echo "<br><input type='submit' value='Calcular Promedios'>"; // Botón para enviar el formulario con los datos de los estudiantes
            echo "</form>"; // Cierra el formulario
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre1"])) { //Si la solicitud actual se realizó usando el método HTTP POST y el índice "nombre1" está presente en los datos enviados por POST, Entonces ejecuta el bloque de código dentro del elseif.
        // Procesar los datos de los estudiantes
        $numEstudiantes = intval($_POST["numEstudiantes"]); // Obtiene y convierte el número de estudiantes a entero
        $error = false; // Inicializa la variable de error como falso

        echo "<h3>Resultado:</h3>"; // Muestra el encabezado de los resultados

        for ($i = 1; $i <= $numEstudiantes; $i++) { // Itera sobre cada estudiante
            $nombre = $_POST["nombre$i"]; // Obtiene el nombre del estudiante
            $notas = [ // Crea un array con las notas del estudiante
                'primerCorte' => $_POST["primerCorte$i"], // Nota del primer corte
                'segundoCorte' => $_POST["segundoCorte$i"], // Nota del segundo corte
                'tercerCorte' => $_POST["tercerCorte$i"] // Nota del tercer corte
            ];

            // Verificar que las notas estén entre 0 y 5
            foreach ($notas as $nota) { // Itera sobre las notas
                if ($nota < 0 || $nota > 5) { // Verifica si alguna nota está fuera del rango 0-5
                    $error = true; // Marca un error si alguna nota es inválida
                    echo "<p>Error: La nota de $nombre en uno de los cortes no está entre 0 y 5. Por favor, vuelva a intentarlo.</p>"; // Muestra un mensaje de error
                    break; // Sale del bucle de notas
                }
            }

            if (!$error) { // Si no hay errores
                // Crear una instancia de Estudiante
                $estudiante = new Estudiante($nombre, $notas); // Crea una instancia de la clase Estudiante
                $estudiante->mostrarNotas(); // Llama al método mostrarNotas para mostrar la información del estudiante
            } else {
                break; // Sale del bucle si hay un error
            }
        }
    }
    ?>

    <br> <!-- Salto de línea -->
    <a href="index.php">Volver</a> <!-- Enlace para regresar a la página anterior -->
</body>
</html>
