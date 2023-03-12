<?php 


include '../admin/navbar-admin.php';


?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-5">
  

  <div class="container" >
    <h1>
        <span>Product Summary</span>
    </h1>
    <div class="">
        <canvas id="inventory-chart"></canvas>
    </div>
  </div>
  

        </main>

        <script>
            var ctx = document.getElementById('inventory-chart').getContext('2d');
            var inventoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
                datasets: [{
                label: 'Inventory',
                data: [10, 20, 5, 30, 15],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                }
            }
            });

        </script>