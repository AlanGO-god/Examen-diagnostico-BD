<script>
    (function() {
        const rawData = <?= json_encode($resultados_1) ?>;
        
        if (!rawData || rawData.length === 0) return;

        const anosSet = new Set(rawData.map(d => d.anio_contratacion));
        const labelsAnos = Array.from(anosSet).sort((a, b) => a - b);

        const datosMasculino = new Array(labelsAnos.length).fill(0);
        const datosFemenino = new Array(labelsAnos.length).fill(0);

        rawData.forEach(item => {
            const indexAno = labelsAnos.indexOf(item.anio_contratacion);
            if (indexAno !== -1) {
                if (item.gender === 'M') {
                    datosMasculino[indexAno] = parseInt(item.total_contratados);
                } else if (item.gender === 'F') {
                    datosFemenino[indexAno] = parseInt(item.total_contratados);
                }
            }
        });

        const ctx = document.getElementById('contratacionesChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsAnos,
                datasets: [
                    {
                        label: 'Hombres',
                        data: datosMasculino,
                        backgroundColor: 'rgba(37, 99, 235, 0.75)', 
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Mujeres',
                        data: datosFemenino,
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
                    legend: {
                        position: 'top',
                        labels: { font: { family: "'Segoe UI', sans-serif", size: 12 } }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        title: { display: true, text: 'Año Fiscal de Ingreso', font: { weight: '600' } }
                    },
                    y: {
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Cantidad de Contrataciones', font: { weight: '600' } },
                        beginAtZero: true
                    }
                }
            }
        });
    })();
</script>