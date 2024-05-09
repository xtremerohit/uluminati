<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "uluminati";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $post_content = $_POST['post_content'];

    // Update post content
    $sql = "UPDATE user_posts SET post_content='$post_content' WHERE id='$post_id' AND user_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php"); // Redirect to profile page
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }

    $conn->close();
}
?>
