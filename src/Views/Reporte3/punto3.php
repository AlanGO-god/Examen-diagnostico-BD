<div id="rep-3" class="view-panel active-view">
    <header>
        <h2>Número de Empleados por Departamento</h2>
    </header>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
        <strong>Utilidad operativa:</strong> Permite dimensionar con precisión el tamaño real de cada departamento, facilitando la planificación estratégica de recursos humanos, asignación de presupuestos de infraestructura y optimización del espacio físico.
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-users"></i> Distribución de la Plantilla</h3>
            <div style="max-height: 450px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Total de Empleados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_3 as $r): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($r['departamento']) ?></strong></td>
                            <td style="font-weight: 600; color: var(--primary-color);"><?= number_format($r['total_empleados']) ?> emp.</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="padding: 20px; min-height: 450px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-pie"></i> Proporcionalidad de Volúmenes</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <canvas id="volumenDeptChart" style="max-height: 400px CONTAINER;"></canvas>
            </div>
        </div>

    </div>
</div>