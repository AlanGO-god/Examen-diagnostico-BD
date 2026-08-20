<?php
require_once 'Model/sistema.php';

// Instanciamos el sistema y obtenemos los datos promediados
$sistema = new Sistema();
$resultados_2 = $sistema->reporte_2();

// Carga secuencial de la arquitectura de la vista
require_once 'Views/header.php';
require_once 'Views/Reporte2/punto2.php';     // Tabla de desglose de promedios
require_once 'Views/Reporte2/grafica2.php';   // Script de inicialización de Chart.js
require_once 'Views/footer.php';
?>