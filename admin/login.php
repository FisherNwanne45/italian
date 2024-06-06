<?php
include 'config.php';
session_start();

$error = ''; // Define $error variable to prevent "Undefined variable" warning

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database
    $sql = "SELECT id, username, password FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables and redirect to admin panel
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['admin_id'] = $row['id'];
            header("Location: admin_panel.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
        body {
            padding: 20px;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">Admin Login</h1>
            <form action="login.php" method="post" class="mt-3">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <?php if ($error): ?>
            <p class="text-danger mt-3"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </body>

</html>