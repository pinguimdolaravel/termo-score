@once
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    @endpush
@endonce

<div class="bg-white rounded-lg p-2" x-data="{labels : @entangle('labels'), points: @entangle('data')}"
     x-init="
        new Chart( $refs.myChart, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Daily Score',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: points
                    }]
                }
             });
">
    <canvas id="myChart" width="400" height="200" x-ref="myChart"></canvas>

</div>
