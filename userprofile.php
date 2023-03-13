<?php 
 
 include 'useractive.php';

$password_hash = '';

$id = $userid;

 if (isset($_POST['update'])) {
//    echo '<script>alert(\'test\')</script>';
 
    // Sanitize user input
     $username = mysqli_real_escape_string($conn,$_POST['registerUsername']);
     $password = mysqli_real_escape_string($conn,$_POST['registerPassword']);
     $firstname = mysqli_real_escape_string($conn,$_POST['registerFirstName']);
     $lastname = mysqli_real_escape_string($conn,$_POST['registerLastName']);
     $email = mysqli_real_escape_string($conn,$_POST['registerEmail']);
     $address = mysqli_real_escape_string($conn,$_POST['registerAddress']);
 
 

    //  $password_hash = password_hash($_POST['registerPassword'],PASSWORD_DEFAULT);

     // UPDATE into Database
     $stmt = mysqli_prepare($conn, "UPDATE user_accounts SET user_name=?, user_password=?, first_name=?, last_name=?, user_email=?, user_address=? WHERE user_id= ?");
     mysqli_stmt_bind_param($stmt, 'ssssssi', $username, $password, $firstname, $lastname, $email, $address, $id);
     $result = mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
 
     if ($result) {
         header("Location: userprofile.php?msg=User Profile updated successfully");
     } else {
         throw new Exception(mysqli_error($conn));
     }
 }



 
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>


     <!-- Font Awesome -->
		<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
		rel="stylesheet"
		/>
		<!-- Google Fonts -->
		<link
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
		rel="stylesheet"
		/>
		<!-- MDB -->
		<link
		href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
		rel="stylesheet"
		/>


      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		
		
    <!-- Landingpage css -->
    <link rel="stylesheet" href="./assets/css/landingpage.css">

     <!-- Landingpage css -->
     <link rel="stylesheet" href="./assets/css/userprofile.css">
</head>

<style>

body{
    margin: 0;
    padding: 0;
    overflow: hidden;
  
  }
    
/* dropdown navbar a link - user session*/
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
	border-radius: 0px 0px 15px 15px;
    display: none;
    position: absolute;
    z-index: 1;
    background-color: #ad1845;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 0; /* remove left and right padding */
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    color: white;
    display: block;
    padding: 8px 16px;
    text-decoration: none;
    white-space: nowrap; /* prevent line breaks */
    text-align: center;
}

.dropdown-content a:hover {
    background-color: whitesmoke;
    color: black;
}





</style>




<body>







<header class="">
    <div class="navbar px-5">
        <div class="logo">
            <a href="index-with-session.php"><img src="./assets/img/products/logo.jpg" width="180px"> </a>
        </div>

        <nav >
            <ul>
                <li><a href="index-with-session.php" style="background: #ad1845; color:white;">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li class="dropdown">
                  <?php if(!isset($_SESSION['username'])) : ?>
                    <a  style="color:#ad1845" >
                      <a href="login-form.php">Login</a>
                    </a>
                  <?php else: ?>
                    <a  style="color:#ad1845; " onMouseOver="this.style.color='white'" onMouseOut="this.style.color='#ad1845'">
                      <span onMouseOver="this.style.color='white'" onMouseOut="this.style.color='#ad1845'">
                        Welcome, <?php echo $_SESSION['username']; ?>
                      </span>
                    </a>
                  <?php endif; ?>

                  <div class="dropdown-content">
                    <?php
                      if(isset($_SESSION['username'])) {
                        echo '<a href="userprofile.php">Profile</a>';
                        echo '<a href="logout.php">Logout</a>';
                      } 
                    ?>
                  </div>
                </li>
            </ul>
        </nav>
        <a href="user-cart.php"><img src="./assets/img/products/cart.png" width="30px" height="30px"></a>
    </div>
</header> 

<?php
        
        $update_query = "SELECT * FROM user_accounts WHERE user_id=$id LIMIT 1";
        $result_update_query = mysqli_query($conn,$update_query);
        $row=mysqli_fetch_assoc($result_update_query);

?>

<div class="d-flex flex-row h-100 bg-light" style="margin:3% 25% 6% 25%">

<div style="
position: absolute;
left:0;
right: 0;
margin-top:2%;
margin-left: 40%;
margin-right: 0; 
width: 25%;">
            <!-- Alert for sign up-->
<?php
                if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    $countdown = 5; // Countdown time in seconds

                    

                    if($msg === 'User Profile updated successfully'){

                        echo '
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                              window.location.href=\'http://localhost:8080/nathalie%20shop%20V3/userprofile.php\';
                            }
                            
                            document.querySelector(\'.btn-close\').addEventListener("click", function() {
                              clearInterval(intervalId);
                              removeAlert();
                            });
                          </script>
                        ';
                    } 
                }
        ?>

        </div>


        <?php
        $name =  $row['user_name'];
        $_SESSION['username'] =$name; //store the username to session username

        $hashed_password = $row['user_password']; // get the hashed password from db
        // password_verify($password_hash, $hashed_password) 
        //password_hash is from input

        
        // $_SESSION['password']=$new_password;


          $address = $row['user_address'] ;
          $_SESSION['address'] =   $address;

        ?>


<div class="container">
        <div class="form-wrapper">
            <h1>User Profile</h1>

            <div class="avatar-wrapper">
                <img src="./assets/img/avatar/avatar-admin.jpg" alt="Avatar">
            </div>
            <form method="post" action="">
            
                <strong>Userid: </strong>
                <input type="number" value="<?= $userid?>" disabled style="width: 60px;">
                <input type="text" name="registerFirstName" placeholder="Firstname" value="<?= $row['first_name']?>">
                <input type="text" name="registerLastName" placeholder="Lastname" value="<?= $row['last_name']?>">
                <!-- username cannot be changed because it's from session and also changing it is probihited -->
                <input type="text" name="registerUsername" placeholder="Username" value="<?=$name?>"> 
                <input type="email" name="registerEmail" placeholder="Email" value="<?= $row['user_email']?>">


                <input type="password" name="registerPassword" placeholder="Password" value="<?= $row['user_password'] ?>">

                <textarea name="registerAddress" placeholder="Address" style="resize:none;"><?=  $address?></textarea>
            <div class="button-wrapper">
                <button type="submit" name="update">Save</button>
                <button type="button" id="returnPage">Cancel</button>
              </div>
        </div>
        
        
    </form>
</div>

</div>
<script>

 var returnBtn = document.getElementById('returnPage');
 
 returnBtn.addEventListener('click', () => {
  if(confirm('Do you want to proceed?')){

      window.location.href = "http://localhost:8080/nathalie%20shop%20v3/index-with-session.php";
      }else{
      return false;
      }

 });

</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>