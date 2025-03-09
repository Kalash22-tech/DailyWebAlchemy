<?php
session_start();
include 'db.php';

$error = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch student from the database
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($student && password_verify($password, $student['password'])) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        $welcome_message = "🎉 Welcome, " . htmlspecialchars($student['name']) . "!";
    } else {
        $error = "❌ Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - School Noticeboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow hover-effect">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </h2>
                        <?php if (isset($welcome_message)): ?>
                            <div class="alert alert-success">
                                <?php echo $welcome_message; ?>
                            </div>
                        <?php else: ?>
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <button type="submit" class="btn btn-custom w-100 hover-effect">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </form>
                            <div class="text-center mt-4">
                                <p class="mb-0">Don't have an account? <a href="register.php">Register here</a></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>