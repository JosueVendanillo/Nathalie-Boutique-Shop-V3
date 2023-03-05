// Get the update modal and the edit button
var updateModal = document.getElementById("updateModal");
var editBtn = document.getElementById("editBtn");

// Get the close button for the modal and close the modal when clicked
var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
  updateModal.style.display = "none";
}

// Show the login modal when the login button is clicked
editBtn.onclick = function() {
  updateModal.style.display = "block";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
  if (event.target == updateModal) {
    updateModal.style.display = "none";
  }
}