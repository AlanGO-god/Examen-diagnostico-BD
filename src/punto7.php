<?php
require_once 'conexion.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$emp = null;
$titles = [];
$departments = [];
$salaries = [];

if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE emp_no = :id OR CONCAT(first_name, ' ', last_name) LIKE :name LIMIT 1");
    $stmt->execute([':id' => $search, ':name' => "%$search%"]);
    $emp = $stmt->fetch();

    if ($emp) {
        $emp_no = $emp['emp_no'];
        // Histórico de puestos
        $tStmt = $pdo->prepare("SELECT * FROM titles WHERE emp_no = ? ORDER BY from_date DESC");
        $tStmt->execute([$emp_no]);
        $titles = $tStmt->fetchAll();

        // Histórico departamentos
        $dStmt = $pdo->prepare("SELECT d.dept_name, de.from_date, de.to_date FROM dept_emp de JOIN departments d ON de.dept_no = d.dept_no WHERE de.emp_no = ? ORDER BY de.from_date DESC");
        $dStmt->execute([$emp_no]);
        $departments = $dStmt->fetchAll();

        // Histórico salarial
        $sStmt = $pdo->prepare("SELECT * FROM salaries WHERE emp_no = ? ORDER BY from_date DESC");
        $sStmt->execute([$emp_no]);
        $salaries = $sStmt->fetchAll();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 7 - Consulta de Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <a href="index.php" class="btn btn-outline-secondary mb-3">&larr; Volver al Menú</a>
    <h2>Expediente Detallado de Empleado</h2>
    
    <form method="GET" class="row g-2 my-3">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Buscar por Número de Empleado (ej. 10001) o Nombre" value="<?=$search?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <?php if($emp): ?>
        <div class="card mb-4 bg-light">
            <div class="card-body">
                <h4><?=$emp['first_name']?> <?=$emp['last_name']?> <span class="badge bg-secondary">ID: <?=$emp['emp_no']?></span></h4>
                <p class="mb-1"><strong>Género:</strong> <?=$emp['gender'] === 'M' ? 'Masculino' : 'Femenino'?></p>
                <p class="mb-1"><strong>Fecha de Nacimiento:</strong> <?=$emp['birth_date']?></p>
                <p class="mb-0"><strong>Fecha de Contratación:</strong> <?=$emp['hire_date']?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h5>Historial de Puestos</h5>
                <ul class="list-group">
                    <?php foreach($titles as $t): ?>
                        <li class="list-group-item">
                            <strong><?=$t['title']?></strong><br>
                            <small class="text-muted"><?=$t['from_date']?> al <?=$t['to_date']?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Departamentos</h5>
                <ul class="list-group">
                    <?php foreach($departments as $d): ?>
                        <li class="list-group-item">
                            <strong><?=$d['dept_name']?></strong><br>
                            <small class="text-muted"><?=$d['from_date']?> al <?=$d['to_date']?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Evolución Salarial</h5>
                <ul class="list-group" style="max-height: 300px; overflow-y: auto;">
                    <?php foreach($salaries as $s): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>$<?=number_format($s['salary'])?></span>
                            <small class="text-muted"><?=$s['from_date']?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php elseif($search !== ''): ?>
        <div class="alert alert-warning">No se encontró ningún empleado con ese criterio.</div>
    <?php endif; ?>
</body>
</html>