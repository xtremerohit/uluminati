<!DOCTYPE html>
<html>

<head>
    <title>PHP Card with Buttons</title>
    <style>
        /* CSS for card */
        .card1 {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .button-container {
            margin-top: 20px;
            text-align: center;
        }

        .button-container button {
            margin: 0 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }
    
        .card-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 23px;
            
        }
        /* CSS for card */
        .card2 {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        /* CSS for input textarea */
        .card2 textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: none;
            border-radius: 5px;
            resize: none;
            font-weight: bold;
            font-size: 15px;
        }
        /* CSS for save button */
        .card2 button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<?php include 'top_navbar.php'?>
    <?php
    session_start();

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "uluminati";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect to login page
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Retrieve posts for the logged-in user
    $sql = "SELECT * FROM user_posts WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    // Handle edit and delete actions
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
        if ($_GET['action'] == 'edit' && isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
            // Fetch post data to edit
            $edit_sql = "SELECT post_content FROM user_posts WHERE id = '$post_id'";
            $edit_result = $conn->query($edit_sql);
            if ($edit_result->num_rows == 1) {
                $edit_row = $edit_result->fetch_assoc();
                $edit_post_content = $edit_row['post_content'];
                // Display form to edit post
                
                echo "<div class='card-container'>";
                echo "<div class='card2'>";
                echo "<P>Edit post</P>";          
                echo "<form method='POST' action='edit_post.php'>";
                echo "<input type='hidden' name='post_id' value='$post_id'>";
                echo "<textarea name='post_content' rows='4'>$edit_post_content</textarea><br>";
                echo "<button type='submit' name='save'>Save</button>";
                // echo "<a href='delete_post.php?post_id=$post_id'>Delete</a>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "Post not found";
            }
        }
    }
    ?>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $post_id = $row['id'];
            $post_content = $row['post_content'];
            echo '<div class="card1">
        <p>' . $post_content . '</p>
        <div class="button-container">' .
                "<button onclick=\"location.href='?action=edit&post_id=$post_id'\">Edit</button>" .
                "<button onclick=\"location.href='?action=edit&post_id=$post_id'\">Edit</button>" .
                '</div>
    </div>';
        }
    } else {
        echo "No posts found";
    }
    $conn->close();
    ?>

</body>

</html>