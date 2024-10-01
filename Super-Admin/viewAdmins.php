<?php
include 'header.php';
include 'sidebar.php';

// Fetch all users with the Admin role
$stmt = $pdo->prepare("SELECT * FROM users WHERE role = :role");
$stmt->execute(['role' => 'Admin']);
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Section -->
<main class="col-12 col-lg-9 col-xl-10 content">
    <div class="container mt-5">
        <h1 class="mb-4">Admin Users</h1>

        <?php if (count($admins) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serial_no = 1; // Initialize serial number
                    foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo $serial_no++; ?></td> <!-- Serial number -->
                            <td><?php echo htmlspecialchars($admin['name']); ?></td>
                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                            <td><?php echo htmlspecialchars($admin['contact_no']); ?></td>
                            <td>
                                <!-- Actions like Edit or Delete can be added here -->
                                <a href="editUser.php?id=<?php echo $admin['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="deleteUser.php?id=<?php echo $admin['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No Admin users found.</div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
