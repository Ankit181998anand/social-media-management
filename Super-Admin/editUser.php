<?php
// Start output buffering
ob_start();
include 'header.php';
include 'sidebar.php';

// Check if the ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = :role");
    $stmt->execute(['id' => $id, 'role' => 'Admin']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update user logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];

    // Update the user in the database
    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, contact_no = :contact_no WHERE id = :id");
    $stmt->execute(['name' => $name, 'email' => $email, 'contact_no' => $contact_no, 'id' => $id]);
    
    // Redirect to view admins page
    header("Location: viewAdmins.php");
    exit(); // Always exit after header redirection
}
?>

<!-- Content Section -->
<main class="col-12 col-lg-9 col-xl-10 content">
    <div class="container mt-5">
        <h1 class="mb-4">Edit Admin User</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact_no" class="form-label">Contact No</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($user['contact_no']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
