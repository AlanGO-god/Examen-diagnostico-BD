<?php
require_once 'conexion.php';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

$sql = "SELECT 
            e.emp_no,
            CONCAT(e.first_name, ' ', e.last_name) AS empleado,
            MIN(s.salary) AS salario_minimo,
            MAX(s.salary) AS salario_maximo,
            ROUND(((MAX(s.salary) - MIN(s.salary)) / MIN(s.salary)) * 100, 2) AS pct_incremento,
            TIMESTAMPDIFF(YEAR, MIN(s.from_date), MAX(s.to_date)) AS anios_carrera
        FROM employees e
        INNER JOIN salaries s ON e.emp_no = s.emp_no
        GROUP BY e.emp_no, e.first_name, e.last_name
        HAVING pct_incremento > 0
        ORDER BY pct_incremento DESC
        LIMIT :limit";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 5 - Top Incremento Salarial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container py-4">
    <a href="index.php" class="btn btn-outline-secondary mb-3">&larr; Volver al Menú</a>
    <h2>Top <?=$limit?> Empleados con Mayor Crecimiento Salarial</h2>
    
    <form method="GET" class="row g-3 my-3">
        <div class="col-auto">
            <label class="col-form-label">Cantidad a mostrar:</label>
        </div>
        <div class="col-auto">
            <input type="number" name="limit" class="form-control" value="<?=$limit?>" min="1" max="100">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-7">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Empleado</th>
                        <th>Salario Mín</th>
                        <th>Salario Máx</th>
                        <th>Años</th>
                        <th>% Incremento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><strong><?=$row['emp_no']?></strong> - <?=$row['empleado']?></td>
                        <td>$<?=number_format($row['salario_minimo'])?></td>
                        <td>$<?=number_format($row['salario_maximo'])?></td>
                        <td><?=$row['anios_carrera']?> años</td>
                        <td>
                            <div class="progress" role="progressbar">
                                <div class="progress-bar bg-success" style="width: <?=min($row['pct_incremento'], 100)?>%">
                                    <?=$row['pct_incremento']?>%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-5">
            <div class="card p-3">
                <h5>Dispersión: Años vs % Incremento</h5>
                <canvas id="scatterChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const rawData = <?=json_encode($data)?>;
        const ctx = document.getElementById('scatterChart');
        new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Empleados',
                    data: rawData.map(d => ({x: d.anios_carrera, y: d.pct_incremento, label: d.empleado})),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                scales: {
                    x: { title: { display: true, text: 'Años de Carrera' } },
                    y: { title: { display: true, text: '% Incremento Salarial' } }
                }
            }
        });
    </script>
</body>
</html>