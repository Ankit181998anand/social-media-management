<?php 
    require_once 'dbcon.php'; // Include your database connection file
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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="login-container col-10 col-sm-8 col-md-6 col-lg-4">
            <h1>REGISTRATION PAGE</h1>
            <!-- Form starts here -->
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact No" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary login-btn">Register</button>
            </form>
            <!-- Form ends here -->
        </div>
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
