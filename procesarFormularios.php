
<button ><a href="redi.php">dasd</a> </button>

<?php
// Verifica si se han enviado datos a través de POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa los datos del formulario nuevo producto
    include 'conexion.php';

    // Verificar la conexión

    // SABER QUE FORMULARIO LLEGÓ POR MEDIO DEL SWITCH CONSULTANDO POR EL NOMBRE DEL BOTON DE CADA FORMULARIO 
    switch($_POST['submit']) {
        case 'Registrar Producto':
            // Procesar el formulario de producto
            $cod_barras = $_POST['cod_barras'];
            $descripcion = $_POST['descripcion'];

            // Preparar la consulta SQL para insertar en la tabla producto
            $sql = "INSERT INTO producto (CodBarras, Descripción) VALUES ('$cod_barras', '$descripcion')";

            break;

        case 'Registrar Registro':
            // Procesar el formulario de registros
            $cod_barras = $_POST['cod_barras'];
            $cod_sede = $_POST['cod_sede'];
            $num_doc_emple = $_POST['num_doc_emple'];
            $fecha = $_POST['fecha'];
            $cantidad = $_POST['cantidad'];

            // Preparar la consulta SQL para insertar en la tabla registros
            $sql = "INSERT INTO registros (CODBARRAS, CODSEDE, NUMDOCEMPLE, Fecha, Cantidad) VALUES ('$cod_barras', '$cod_sede', '$num_doc_emple', '$fecha', '$cantidad')";

            break;

        case 'Registrar Trabajador':
            // Procesar el formulario de trabajador
            $id_empleado = $_POST['id_empleado'];
            $contra = $_POST['contra'];
            $cod_sede = $_POST['cod_sede'];
            $cargo = $_POST['cargo'];

            // Preparar la consulta SQL para insertar en la tabla trabajador
            $sql = "INSERT INTO trabajador (IdEmpleado, Contra, CODSEDE, Cargo) VALUES ('$id_empleado', '$contra', '$cod_sede', '$cargo')";

            break;

        default:
            echo "Error: formulario no reconocido.";
    }

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo    "<script> window.alert('Datos insertados correctamente.'); </script>";
    } else {
        echo "<script> window.alert('Error al insertar los datos.'); </script>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>