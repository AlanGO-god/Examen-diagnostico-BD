<script>
    (function() {
        const rawData = <?= json_encode($resultados_5) ?>;
        
        if (!rawData || rawData.length === 0) return;

        const ctx = document.getElementById('scatterChart');
        
        new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Empleados Analizados',
                    data: rawData.map(d => ({ x: d.anios_carrera, y: d.pct_incremento, label: d.empleado })),
                    backgroundColor: 'rgba(37, 99, 235, 0.7)', 
                    borderColor: 'rgba(37, 99, 235, 1)',
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const p = context.raw;
                                return `${p.label}: ${p.x} años de carrera, ${p.y}% inc.`;
                            }
                        }
                    },
                    legend: {
                        labels: { font: { family: "'Segoe UI', sans-serif" } }
                    }
                },
                scales: {
                    x: { 
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Años de Carrera', font: { weight: '600' } } 
                    },
                    y: { 
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: '% Incremento Salarial', font: { weight: '600' } } 
                    }
                }
            }
        });
    })();
</script>