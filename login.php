<?php
    // Include the database connection
    // require_once 'dbcon.php';
    session_start(); // Start the session

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate input
        if (empty($email) || empty($password)) {
            $error = "Please fill in all fields.";
        } else {
            // Check if the user exists in the database
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // If user exists
            if ($user && password_verify($password, $user['password'])) {
                // Store user info in the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] == 'SuperAdmin') {
                    header("Location: Super-Admin\dashbord.html"); // SuperAdmin dashboard
                    exit();
                } elseif ($user['role'] == 'Admin') {
                    header("Location: Admin\dashbord.html"); // Admin dashboard
                    exit();
                } else {
                    $error = "Invalid role. Please contact the admin.";
                }
            } else {
                $error = "Invalid email or password.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container login-main h-100 d-flex justify-content-center align-items-center">
        <div class="login-container col-10 col-sm-8 col-md-6 col-lg-4">
            <h1>Login</h1>
            <p>Sign in to your account</p>
            <!-- Display error message if any -->
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
    <div class="mb-3 input-group">
        <span class="input-group-text" id="email-icon">
            <i class="fas fa-envelope"></i>
        </span>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3 input-group">
        <span class="input-group-text" id="password-icon">
            <i class="fas fa-lock"></i>
        </span>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary login-btn">Login</button>
</form>

        </div> 
        <div class="image-container col-10 col-sm-8 col-md-6 col-lg-4">
            <div class="social-icons">
                <img src='./assets/images/pngegg (1).png' class='img-fluid'></img>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
