<div>
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Daily Score',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };
            const myChart = new Chart(
                ctx,
                config
            );
        })
    </script>

</div>
