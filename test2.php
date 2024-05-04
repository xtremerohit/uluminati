<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Navbar with Popup Menu</title>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

.navbar {
    width: 100%;
    background-color: #333;
    padding: 10px 0;
    text-align: center;
    color: #fff;
}

.menu-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 20px;
    cursor: pointer;
}

.popup-card {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 150px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    display: none;
}

.option {
    padding: 10px;
    cursor: pointer;
}

.option:hover {
    background-color: #f0f0f0;
}
</style>
</head>
<body>

<div class="navbar">
    <span>Website Name</span>
</div>

<button class="menu-button" onclick="togglePopup()">☰</button>

<div class="popup-card" id="popupCard">
    <div class="option">Option 1</div>
    <div class="option">Option 2</div>
    <div class="option">Option 3</div>
    <div class="option">Option 4</div>
</div>

<script>
function togglePopup() {
    var popup = document.getElementById("popupCard");
    if (popup.style.display === "none") {
        popup.style.display = "block";
    } else {
        popup.style.display = "none";
    }
}
</script>

</body>
</html>
