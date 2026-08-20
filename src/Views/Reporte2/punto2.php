<div id="rep-2" class="view-panel active-view">
    <header>
        <h2>Salario Promedio por Departamento</h2>
    </header>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
        <strong>Utilidad financiera:</strong> Permite identificar qué departamentos tienen las cargas de compensación media más altas, facilitando la toma de decisiones críticas sobre presupuestos anuales y equidad salarial.
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-wallet"></i> Análisis de Compensación</h3>
            <div style="max-height: 450px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Salario Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_2 as $r): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($r['departamento']) ?></strong></td>
                            <td style="font-weight: 600; color: #16a34a;">$<?= number_format($r['salario_promedio'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="padding: 20px; min-height: 450px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-bar"></i> Comparativa del Gasto Medio</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <canvas id="salariosChart" style="max-height: 400px;"></canvas>
            </div>
        </div>

    </div>
</div>