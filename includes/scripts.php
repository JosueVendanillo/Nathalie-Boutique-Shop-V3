<script>

// Get the login modal and the login button
var modal = document.getElementById("loginModal");
var loginBtn = document.getElementById("loginBtn");

// Get the close button for the modal and close the modal when clicked
var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// Show the login modal when the login button is clicked
loginBtn.onclick = function() {
  modal.style.display = "block";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>






