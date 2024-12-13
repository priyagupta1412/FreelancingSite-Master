<?php
// Include the database connection and functions file
include "DB.php";
include "functions.php";

// Initialize variables
$error = '';
if (isset($_POST['login'])) {
    // Retrieve and sanitize inputs
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Check if email exists in the database
    $query = "SELECT * FROM regestration WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);
        $db_password = $user['user_password'];
        $user_role = $user['user_role'];
        $admin_status = $user['Admin_Status'];

        // Verify the password
        if (hash_equals($db_password, crypt($password, $db_password))) {
            // Check if the admin is approved (if user is Admin)
            if ($user_role === "Admin" && $admin_status !== "Approved") {
                $error = "Your Admin account is not yet approved.";
            } else {
                // Start a session and set user details
                session_start();
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_role'] = $user['user_role'];

                // Redirect based on user role
                if ($user_role === "Client") {
                    header("Location: client_dashboard.php");
                } elseif ($user_role === "Freelancer") {
                    header("Location: freelancer_dashboard.php");
                } else {
                    header("Location: admin_dashboard.php");
                }
                exit;
            }
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h3 class="text-center mb-4"><i class="fas fa-sign-in-alt"></i> Login</h3>
        <p style="color:red; text-align:center;"><?php echo $error; ?></p>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>

</html>
