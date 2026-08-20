<div id="rep-4" class="view-panel active-view">
    <header>
        <h2>Empleados por Rangos de Edad y Género</h2>
    </header>
    
    <div class="card" style="padding: 15px; margin-bottom: 25px;">
        <form method="GET" action="" class="filter-group" style="margin-bottom: 0;">
            <div class="filter-item">
                <label for="fecha_corte">Fecha de Comparación Cronológica:</label>
                <input type="date" id="fecha_corte" name="fecha_corte" value="<?= htmlspecialchars($fecha_corte) ?>">
            </div>
            <div class="filter-item">
                <button type="submit"><i class="fas fa-calculator"></i> Recalcular Rangos</button>
            </div>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-users-rectangle"></i> Desglose Demográfico</h3>
            <div style="max-height: 450px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Rango de Edad</th>
                            <th>Género</th>
                            <th>Total de Empleados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_4 as $r): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($r['rango_edad']) ?> años</strong></td>
                            <td>
                                <?php if($r['genero'] === 'M'): ?>
                                    <span style="color: #2563eb;"><i class="fas fa-mars"></i> Masculino</span>
                                <?php else: ?>
                                    <span style="color: #db2777;"><i class="fas fa-venus"></i> Femenino</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: 600; color: #0f172a;"><?= number_format($r['total_empleados']) ?> emp.</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="padding: 20px; min-height: 450px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-bar"></i> Pirámide Demográfica Agrupada</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <canvas id="demografiaChart" style="max-height: 400px;"></canvas>
            </div>
        </div>

    </div>
</div>