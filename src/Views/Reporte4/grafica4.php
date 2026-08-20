<script>
    (function() {
        const rawData = <?= json_encode($resultados_4) ?>;
        if (!rawData || rawData.length === 0) return;

        const rangosDefinidos = ['<30', '30-39', '40-49', '50-59', '>=60'];

        const hombresData = new Array(rangosDefinidos.length).fill(0);
        const mujeresData = new Array(rangosDefinidos.length).fill(0);

        rawData.forEach(item => {
            const indexRango = rangosDefinidos.indexOf(item.rango_edad);
            if (indexRango !== -1) {
                if (item.genero === 'M') {
                    hombresData[indexRango] = parseInt(item.total_empleados);
                } else if (item.genero === 'F') {
                    mujeresData[indexRango] = parseInt(item.total_empleados);
                }
            }
        });

        const ctx = document.getElementById('demografiaChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: rangosDefinidos.map(r => r + ' años'),
                datasets: [
                    {
                        label: 'Hombres',
                        data: hombresData,
                        backgroundColor: 'rgba(37, 99, 235, 0.75)',
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Mujeres',
                        data: mujeresData,
                        backgroundColor: 'rgba(219, 39, 119, 0.75)',
                        borderColor: 'rgba(219, 39, 119, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { font: { family: "'Segoe UI', sans-serif" } } }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Cantidad de Empleados activos', font: { weight: '600' } },
                        beginAtZero: true
                    }
                }
            }
        });
    })();
</script>