<?php
session_start();
include 'db.php';

// Admin login logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin'] = true;
    } else {
        $error = "❌ Invalid credentials!";
    }
}

// Add notice logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_notice'])) {
    $notice = $_POST['notice'];
    $stmt = $conn->prepare("INSERT INTO notices (notice) VALUES (:notice)");
    $stmt->bindParam(':notice', $notice);
    $stmt->execute();
    $success = "🎉 Notice added successfully!";
}

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    ?>
    <?php include 'includes/header.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow hover-effect">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-user-cog"></i> Admin Login
                        </h2>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-custom w-100 hover-effect">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow hover-effect">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">
                        <i class="fas fa-bullhorn"></i> Add Notice
                    </h2>
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <textarea name="notice" class="form-control" placeholder="Enter notice..." rows="5" required></textarea>
                        </div>
                        <button type="submit" name="add_notice" class="btn btn-custom w-100 hover-effect">
                            <i class="fas fa-check"></i> Add Notice
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="logout.php" class="btn btn-custom hover-effect">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>