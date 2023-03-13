<?php
include '../admin/admin_session.php';

if (isset($_POST['login'])) {
    $username = $_POST['inputUsername'];
    $password = $_POST['inputPassword'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE user_name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query returned a row
if ($result->num_rows == 1) {
    // Retrieve the row from the query result
    $row = $result->fetch_assoc();

    // Verify the password
    if ($password == $row['user_password']) {
        // Regenerate the session ID to prevent session fixation attacks
        session_regenerate_id();

        // Set session variables based on user role
        if ($row['user_role'] == 1) {
            echo "<script>alert('success')</script>";
            $_SESSION['user_admin'] = $row['user_name'];
            header("Location: dashboard.php"); 
            // Redirect to the admin dashboard page
            exit();
        } else {
            $error = "Invalid user role";
        }
    } else {
        $error = "Invalid username or password";
    }
} else {
    $error = "Invalid username or password";
}

// Close the connection
$stmt->close();
$conn->close();

// Sanitize and echo the error message
if (isset($error)) {
    $sanitized_error = htmlspecialchars($error);
    echo "<script>alert('$sanitized_error')</script>";
}

}
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   
  </head>

    <style>
        body {
    background-color: #e2e8f0;
}

.card {
    border: none;
    border-radius: 20px;
}

.card-body {
    background-color: #fff;
    border-radius: 20px;
}

.form-check-label {
    font-weight: 500;
}

.btn-primary {
    background-color: #1d3557;
    border-color: #1d3557;
}

.btn-primary:hover {
    background-color: #0b2443;
    border-color: #0b2443;
}

    </style>


  <body>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-body p-5">
                        <h2 class="mb-3 text-center">Admin Login Portal</h2>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Username</label>
                                <input type="text" class="form-control"  id= "inputUsername" name="inputUsername" placeholder="Enter Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Enter password" required>
                            </div>
                            <!-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div> -->
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>