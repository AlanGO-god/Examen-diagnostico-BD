<?php
require_once 'Model/sistema.php';
$fecha_corte = isset($_GET['fecha_corte']) ? trim($_GET['fecha_corte']) : date('Y-m-d');
$sistema = new Sistema();
$resultados_4 = $sistema->reporte_4($fecha_corte);
require_once 'Views/header.php';
require_once 'Views/Reporte4/punto4.php';     
require_once 'Views/Reporte4/grafica4.php';   
require_once 'Views/footer.php';
?>