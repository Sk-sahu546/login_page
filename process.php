<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if($action == 'register') {
        // Registration process
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate inputs
        if(empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: register.php");
            exit();
        }
        
        if($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: register.php");
            exit();
        }
        
        if(strlen($password) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters long.";
            header("Location: register.php");
            exit();
        }
        
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Username or email already exists.";
            header("Location: register.php");
            exit();
        }
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        $_SESSION['success'] = "Registration successful. You can now login.";
        header("Location: login.php");
        exit();
        
    } elseif($action == 'login') {
        // Login process
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        // Find user by username or email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    }
}

header("Location: index.php");
exit();
?>