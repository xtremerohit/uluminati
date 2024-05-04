<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "twitter_clone";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT post_content, created_at FROM user_posts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .card {
            width: auto;
            background-color: #fff;
            border-radius: 23px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
        }

        .profile-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            float: left;
        }

        .post-content {
            margin-bottom: 10px;
        }

        .post-time {
            color: #888;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <h2>User Posts</h2>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">
                    <img src="imgfile/manprofile.png" alt="Profile Photo" class="profile-photo">
                    <div class="post-content">
                        <p>' . $row["post_content"] .'</p>
                    </div>
                    <div class="post-time"> '. $row["created_at"] . '</div>
                </div>';
            }
        } else {
            echo "<tr><td colspan='2'>No posts found</td></tr>";
        }
        $conn->close();
        ?>
  <hr>
  <?php include 'navbar.php' ?>
</body>

</html>