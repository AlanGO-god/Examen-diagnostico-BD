<?php
require_once 'conexion.php';

$sql = "SELECT 
            d.dept_name AS departamento,
            t.title AS puesto,
            ROUND(AVG(TIMESTAMPDIFF(MONTH, t.from_date, t.to_date)), 1) AS meses_promedio
        FROM employees e
        INNER JOIN titles t ON e.emp_no = t.emp_no
        INNER JOIN dept_emp de ON e.emp_no = de.emp_no
        INNER JOIN departments d ON de.dept_no = d.dept_no
        WHERE t.to_date < '9999-01-01'
        GROUP BY d.dept_name, t.title
        ORDER BY meses_promedio DESC
        LIMIT 15";

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 6 - Análisis de Movilidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container py-4">
    <a href="index.php" class="btn btn-outline-secondary mb-3">&larr; Volver al Menú</a>
    <h2>Análisis de Permanencia Media por Puesto y Departamento</h2>
    <p class="text-muted">Utilidad: Ayuda a Recursos Humanos a medir la velocidad de rotación o ascenso de puestos clave.</p>

    <div class="row">
        <div class="col-lg-6">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Departamento</th>
                        <th>Puesto</th>
                        <th>Meses Promedio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $r): ?>
                    <tr>
                        <td><?=$r['departamento']?></td>
                        <td><?=$r['puesto']?></td>
                        <td><?=$r['meses_promedio']?> meses</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const chartData = <?=json_encode($data)?>;
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: chartData.map(d => `${d.departamento} (${d.puesto})`),
                datasets: [{
                    label: 'Meses promedio en el puesto',
                    data: chartData.map(d => d.meses_promedio),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            },
            options: {
                indexAxis: 'y'
            }
        });
    </script>
</body>
</html>