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


function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();



</script>








