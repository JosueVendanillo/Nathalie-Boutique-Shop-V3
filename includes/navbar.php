


<div class="header">
    <!-- container of the modal -->
        <div class="container">
            <!-- modal -->
            <div id="loginModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">

                <?php 
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds
                    
                    echo '
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div id="countdown" style="font-weight: bold;"></div>
                      </div>
                      <script>
                        var countdown = ' . $countdown . ';
                        var countdownElem = document.getElementById("countdown");
                    
                        var intervalId = setInterval(function() {
                          countdown--;
                          countdownElem.innerHTML = "This alert will disappear in " + countdown + " seconds.";
                    
                          if (countdown == 0) {
                            clearInterval(intervalId);
                            removeAlert();
                          }
                        }, 1000);
                    
                        function removeAlert() {
                          document.querySelector(\'.alert\').remove();
                          window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/inventory.php\';
                        }
                        
                        document.querySelector(\'.btn-close\').addEventListener("click", function() {
                          clearInterval(intervalId);
                          removeAlert();
                        });
                      </script>
                    ';
                }
            ?>

   


                    
        </div>

        
    </div>