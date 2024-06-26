<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<div class="alert absolute md:text-sm text-xs top-28 md:top-20 w-full flex justify-center items-center">
    <?php displayFlashMessages('success'); ?>
    <?php displayFlashMessages('danger'); ?>
</div>
<div class="content-container w-screen h-screen flex justify-center">
    <p class="md:text-white text-white border border-red-700 md:border-transparent absolute md:text-md text-xs p-2 top-8 md:top-12 md:right-16 right-8 md:py-2 md:px-4 md:bg-red-700 rounded-full">
        Halo, <?= $_SESSION['user']['username'] ?>
    </p>
    <div class="graphContainer w-[70%] h-[70%] mt-32 ml-40 border border-red-700 shadow-xl p-4 rounded-2xl">
        <canvas id="myChart"></canvas>
        <?php 
            $productQuantities = [];
            foreach ($details as $detail) {
            $productId = $detail['product_id'];
            $quantity = $detail['quantity'];
            if (isset($productQuantities[$productId])) {
                $productQuantities[$productId] += $quantity;
            } else {
                $productQuantities[$productId] = $quantity;
            }
            }
        ?>
</div>
<script>
    const dataChart = document.querySelectorAll('#data-chart');
    const chartData = [];
    dataChart.forEach(data => {
        chartData.push(JSON.parse(data.getAttribute('data-chart')));
    });
    const labels = chartData.map(data => data.transaction_date);
    const data = chartData.map(data => data.total_revenue);
    const products = <?php echo json_encode($products); ?>;
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: products,
            datasets: [{
                label: 'Jumlah Produk Terjual',
                data: <?php echo json_encode(array_values($productQuantities)); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>