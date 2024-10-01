<?php
// Start output buffering
ob_start();
include 'header.php';
include 'sidebar.php';

// Check if the ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user from the database
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id AND role = :role");
    $stmt->execute(['id' => $id, 'role' => 'Admin']);
    
    // Redirect to view admins page
    header("Location: viewAdmins.php");
    exit(); // Always exit after header redirection
}
?>

<!-- Content Section -->
<main class="col-12 col-lg-9 col-xl-10 content">
    <div class="container mt-5">
        <h1 class="mb-4">Delete Admin User</h1>
        <div class="alert alert-danger">User deleted successfully. Redirecting...</div>
    </div>
</main>

<?php include 'footer.php'; ?>
