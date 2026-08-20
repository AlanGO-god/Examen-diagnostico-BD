<script>
    (function() {
        // Obtenemos los datos procesados desde el controlador
        const chartData = <?= json_encode($resultados_2) ?>;
        
        if (!chartData || chartData.length === 0) return;

        const ctx = document.getElementById('salariosChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                
                labels: chartData.map(d => d.departamento),
                datasets: [{
                    label: 'Salario Promedio ($)',
                    data: chartData.map(d => d.salario_promedio),
                    backgroundColor: 'rgba(22, 163, 74, 0.2)', 
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y', 
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` Promedio: $${Number(context.raw).toLocaleString('en-US', {minimumFractionDigits: 2})}`;
                            }
                        }
                    },
                    legend: {
                        labels: { font: { family: "'Segoe UI', sans-serif", size: 12 } }
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Monto en USD ($)', font: { weight: '600' } },
                        beginAtZero: true
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
        });
    })();
</script>