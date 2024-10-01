<?php 
    // require_once 'dbcon.php'; // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="register-container col-10 col-sm-8 col-md-6 col-lg-4">
            <h1>Register</h1>
            <p>Create your Acount</p>
            <!-- Form starts here -->
            <form method="POST" action="">
    <!-- Name input with icon -->
    <div class="mb-3 input-group">
        <span class="input-group-text" id="name-icon">
            <i class="fas fa-user"></i>
        </span>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
    </div>
    
    <!-- Email input with icon -->
    <div class="mb-3 input-group">
        <span class="input-group-text" id="email-icon">
            <i class="fas fa-envelope"></i>
        </span>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>
    
    <!-- Contact No input with icon -->
    <div class="mb-3 input-group">
        <span class="input-group-text" id="contact-icon">
            <i class="fas fa-phone"></i>
        </span>
        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact No" required>
    </div>
    
    <!-- Password input with icon -->
    <div class="mb-3 input-group">
        <span class="input-group-text" id="password-icon">
            <i class="fas fa-lock"></i>
        </span>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-success login-btn text-left">Register</button>
  </form>

            <!-- Form ends here -->
        </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php 
// Registration logic
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Validate the form data
    if (empty($name) || empty($email) || empty($contact) || empty($password)) {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Define the role as SuperAdmin
        $role = 'SuperAdmin';

        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO users (name, email, contact_no, role, password) VALUES (:name, :email, :contact_no, :role, :password)");

            // Bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact_no', $contact);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Registration successful! Redirecting...</div>";
                header("refresh:3;url=login.php"); // Redirect to login after 3 seconds
            } else {
                echo "<div class='alert alert-danger'>Error: Could not execute the query.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>
