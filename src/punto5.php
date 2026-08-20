<?php
include_once "model/sistema.php";
$app5 = new Sistema();
$resultados_5 = $app5->reporte_5();
include_once "Views/header.php";
include_once "Views/Reporte5/punto5.php";
include_once "Views/Reporte5/grafica5.php";
include_once "Views/footer.php";
?>