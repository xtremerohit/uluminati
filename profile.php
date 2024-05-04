<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$sql_posts = "SELECT * FROM user_posts WHERE user_id='$user_id' ORDER BY created_at DESC";
$posts_result = $conn->query($sql_posts);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page with Twitter Thread</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details h2 {
            margin: 5px 0;
        }

        .profile-details p {
            margin: 5px 0;
            color: #666;
        }

        .post-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .post-box textarea {
            width: 100%;
            min-height: 100px;
            border: none;
            border-bottom: 1px solid #ccc;
            resize: none;
            font-size: 16px;
            padding: 10px 0;
            box-sizing: border-box;
            outline: none;
        }

        .post-box textarea:focus {
            border-color: #1da1f2;
        }

        .post-box button {
            background-color: #1da1f2;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            outline: none;
            margin-top: 10px;
        }

        .post-box button:hover {
            background-color: #0c84ca;
        }

        .thread-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .thread-container .thread-content {
            margin-bottom: 20px;
        }

        .thread-container .like-button {
            cursor: pointer;
            font-size: 20px;
            color: #e0245e;
        }

        .thread-container .comment-section {
            display: none;
        }

        .thread-container .comment-button {
            cursor: pointer;
            color: #1da1f2;
            text-decoration: underline;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .profile-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-photo {
                margin-bottom: 10px;
            }

            .profile-details {
                text-align: center;
            }
        }

        /* 2 */
        .container2 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .count-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
            text-align: center;
            margin: 10px;
        }

        .count-box p {
            margin: 5px 0;
            font-size: 24px;
            color: #333;
        }

        .count-box span {
            font-size: 18px;
            color: #666;
        }

        @media screen and (max-width: 600px) {
            .container {
                flex-direction: column;
                align-items: stretch;
            }
        }

        /* card css */
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

        /* profile photo box */
        .card1 {
            width: 300px;
            margin: 12px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 10px;
        }

        .username1 {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .bio {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <!--  -->
        <div class="card1">
            <img class="profile" src="imgfile/manprofile.png" alt="Profile Photo">
            <div class="username1">
                @<?php echo $user['username']; ?>
            </div>
            <div class="bio"></div>
        </div>
        <!--  -->
        <!-- <div class="profile-info">
            <div class="profile-photo">
                <img src="imgfile/manprofile.png" alt="Profile Photo">
            </div>
            <div class="profile-details">
                <h2><?php echo $user['name']; ?></h2>
                <p>@<?php echo $user['username']; ?></p>
                <p>Email: <?php echo $user['email']; ?></p>
            </div>
        </div> -->
        <!--  -->
        <div class="container2">
            <div class="count-box">
                <p>10</p>
                <span>Posts</span>
            </div>
            <div class="count-box">
                <p>500</p>
                <span>Following</span>
            </div>
            <div class="count-box">
                <p>1000</p>
                <span>Likes</span>
            </div>
        </div>
        <!--  -->
        <div class="post-box">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <textarea name="post_content" placeholder="What's on your mind?" rows="4" required></textarea>
                <button type="submit" class="btn btn-primary">Share</button>
            </form>
        </div>
        <!-- <div class="thread-container"> -->
        <h3>Posts</h3>
        <?php while ($post = $posts_result->fetch_assoc()) : ?>
            <div class="post">
                <!--  -->
                <div class="card">
                    <img src="imgfile/manprofile.png" alt="Profile Photo" class="profile-photo">
                    <div class="post-content">
                        <p><?php echo $post['post_content']; ?></p>
                    </div>
                    <div class="post-time"><?php echo $post['created_at']; ?></div>
                </div>
                <!--  -->
            </div>
        <?php endwhile; ?>
        <!-- </div> -->
<hr>
        <?php include 'navbar.php' ?>

</body>

</html>