<?php
include_once 'model/sistema.php';
$app_6 = new Sistema();
$resultados_6 = $app_6->reporte_6();
include_once 'Views/header.php';
include_once 'Views/Reporte6/punto6.php';
include_once 'Views/Reporte6/grafica6.php';
include_once 'Views/footer.php';
?>