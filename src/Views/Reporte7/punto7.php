<?php if($emp): ?>
        <!-- Tarjeta de Datos Generales del Empleado -->
        <div class="card" style="background: #f8fafc; margin-top: 20px;">
            <h3 style="color: #0f172a; margin-bottom: 15px;">
                <?=htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name'])?> 
                <span class="tech-badge" style="background-color: var(--primary-color); color: white; font-size: 0.9rem;">
                    ID: <?=$emp['emp_no']?>
                </span>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div class="info-group">
                    <label>Género</label>
                    <p><?=$emp['gender'] === 'M' ? 'Masculino' : 'Femenino'?></p>
                </div>
                <div class="info-group">
                    <label>Fecha de Nacimiento</label>
                    <p><?=$emp['birth_date']?></p>
                </div>
                <div class="info-group">
                    <label>Fecha de Contratación</label>
                    <p><?=$emp['hire_date']?></p>
                </div>
            </div>
        </div>

        <!-- Historiales en Columnas / Tablas -->
        <div class="card" style="margin-top: 20px; padding: 20px;">
            <h3 style="margin-bottom: 15px; font-size: 1.1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 5px;">
                Línea de Tiempo Institucional
            </h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                
                <!-- Columna 1: Puestos -->
                <div>
                    <h4 style="font-size: 1rem; color: var(--primary-color); margin-bottom: 10px;"><i class="fas fa-briefcase"></i> Historial de Puestos</h4>
                    <table>
                        <thead>
                            <tr><th>Puesto</th><th>Período</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach($titles as $t): ?>
                            <tr>
                                <td><strong><?=htmlspecialchars($t['title'])?></strong></td>
                                <td style="font-size: 0.85rem; color: var(--text-muted);"><?=$t['from_date']?> / <?=$t['to_date']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Columna 2: Departamentos -->
                <div>
                    <h4 style="font-size: 1rem; color: #16a34a; margin-bottom: 10px;"><i class="fas fa-building"></i> Departamentos</h4>
                    <table>
                        <thead>
                            <tr><th>Departamento</th><th>Período</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach($departments as $d): ?>
                            <tr>
                                <td><strong><?=htmlspecialchars($d['dept_name'])?></strong></td>
                                <td style="font-size: 0.85rem; color: var(--text-muted);"><?=$d['from_date']?> / <?=$d['to_date']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Columna 3: Salarios -->
                <div>
                    <h4 style="font-size: 1rem; color: #d97706; margin-bottom: 10px;"><i class="fas fa-wallet"></i> Evolución Salarial</h4>
                    <div style="max-height: 250px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 4px;">
                        <table>
                            <thead>
                                <tr><th>Monto</th><th>Desde</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach($salaries as $s): ?>
                                <tr>
                                    <td style="font-weight: 600; color: #0f172a;">$<?=number_format($s['salary'], 2)?></td>
                                    <td style="font-size: 0.85rem; color: var(--text-muted);"><?=$s['from_date']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <?php elseif($search !== ''): ?>
        <div class="card" style="background-color: #fef3c7; border-color: #fde68a; color: #b45309; margin-top: 20px; padding: 15px;">
            <i class="fas fa-triangle-exclamation"></i> No se encontró ningún empleado que coincida con el criterio de búsqueda.
        </div>
    <?php endif; ?>
</div> <!-- Cierre de div #rep-7 iniciado en el formulario -->