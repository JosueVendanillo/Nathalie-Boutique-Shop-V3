<?php 

include '../admin/admin_session.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  </head>

<style> 

body{
  margin: 0;
  padding: 0;
  height: 100vh;
  overflow: hidden;
 
}

.container-fluid, .row, .sidebar {
  height: 100%;
  overflow: hidden;
}

.nav-link.active {
  background-color: #f5f5f5;
  color: #fff;
}

.nav-link:hover {
  background-color: #f5f5f5;
  color: #000;
}

ul{
  color: #fff;
}
.user-p{
  text-align: center;
  /* padding-left: 10px;
  padding-top: 25px; */
  padding : 25px 10px 10px 10px;
}

.user-p img{
  width: 200px;
  border-radius: 50%;

}

.user-p h4{
  padding: 15px;

}


.sidebar {
  height: auto; /* Set the sidebar height to full screen height */
 
 
  z-index: 1; /*Set the z-index to make sure the sidebar is on top of other elements */
  top: 0; /* Set the position of the sidebar to the top */
  left: 0; /* Set the position of the sidebar to the left */
  background-color: #f1f1f1; /* Set the background color of the sidebar */
  overflow-y: hidden; /* Hide the horizontal scrollbar */
  padding-top: 20px; /* Add some padding to the top */
}

.sidebar a {
  display: block; /* Display the links as block elements */
  color: black; /* Set the link color */
  padding: 16px; /* Add some padding to the links */
  text-decoration: none; /* Remove the underline from the links */
}

.sidebar a:hover {
  background-color: #ddd; /* Add a background color to the links when hovered */
}



</style>


<body style="z-index:1;">

<nav class="navbar navbar-expand-lg navbar-light bg-info bg-gradient fixed-top sticky-top">
   
  <div class="mx-auto d-block py-3">
    <a class="navbar-brand text-center text-black justify-content-center" href="../admin/dashboard.php">Admin Dashboard - Nathalie's Boutique Inventory</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
   
</nav>

  <div class="container-fluid " >
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-secondary sidebar pt-4">
        <div class="sidebar-sticky">
        <div class="user-p">
              <img src="../assets/img/avatar/avatar-admin.jpg">
              <h4> Welcome <?= $admin ?> </h4>
        </div>
        <div class="sidebar">
          <a href="../admin/dashboard.php">Dashboard</a>
          <a href="inventory.php">Inventory</a>
          <a href="#">Reports (available Soon)</a>
          <a href="logout.php">Logout</a>
        </div>


        </div>
      </nav>
 