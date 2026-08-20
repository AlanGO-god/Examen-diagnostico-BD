<script>
    (function() {
        const chartData = <?= json_encode($resultados_3) ?>;
        
        if (!chartData || chartData.length === 0) return;

        const ctx = document.getElementById('volumenDeptChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.map(d => d.departamento),
                datasets: [{
                    label: 'Cantidad de Colaboradores',
                    data: chartData.map(d => d.total_empleados),
                    backgroundColor: 'rgba(79, 70, 229, 0.2)', 
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` Activos: ${Number(context.raw).toLocaleString('en-US')} empleados`;
                            }
                        }
                    },
                    legend: {
                        labels: { font: { family: "'Segoe UI', sans-serif", size: 12 } }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Personal Activo', font: { weight: '600' } },
                        beginAtZero: true
                    }
                }
            }
        });
    })();
</script>