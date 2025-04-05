<?php 
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<?php
$stmt = $pdo->query("SELECT id, username, email, created_at FROM users");
$users = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header style="margin-right: 20px;">
            <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
            <nav style="margin-right: 20px;">
                <a href="index.php">Home</a>
                <a href="logout.php">Logout</a>
            </nav>
        </header>
        
        <main>
            <section class="dashboard">
                <div class="profile-card">
                    <h2>Your Profile</h2>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Member since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                </div>
                
                <div class="dashboard-actions">
                    <h2>Quick Actions</h2>
                    <div class="action-buttons">
                        <a href="#" class="btn">Edit Profile</a>
                        <a href="#" class="btn">Change Password</a>
                        <a href="#" class="btn">View Notifications</a>
                    </div>
                </div>
            </section>
        </main>
        
        <footer>
            <p>&copy; 2023 Your Website. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>