<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header('location:index.php');
}

$randomcaptcha = substr(uniqid(), 5);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style_register.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="login_process.php" class="sign-in-form" method="POST">
          <h2 class="title">Sign In</h2>
          <div id="error" class="text-danger">
            <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
              <h3 style="color: red;">Invalid Password or Captcha</h3>
            <?php }
            if (isset($_GET['notfound']) && $_GET['notfound'] == 1) { ?>
              <h3 style="color: red;">User Not Found</h3>
            <?php } ?>
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="password" type="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-key" style="color: #ababab;"></i>
            <input type="text" readonly name="captcha" id="captcha" value="<?php echo $randomcaptcha; ?>" style="text-decoration: line-through;" disabled><br>
            <input type="text" readonly name="captcha" id="captcha" value="<?php echo $randomcaptcha; ?>" hidden>
          </div>
          <div class="input-field">
            <i class="fas fa-qrcode" style="color: #a3a3a3;"></i>
            <input type="text" id="confirmcaptcha" name="confirmcaptcha" placeholder="Confirm captcha" required /> <br>
          </div>
          <input type="submit" value="Login" class="btn solid" />
        </form>
        <form action="register_process.php" class="sign-up-form" method="POST">
          <h2 class="title">Sign Up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="namadepan" type="text" placeholder="First Name" required />
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="namabelakang" type="text" placeholder="Last Name" required />
          </div>
          <div class="input-field">
            <i class="fas fa-calendar"></i>
            <input name="tanggallahir" type="date" required />
          </div>
          <div class="input-field gender">
            <i class="fas fa-venus-mars"></i>
            <span class="gender-label" style="color: #acacac;">Gender</span>
            <div class="gender-options">
              <input id="male" name="jeniskelamin" type="radio" value="Laki-Laki" required>
              <label for="male">Male</label>
              <input id="female" name="jeniskelamin" type="radio" value="Perempuan" required>
              <label for="female">Female</label>
            </div>
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="password" id="password" type="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="password2" id="password2" type="password" placeholder="Confirm Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-key"></i>
            <input name="kodereff" type="text" placeholder="Kode Reff" />
          </div>
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Please create your account first before you sign in. Go Register
            now !
          </p>
          <button class="btn transparent" id="sign-up-btn">Sign up</button>
        </div>
        <img src="assets/images/1.png" class="image" alt="" style="margin-right: 100px" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Already register your account ?? Are you sure ?? Go sign in to
            your account now !
          </p>
          <button class="btn transparent" id="sign-in-btn">Sign in</button>
        </div>
        <img src="assets/images/2.png" class="image" alt="" />
      </div>
    </div>
  </div>
  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });
    if (performance.navigation.type === 1) {
      window.location.href = window.location.pathname;
    }
  </script>
  <script src="app.js"></script>
</body>

</html>