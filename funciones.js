document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar los formularios desde formularios.php
    function cargarFormularios() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'formularios.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var formularios = xhr.responseText;
                // Insertar los formularios en la página principal
                document.querySelector('.div-dentro-div-para-formularios').innerHTML = formularios;
                // Luego de insertar los formularios, llamar a la función para manejar los eventos de clic
                manejarEventosClic();
            }
        };
        xhr.send();
    }

    // Función para manejar los eventos de clic en las opciones
    function manejarEventosClic() {
        // Agregar eventos de clic a las opciones después de cargar los formularios
        document.getElementById('opcion-nuevo-producto').addEventListener('click', mostrarFormularioRegistroProducto);
        document.getElementById('opcion-reporte-abarrote').addEventListener('click', mostrarFormularioAbarrotes);
        document.getElementById('opcion-reporte-perecedero').addEventListener('click', mostrarFormularioPerecederos);
        document.getElementById('opcion-fechas').addEventListener('click', mostrarFormularioFechas);
        document.getElementById('opcion-barras').addEventListener('click', mostrarFormularioBarras);
        document.getElementById('opcion-trabajador').addEventListener('click', mostrarFormularioTrabajador);

        // Agregar más eventos de clic para otras opciones si es necesario
    }

    // Función para mostrar el desplegable de opciones
    function mostrarDesplegable() {
        var botonMenu = document.getElementById('Desplegable');
        var opciones = document.getElementById('div-hijo-opciones');
        botonMenu.addEventListener('click', function() {
            opciones.classList.toggle('mostrar-opciones');
        });
    }
    // FUNCIONES DE LLAMAR A LOS FORMULARIOS 
    // Funciones para mostrar los formularios según la opción seleccionada
    function mostrarFormularioRegistroProducto() {
        ocultarFormularios();
        document.getElementById('formulario-nuevo-producto').style.display = 'block';
        ocultarDesplegable();
    }

    function mostrarFormularioAbarrotes() {
        ocultarFormularios();
        document.getElementById('formulario-reporte-abarrote').style.display = 'block';
        ocultarDesplegable();
    }

    function mostrarFormularioPerecederos() {
        ocultarFormularios();
        document.getElementById('formulario-reporte-perecedero').style.display = 'block';
        ocultarDesplegable();
    }
    function mostrarFormularioFechas() {
        ocultarFormularios();
        document.getElementById('formulario-consultar-fecha').style.display = 'block';
        ocultarDesplegable();
    }

    function mostrarFormularioBarras() {
        ocultarFormularios();
        document.getElementById('formulario-consultar-barras').style.display = 'block';
        ocultarDesplegable();
    }

    function mostrarFormularioTrabajador() {
        ocultarFormularios();
        document.getElementById('formulario-trabajador').style.display = 'block';
        ocultarDesplegable();
    }



    // FUNCION PARA OCULTAR LOS FORMULARIOS
    function ocultarFormularios() {
        var formularios = document.querySelectorAll('.formulario');
        formularios.forEach(function(formulario) {
            formulario.style.display = 'none';
        });
    }

    // Llamar a la función para cargar los formularios al cargar la página
    cargarFormularios();

    // Llamar a la función para mostrar el desplegable al cargar la página
    mostrarDesplegable();
});