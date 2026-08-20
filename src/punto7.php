<?php
require_once 'Model/sistema.php';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sistema = new Sistema();
$resultado_busqueda = $sistema->reporte_7($search);
$emp = $resultado_busqueda['emp'];
$titles = $resultado_busqueda['titles'];
$departments = $resultado_busqueda['departments'];
$salaries = $resultado_busqueda['salaries'];
require_once "Views/header.php";
require_once "Views/Reporte7/_form.php";
require_once "Views/Reporte7/punto7.php";
require_once "Views/footer.php";
?>