<?php 


include '../admin/navbar-admin.php';


?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-5">
  

  <div class="container" >
    <h1>
        <span>Products Summary</span>
    </h1>
    <div class="">
       <?php 

       //select products items by category
       
       // Initialize empty arrays for the chart data
                        $category_data = array();
                        $count_data = array();

                        // Execute the query to count items in each category
                        $sql = "SELECT category, COUNT(*) as count FROM products GROUP BY category";
                        $result = $conn->query($sql);

                        // Check if the query was successful
                        if ($result->num_rows > 0) {
                            // Loop through the results and add the category and count to the arrays
                            while($row = $result->fetch_assoc()) {
                                array_push($category_data, $row["category"]);
                                array_push($count_data, (int)$row["count"]);
                            }
                        } else {
                            echo "No results found.";
                        }

                        // Close the database connection
                        $conn->close();

                        // Convert the data arrays to JSON format
                        $category_json = json_encode($category_data);
                        $count_json = json_encode($count_data);

                        // Echo the chart HTML and JavaScript
                        echo '
                        <canvas id="myChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                        var ctx = document.getElementById("myChart").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type: "bar",
                            data: {
                                labels: ' . $category_json . ',
                                datasets: [{
                                    label: "Products current Stocks",
                                    data: ' . $count_json . ',
                                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                                    borderColor: "rgba(255, 99, 132, 1)",
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        });
                        </script>';

       
       ?>
    </div>
  </div>
  

 </main>    
 