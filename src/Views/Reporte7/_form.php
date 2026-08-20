<div id="rep-7" class="view-panel active-view">
    <header><h2>Buscador Histórico de Empleados</h2></header>
    
    <div class="card">
        <!-- action="" vacío hace que el formulario se envíe a la misma página actual (index.php) -->
        <form method="GET" action="" class="filter-group" style="margin-bottom: 0;">
            <div class="filter-item" style="flex-grow: 1;">
                <label for="search">Buscar empleado:</label>
                <input type="text" id="search" name="search" 
                       placeholder="Número de empleado (ej. 10001) o nombre" value="<?=htmlspecialchars($search)?>">
            </div>
            <div class="filter-item">
                <button type="submit"><i class="fas fa-magnifying-glass"></i> Buscar Registro</button>
            </div>
        </form>
    </div>