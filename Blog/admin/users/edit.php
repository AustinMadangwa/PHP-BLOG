<?php include("../../path.php"); ?>
<?php
  include(ROOT_PATH. "/app/helpers/middleware.php");
  include(ROOT_PATH. "/app/controllers/users.php");
  adminOnly();
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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Admin Styling CSS -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Admin Section - Edit Users</title>
  </head>


  <body>
    <!-- Navigation Bar -->
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

    <!--Admin Page Wrapper -->
    <div class="admin-wrapper">
      <!-- Left SideBar -->
      <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
      <!-- End of Left SideBar -->
      <!-- Admin Content -->
      <div class="admin-content">

        <div class="button-group">
          <a href="create.php"class="btn btn-big">Add User</a>
          <a href="index.php"class="btn btn-big">Manage Users</a>
        </div>

        <div class="content">
          <h2 class="page-title">Edit User</h2>
          <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>
          <form class="" action="create.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
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
              <label for="">
                <?php if (isset($admin) && $admin == 1): ?>
                  <input checked type="checkbox" name="admin" value="">
                  Admin
                <?php else: ?>
                  <input type="checkbox" name="admin" value="">
                  Admin
                <?php endif; ?>
              </label>
            </div>
            <div class="">
              <button type="submit" name="update-user" class="btn btn-big">Update User</button>
            </div>
          </form>
        </div>
      </div>
      <!-- End of Admin Content -->
    </div>
    <!-- End of Admin Page Wrapper -->


    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <!-- Ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <!-- Custom Script -->
    <script type="text/javascript" src="../../assets/js/scripts.js"></script>
  </body>
</html>
