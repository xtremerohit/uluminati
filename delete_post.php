<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "uluminati";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['post_id'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_GET['post_id'];

    // Delete post
    $sql = "DELETE FROM user_posts WHERE id='$post_id' AND user_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php"); // Redirect to profile page
        exit();
    } else {
        echo "Error deleting post: " . $conn->error;
    }
}

$conn->close();
?>
