<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios</title>
    <link rel="stylesheet" href="estilos.css">

</head>
<body>

<form method="GET" style="display: none;" class="formulario" id="formulario-nuevo-producto">
    <h2>REGISTRAR NUEVO PRODUCTO</h2>
    <label for="cod_barras">Código de Barras:</label>
    <input type="text" id="cod_barras" name="cod_barras" required><br>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br>
    <input type="submit" name="submit" value="Registrar Producto">
</form>


<form method="GET" style="display: none;" class="formulario" id="formulario-reporte-abarrote">
    <h2>INGRESO DE ABARROTE</h2>

    <div class="input-wrapper" >
                <label for="cod_barras">Código de Barras:</label>
                <input type="text" id="cod_barras" name="cod_barras" required>
            </div>
             <br>
            <div class="input-wrapper" id="input-wrapper">
                <label for="cod_sede">Código de Sede:</label>
                <select id="cod_sede" name="cod_sede" required class="select1">
                    <?php
                    include 'conexion.php';
                    $sql_sedes = "SELECT CodSede, Nombre FROM sede";
                    $result_sedes = $conn->query($sql_sedes);
                    if ($result_sedes->num_rows > 0) {
                        while($row_sede = $result_sedes->fetch_assoc()) {
                            echo "<option value='".$row_sede["CodSede"]."'>".$row_sede["Nombre"]."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="input-wrapper">
                <label for="num_doc_emple">Número de tipo de empleado:</label>
                <input type="text" id="num_doc_emple" name="num_doc_emple" required>
            </div>
            <br>
            <div class="input-wrapper">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <br>
            <div class="input-wrapper">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required min="0">
            </div>
            <br>
            <div class="button-wrapper">
                <input type="submit" value="Registrar Registro">

            </div>
            <br>
</form>

<form method="GET" style="display: none;" class="formulario" id="formulario-reporte-perecedero">
    <h2>INGRESO DE PERECEDERO</h2>
    <label for="cod_barras">Código de Barras:</label> <br>
    <input type="text" id="cod_barras" name="cod_barras" required><br>
    <label for="cod_sede">Código de Sede:</label><br>
    <input type="text" id="cod_sede" name="cod_sede" required><br>
    <label for="num_doc_emple">Número de Documento de Empleado:</label><br>
    <input type="text" id="num_doc_emple" name="num_doc_emple" required><br>
    <label for="fecha">Fecha:</label><br>
    <input   type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly><br>
    <label for="cantidad">PESAJE O CANTIDAD:</label><br>
    <input type="text" id="cantidad" name="cantidad" required><br>
    <input type="submit" name="submit" value="Registrar Registro">
</form>

<form method="GET" style="display: none;" class="formulario" id="formulario-consultar-fecha">
    <h2> CONSULTA POR FECHAS</h2>
    <label for="cod_barras">Código de Barras:</label>
    <input type="text" id="cod_barras" name="cod_barras" required><br>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br>
    <input type="submit" name="submit" value="Registrar Producto">
</form>

<form  method="GET" style="display: none;" class="formulario" id="formulario-consultar-barras">
    <h2> CONSULTA POR CODIGO DE BARRAS</h2>
    <label for="cod_barras">Código de Barras:</label>
    <input type="text" id="cod_barras" name="cod_barras" required><br>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required><br>
    <input type="submit" name="submit" value="Registrar Producto">
</form>

<form  method="GET" style="display: none;"  class="formulario" id="formulario-trabajador">
    <h2>Formulario para Registrar Trabajador</h2>
    <label for="contra">Contraseña:</label>
    <input type="password" id="contra" name="contra" required><br>
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
    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" required><br>
    <input type="submit" name="submit" value="Registrar Trabajador">
</form>

</body>
</html>
