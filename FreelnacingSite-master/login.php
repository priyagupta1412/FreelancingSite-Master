<?php
// Start the session
session_start();

// Include the database connection file
include "DB.php";
include "functions.php";

$error = "";

if (isset($_POST['login'])) {
    // Sanitize and trim input fields
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Protect against SQL injection
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    
    // Query to find the user by email
    $query = "SELECT * FROM regestration WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
    
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
        // Verify the password
        $stored_password = $user['user_password'];
        $hashFormat = "$2y$10$";
        $salt = "iusesomecrazystrings22";
        $hashF_and_salt = $hashFormat . $salt;
        $encrypted_password = crypt($password, $hashF_and_salt);
        
        if ($stored_password === $encrypted_password) {
            // Set session variables
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['userrole'] = $user['user_role'];
            $_SESSION['email'] = $user['user_email'];
            
            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-4">Login</h2>
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
