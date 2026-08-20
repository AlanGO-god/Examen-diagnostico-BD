# Examen-diagnostico-BD
<?php
include_once "model/sistema.php";
$app = new Sistema();
$resultados = $app->reporte_1();
include_once "Views/header.php";
include_once "Views/index/index.php";
include_once "Views/footer.php";
?>