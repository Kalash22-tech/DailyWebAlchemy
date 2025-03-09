<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM notices ORDER BY uploaded_time DESC LIMIT 5");
$notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">
                <i class="fas fa-tachometer-alt"></i> Welcome, <?php echo $_SESSION['student_name']; ?>
            </h2>
            <div class="card shadow hover-effect">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">
                        <i class="fas fa-bullhorn"></i> Latest Notices
                    </h3>
                    <div class="notice-board">
                        <marquee direction="up" scrollamount="2">
                            <?php foreach ($notices as $notice): ?>
                                <div class="notice-card mb-3">
                                    <p><?php echo $notice['notice']; ?></p>
                                    <small class="text-muted"><?php echo $notice['uploaded_time']; ?></small>
                                </div>
                            <?php endforeach; ?>
                        </marquee>
                    </div>
                    <div class="text-center mt-4">
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