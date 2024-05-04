<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="/3ambrain/css/style.css">
  <link rel="stylesheet" href="css/styleforgooglesignbtn.css">


  <title>LogIn</title>
</head>

<body>
  <img style="display: flex; flex-direction: column;
            margin-left: auto;
            margin-right: auto;
            margin-top: 23px;
            width: 56px;
            height: auto;" src="imgfile/manprofile.png" alt="">
  <div class="flex-container">


    <div class="flex-child green">
      <div class="main-section mt-2">
        <h1 class="text-center mb-4" style="font-weight: bold;">𝓤𝓵𝓾𝓶𝓲𝓷𝓪𝓽𝓲</h1>
        <p class="text-center ">Log in to your acount</p>
        <div class="card">
          <p class="text-center mt-3" style="font-size: 25px; font-weight: bold;">Login</p>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group mt-3">
              <input type="text" class="form-control" placeholder="Username" maxlength="12" name="username" maxlength="12" id="username" aria-describedby="">
            </div>
            <div class="form-group mt-3">
              <input type="password" placeholder="Password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary mt-4" style="border-radius: 20px;"><b>Login</b></button>
          </form>
          <?php if (isset($error)) {
                        echo '<div class="error">' . $error . '</div>';
                    } ?>
        </div>
      </div>
      <p class="text-center mt-3" style="font-size: 15px; font-weight: bold;">Don't have an account? <a href="signup.php">Sign up</a></p>
        <button class="googlebutton btn primery">
          <img style="width: 20px;" src="/3ambrain/loginsystem/imgfile/googleimg.png" alt="">
          Login With Google
        </button>
    </div>
    <div class="flex-child magenta">
      <div class="card-body ">
        <img style="width: 550px;" src="homepageimg.jpg" alt="">
      </div>
    </div>

  </div>





  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>