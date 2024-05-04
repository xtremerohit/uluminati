<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
    exit();
}

require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password_hash, name, email) VALUES ('$username', '$password', '$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <?php if(isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
