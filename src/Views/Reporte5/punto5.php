<div id="rep-5" class="view-panel active-view">
    <header><h2>Top 10 Empleados con Mayor Incremento Salarial</h2></header>
 
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-list-ol"></i> Escalafón de Incrementos</h3>
            <div style="max-height: 500px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Salario Mín</th>
                            <th>Salario Máx</th>
                            <th>Años</th>
                            <th style="width: 200px;">% Incremento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_5 as $row): ?>
                        <tr>
                            <td><strong><?=$row['emp_no']?></strong> - <?=htmlspecialchars($row['empleado'])?></td>
                            <td>$<?=number_format($row['salario_minimo'], 2)?></td>
                            <td>$<?=number_format($row['salario_maximo'], 2)?></td>
                            <td><?=$row['anios_carrera']?> años</td>
                            <td>
                                <span style="display: block; font-size: 0.85rem; font-weight: bold; color: #10b981; margin-bottom: 4px;">
                                    <?=$row['pct_incremento']?>%
                                </span>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: <?=min($row['pct_incremento'], 100)?>%;"></div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="padding: 20px; min-height: 500px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-line"></i> Dispersión: Años vs % Incremento</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <canvas id="scatterChart" style="max-height: 440px;"></canvas>
            </div>
        </div>

    </div>
</div>