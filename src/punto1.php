<?php
include_once "model/sistema.php";
$app = new Sistema();
$resultados_1 = $app->reporte_1();
include_once "Views/header.php";
include_once "Views/Reporte1/punto1.php";
include_once "Views/Reporte1/grafica1.php";
include_once "Views/footer.php";
?>