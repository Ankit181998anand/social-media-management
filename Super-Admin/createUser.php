<?php
// Start output buffering
ob_start();
include 'header.php';
include 'sidebar.php';
?>

<!-- Content Section -->
<main class="col-12 col-lg-9 col-xl-10 content">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4">
            <h1>Create Admin User</h1>
            <form method="POST" action="createUser.php">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" name="contact" placeholder="Contact No" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Create Admin</button>
            </form>
        </div>
    </div>
</main>

<?php
// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($name) || empty($email) || empty($contact) || empty($password)) {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Define the role as Admin
    $role = 'Admin';

    try {
        // Prepare the SQL statement to insert the new admin user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, contact_no, role, password) VALUES (:name, :email, :contact_no, :role, :password)");

        // Bind the parameters to the query
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact_no', $contact);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to admin list or another page
            header("Location: viewAdmins.php"); 
            exit(); // Always exit after header redirection
        } else {
            echo "<div class='alert alert-danger'>Error: Could not execute the query.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<?php include 'footer.php'; ?>
