<script>
    (function() {

        const chartData = <?= json_encode($resultados_6) ?>;
        
        if (!chartData || chartData.length === 0) return;

        const ctx = document.getElementById('permanenciaChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.map(d => `${d.departamento} - ${d.puesto}`),
                datasets: [{
                    label: 'Meses promedio en el puesto',
                    data: chartData.map(d => d.meses_promedio),
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y', 
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { family: "'Segoe UI', sans-serif", size: 12 }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#e2e8f0' },
                        title: { display: true, text: 'Cantidad de Meses' }
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
        });
    })();
</script>