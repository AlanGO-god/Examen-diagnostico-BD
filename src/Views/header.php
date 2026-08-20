<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Diagnóstico - Big Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <aside>
        <h1><i class="fas fa-chart-pie"></i> HR Analytics Panel</h1>

        <a href="index.php" class="sidebar-home-link">
            <i class="fas fa-house"></i> <span class="text">Volver al Index</span>
        </a>

        <div class="menu-section">
            <h3> Menú de Reportes</h3>
            <a href="punto1.php" class="sidebar-link" onclick="switchView('rep-1')">
                <i class="fas fa-users-line"></i> <span class="text">Contrataciones por Año/Género</span>
            </a>
            <a href="punto2.php" class="sidebar-link" onclick="switchView('rep-2')">
                <i class="fas fa-money-bill-trend-up"></i> <span class="text">Salario Promedio Depto.</span>
            </a>
            <a href="punto3.php" class="sidebar-link" onclick="switchView('rep-3')">
                <i class="fas fa-diagram-project"></i> <span class="text">Empleados por Depto.</span>
            </a>
            <a href="punto4.php" class="sidebar-link" onclick="switchView('rep-4')">
                <i class="fas fa-cake-candles"></i> <span class="text">Rangos de Edad y Género</span>
            </a>
            <a href="punto5.php" class="sidebar-link" onclick="switchView('rep-5')">
                <i class="fas fa-arrow-trend-up"></i> <span class="text">Top Incremento Salarial</span>
            </a>
            <a href="punto6.php" class="sidebar-link" onclick="switchView('rep-6')">
                <i class="fas fa-arrow-rotate-left"></i> <span class="text">Análisis de Rotación (Nueva)</span>
            </a>
            <a href="punto7.php" class="sidebar-link" onclick="switchView('rep-7')">
                <i class="fas fa-magnifying-glass"></i> <span class="text">Buscador Detallado</span>
            </a>
        </div>

       
    </aside>
    <main>
        <div class="container-content">
