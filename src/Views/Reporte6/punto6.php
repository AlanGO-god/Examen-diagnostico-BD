<div id="rep-6" class="view-panel active-view">
    <header>
        <h2>Análisis de Permanencia Media por Puesto y Departamento</h2>
    </header>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
        <strong>Utilidad institucional:</strong> Ayuda al departamento de Recursos Humanos a medir los tiempos de permanencia, velocidad de rotación o promedios de ascenso en puestos clave.
    </p>

    <!-- Grid de dos columnas nativo para alinear Tabla y Gráfico -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px; align-items: start;">
        
        <!-- Bloque Izquierdo: Tabla de Datos -->
        <div class="card" style="padding: 20px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-list-ol"></i> Desglose Estadístico</h3>
            <div style="max-height: 450px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px;">
                <table style="margin-top: 0;">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Meses Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados_6 as $r): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($r['departamento']) ?></strong></td>
                            <td><?= htmlspecialchars($r['puesto']) ?></td>
                            <td style="font-weight: 600; color: var(--primary-color);"><?= $r['meses_promedio'] ?> meses</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bloque Derecho: Contenedor para el Gráfico -->
        <div class="card" style="padding: 20px; min-height: 450px; display: flex; flex-direction: column;">
            <h3 style="font-size: 1.1rem; margin-bottom: 15px; color: #0f172a;"><i class="fas fa-chart-bar"></i> Distribución Visual</h3>
            <div style="flex-grow: 1; position: relative; width: 100%; height: 100%;">
                <!-- Reducimos el ID de barChart a permanenciaChart para evitar colisiones globales -->
                <canvas id="permanenciaChart" style="max-height: 400px;"></canvas>
            </div>
        </div>

    </div>
</div>