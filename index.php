<?php
session_start();

include 'conexion.php';

$mostrarFormulario = true;

// Verificar si el usuario ya está conectado
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Obtener el cargo del usuario desde la sesión
    $cargo = $_SESSION['cargo'];
    $mostrarFormulario = false;
}

if(isset($_POST['submit'])){
    switch($_POST['submit']) {
        case 'Verificar':
            // Procesar el formulario de verificación de empleado
            if(isset($_POST['num_doc']) && isset($_POST['sede']) && isset($_POST['contra']) 
                && !empty($_POST['num_doc']) && !empty($_POST['sede']) && !empty($_POST['contra'])) {

                $num_doc = $_POST['num_doc'];
                $sede = $_POST['sede'];
                $contra = $_POST['contra'];
                
                $sql = "SELECT * FROM trabajador WHERE IdEmpleado = '$num_doc' AND CODSEDE = '$sede' AND Contra = '$contra'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $mostrarFormulario = false;
                    $row = $result->fetch_assoc();
                    $cargo = $row["Cargo"];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['cargo'] = $cargo; // Almacena el cargo del usuario en la sesión
                } else {
                    echo "<div class='error'><p>Hay un campo que es incorrecto.</p></div>";
                }
            }
            break;

        default:
            echo "Error: formulario no reconocido.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión y Verificación de Empleado</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        function mostrarPassword(){
            var cambio = document.getElementById("contra");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('').addClass('');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('').addClass('');
            }
        } 
        
        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
</head>
<body>
    <?php if ($mostrarFormulario): ?>
            <div class="container2">
                <h2>Verificar Empleado</h2>
                <form action="index.php" method="POST">
                    <div class="input-wrapper" id="input-wrapper">
                        <label for="num_doc">Tipo de empleado:</label>
                        <input type="text" id="num_doc" name="num_doc"  class="num_doc" placeholder="Ingrese su número de empleado">
                        <span class="icon">✏️</span>
                    </div>
                    <div class="input-wrapper" id="input-wrapper" >
                        <label for="sede">Sede:</label> <br>
                        <select id="sede" name="sede" class="num_doc" required>
                            <option value="" hidden>Selecciona una sede</option>
                            <option value="1">Guaimaral</option>
                            <option value="2">Niza</option>
                            <option value="3">Sexta</option>
                            <option value="4">Patios</option>
                            <option value="5">Zulia</option>
                            <option value="6">Trapiches</option>
                        </select>
                        <span class="icon">🏢</span>
                    </div> <br>
                    <div class="input-wrapper" id="input-wrapper" >
                        <label for="contra">Contraseña:</label> <br>
                        <input type="password" id="contra" class="num_doc" name="contra" required placeholder="Ingrese su contraseña">
                        <span class="icon" onclick="mostrarPassword()">🔒</span></button>
                    </div> <br>
                    <div class="button-wrapper">
                        <input type="submit" name="submit" value="Verificar"> 
                    </div>
                </form>
            </div>
    <?php else: ?>
    
        <!-- Aquí va el contenido adicional después de la verificación -->
        <center>
        <div class="div-padre-inicio">
            <!-- PRIMER HIJO SERÁ BARRA DE ARRIBA Y TENDRÁ 3 HIJOS-->
            <div class="div-hijo-arriba-inicio">
                
                <!-- LOGO -->
                <div class="logo">
                    <img src="logo-blanco-pyf.png" class="logo-blanco-pyf">
                </div>
                <!-- TEXTO DE BIENVENIDA -->
                <div class="texto">
                    <p class="p-div-texto">BIENVENIDO (A) <?php echo $cargo; ?>, CUENTAS CON <br> LAS OPCIONES</p>
                </div>
                
                <!-- DESLIZADOR PARA MOSTRAR TODAS LAS OPCIONES -->
                <div class="menu" id="Desplegable">
                    <p class="p-div-menu"><span>=</span></p>
                </div>
            
            </div>
            
            <div class="div-hijo-opciones" id="div-hijo-opciones">
                <div class="div-hijo-opciones-mostradas">
                    <!-- OPCIONES A MOSTRAR -->
                    <div class="opcion" id="opcion-nuevo-producto" <?php if ($cargo != 'ADMIN' && $cargo != 'LIDER INVENTARIO' && $cargo != 'AUXILIAR INVENTARIO') echo 'style="display:none;"'; ?>>
                        <span>•</span> REGISTRAR PRODUCTO NUEVO
                    </div>

                    <div class="opcion" id="opcion-reporte-abarrote" <?php if ($cargo != 'ADMIN' && $cargo != 'LIDER INVENTARIO' && $cargo != 'AUXILIAR INVENTARIO' &&
                                                                                    $cargo !='LIDER PUNTO VENTA') echo 'style="display:none;"'; ?>>
                        <span>•</span> REALIZAR REPORTE DE ABARROTES
                    </div>

                    <div class="opcion" id="opcion-reporte-perecedero" <?php if ($cargo != 'ADMIN' && $cargo != 'LIDER INVENTARIO' && $cargo != 'AUXILIAR INVENTARIO' &&
                                                                           $cargo !='LIDER PUNTO VENTA') echo 'style="display:none;"'; ?>>
                        <span>•</span> REALIZAR REPORTE DE PERECEDEROS
                    </div>

                    <div class="opcion" id="opcion-fechas" <?php if ($cargo != 'LIDER INVENTARIO' && $cargo != 'ADMIN' && $cargo != 'AUXILIAR INVENTARIO') echo 'style="display:none;"'; ?>>
                        <span>•</span> CONSULTAR REPORTES POR FECHA
                    </div>

                    <div class="opcion" id="opcion-barras" <?php if ($cargo != 'ADMIN' && $cargo != 'LIDER INVENTARIO' && $cargo != 'AUXILIAR INVENTARIO') echo 'style="display:none;"'; ?>>
                        <span>•</span> CONSULTAR REPORTE POR CODIGO DE BARRAS
                    </div>

                    <div class="opcion" id="opcion-trabajador" <?php if ($cargo != 'ADMIN') echo 'style="display:none;"'; ?>>
                        <span>•</span> REGISTRAR NUEVO TRABAJADOR
                    </div>
                    <!-- Agregar más opciones si es necesario -->
                </div>
            </div>

            <!-- SEGUNDO HIJO SERÁ BARRA DE ABAJO -->
            <div class ="div-hijo-abajo-inicio">
                <div class="div-hijo-hijo-abajo-inicio" >
                    <divc class="div-para-formularios">
                        <div class="div-dentro-div-para-formularios">
                            <!-- Aquí aparecerá el formulario según la opción que se haga clic -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </center>
    <?php endif; ?>

    <!-- Importar el archivo JavaScript -->
    <script src="funciones.js"></script>

<?php
// Verificar si se ha enviado algún formulario
if(isset($_GET['submit'])){
    // Establecer la conexión a la base de datos
    include 'conexion.php';

    // Verificar la conexión

    // SABER QUE FORMULARIO LLEGÓ POR MEDIO DEL SWITCH CONSULTANDO POR EL NOMBRE DEL BOTON DE CADA FORMULARIO 
    switch($_GET['submit']) {
        case 'Registrar Producto':
            // Procesar el formulario de producto
            $cod_barras = $_GET['cod_barras'];
            $descripcion = $_GET['descripcion'];

            // Preparar la consulta SQL para insertar en la tabla producto
            $sql1 = "INSERT INTO producto (CodBarras, Descripción) VALUES ('$cod_barras', '$descripcion')";

            break;

        case 'Registrar Registro':
            // Procesar el formulario de registros
            $cod_barras = $_GET['cod_barras'];
            $cod_sede = $_GET['cod_sede'];
            $num_doc_emple = $_GET['num_doc_emple'];
            $fecha = $_GET['fecha'];
            $cantidad = $_GET['cantidad'];

            // Preparar la consulta SQL para insertar en la tabla registros
            $sql1 = "INSERT INTO registros (CODBARRAS, CODSEDE, NUMDOCEMPLE, Fecha, Cantidad) VALUES ('$cod_barras', '$cod_sede', '$num_doc_emple', '$fecha', '$cantidad')";

            break;

        case 'Registrar Trabajador':
            // Procesar el formulario de trabajador
            $id_empleado = $_GET['id_empleado'];
            $contra = $_GET['contra'];
            $cod_sede = $_GET['cod_sede'];
            $cargo = $_GET['cargo'];

            // Preparar la consulta SQL para insertar en la tabla trabajador
            $sql1 = "INSERT INTO trabajador (IdEmpleado, Contra, CODSEDE, Cargo) VALUES ('$id_empleado', '$contra', '$cod_sede', '$cargo')";

            break;

        default:
            echo "Error: formulario no reconocido.";
    }

    // Ejecutar la consulta SQL
    if ($conn->query($sql1) === TRUE) {
        echo    "<script> window.alert('Datos insertados correctamente.'); </script>";
    } else {
        echo "<script> window.alert('Error al insertar los datos.'); </script>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

</body>
</html>