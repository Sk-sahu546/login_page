<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Our Website</h1>
            <nav>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </header>
        
        <main>
            <section class="hero">
                <h2>Join our community today!</h2>
                <p>Experience the best services we offer to our members.</p>
                <div class="cta-buttons">
                    <a href="register.php" class="btn">Sign Up</a>
                    <a href="login.php" class="btn btn-outline">Login</a>
                </div>
            </section>
            
            <section class="features">
                <div class="feature">
                    <h3>Easy to Use</h3>
                    <p>Our platform is designed with simplicity in mind.</p>
                </div>
                <div class="feature">
                    <h3>Secure</h3>
                    <p>Your data is protected with advanced security measures.</p>
                </div>
                <div class="feature">
                    <h3>24/7 Support</h3>
                    <p>Our team is always ready to help you.</p>
                </div>
            </section>
        </main>
        
        <footer>
            <p>&copy; 2023 Your Website. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>