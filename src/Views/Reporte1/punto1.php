<div id="rep-1" class="view-panel active-view">
    <header><h2>Evolución de Contrataciones por Año y Género</h2></header>
 
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-list-ol"></i> Registros Históricos</h3>
            <div style="max-height: 500px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Año de Contratación</th>
                            <th>Género</th>
                            <th>Total de Contratados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_1 as $row): ?>
                        <tr>
                            <td><strong><?=$row['anio_contratacion']?></strong></td>
                            <td>
                                <?php if($row['gender'] === 'M'): ?>
                                    <span style="color: #2563eb;"><i class="fas fa-mars"></i> Masculino</span>
                                <?php else: ?>
                                    <span style="color: #db2777;"><i class="fas fa-venus"></i> Femenino</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: 600; color: #0f172a;"><?=number_format($row['total_contratados'])?> emp.</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="padding: 20px; min-height: 500px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-bar"></i> Comparativa de Contratación Anual</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <canvas id="contratacionesChart" style="max-height: 440px;"></canvas>
            </div>
        </div>

    </div>
</div>