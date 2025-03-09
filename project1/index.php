<?php
session_start();

// Redirect logged-in students to their dashboard
if (isset($_SESSION['student_id'])) {
    header("Location: student.php");
    exit();
}

// Redirect logged-in admin to the admin panel
if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Admin Icon (Top Right Corner) -->
            <div class="text-end mb-4">
                <a href="admin.php" class="btn btn-custom hover-effect">
                    <i class="fas fa-user-cog"></i> Admin Login
                </a>
            </div>

            <!-- Welcome Message -->
            <h1 class="display-4 mb-4">Welcome to the School Noticeboard</h1>
            <p class="lead mb-4">Stay updated with the latest notices and announcements.</p>

            <!-- Buttons for Register and Login -->
            <div class="d-grid gap-3 d-md-block">
                <a href="register.php" class="btn btn-custom hover-effect me-md-3">
                    <i class="fas fa-user-plus"></i> Register as Student
                </a>
                <a href="login.php" class="btn btn-custom hover-effect">
                    <i class="fas fa-sign-in-alt"></i> Login as Student
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>