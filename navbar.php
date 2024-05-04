<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bottom Navbar</title>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

.navbar {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #fff;
    display: flex;
    justify-content: space-around;
    align-items: center;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.navbar button {
    border: none;
    background-color: transparent;
    cursor: pointer;
    padding: 15px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.navbar button:hover {
    background-color: #f0f0f0;
}
</style>
</head>
<body>

<div class="navbar">
    <button onclick="location.href='index.php'">Home</button>
    <button onclick="location.href='notification.php'">Trending</button>
    <button onclick="location.href='profile.php'">Profile</button>
</div>
</body>
</html>
