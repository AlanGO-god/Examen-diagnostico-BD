<?php
require_once 'Model/sistema.php';

// Instanciamos el sistema y obtenemos los datos de volumen de personal
$sistema = new Sistema();
$resultados_3 = $sistema->reporte_3();

// Carga secuencial de la arquitectura del panel
require_once 'Views/header.php';
require_once 'Views/Reporte3/punto3.php';     // Tabla de dimensionamiento
require_once 'Views/Reporte3/grafica3.php';   // Script de inicialización de Chart.js
require_once 'Views/footer.php';
?>