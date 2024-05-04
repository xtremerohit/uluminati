<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $post_content = $_POST['post_content'];

    $sql = "INSERT INTO user_posts (user_id, post_content) VALUES ('$user_id', '$post_content')";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
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
    <title>New Post</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>New Post</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <textarea name="post_content" placeholder="What's on your mind?" rows="4" required></textarea><br>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
        <?php if(isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>
        <a href="profile.php" class="btn btn-secondary">Cancel</a>
    </div>
</body>
</html>
