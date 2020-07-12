<?php include("path.php") ?>
<?php include(ROOT_PATH. "/app/controllers/users.php");
  include(ROOT_PATH. "/app/helpers/middleware.php");
  guestOnly();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <!-- Styling CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Register</title>
  </head>


  <body>
    <!-- Navigation Bar -->
    <?php include(ROOT_PATH . "/app/includes/header.php") ?>
    <!-- LOGIN AND SIGN UP CODE -->
    <div class="auth-content">
      <form action="register.php" method="post">
        <h2 class="form-title">Register</h2>

        <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>

        <div class="">
          <label for="">Username</label>
          <input type="text" name="username" value="<?php echo $username ?>" class="text-input">
        </div>
        <div class="">
          <label for="">Email</label>
          <input type="email" name="email" value="<?php echo $email ?>" class="text-input">
        </div>
        <div class="">
          <label for="">Password</label>
          <input type="password" name="password" value="<?php echo $password ?>" class="text-input">
        </div>
        <div class="">
          <label for="">Password Confirmation</label>
          <input type="password" name="passwordConf" value="<?php echo $passwordConf ?>" class="text-input">
        </div>
        <div class="">
          <button type="submit" name="register-btn" class="btn btn-big long-btn">Register</button>
        </div>
        <p>Or <a href="<?php echo BASE_URL.'/login.php' ?>">Sign In</a></p>
      </form>
    </div>
    <!-- //LOGIN AND SIGN UP CODE -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <!-- Custom javascript -->
    <script type="text/javascript" src="assets/js/scripts.js"></script>
  </body>
</html>
