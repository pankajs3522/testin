<?php
session_start();

// Database connection using generic credentials
$servername = "localhost";
$username = "root";
$password = "password";
$database = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Securely get user inputs
    $user = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $pass = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));

    // Query to fetch user
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: welcome.php');
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>