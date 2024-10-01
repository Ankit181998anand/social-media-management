<!-- header.php -->
<?php
   session_start(); // Start the session

   // Include the database connection file
   require_once '../dbcon.php';
   
   // Check if the user is logged in
   if (!isset($_SESSION['user_id'])) {
       header("Location: ../login.php"); // Redirect to the login page if not logged in
       exit();
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super-Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
