<?php include("../../path.php"); ?>
<?php
  include(ROOT_PATH. "/app/helpers/middleware.php");
  include(ROOT_PATH. "/app/controllers/topics.php");
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
    <title>Admin Section - Manage Topics</title>
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
          <a href="create.php"class="btn btn-big">Add Topic</a>
          <a href="index.php"class="btn btn-big">Manage Topic</a>
        </div>

        <div class="content">
          <h2 class="page-title">Manage Topics</h2>
          <?php include(ROOT_PATH . "/app/includes/messages.php") ?>
          <table>
            <thead>
              <th>SN</th>
              <th>Name</th>
              <th colspan="2">Action</th>
            </thead>
            <tbody>
              <?php foreach ($topics as $key => $topic): ?>
                <tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><?php echo $topic['name'] ?></td>
                  <td><a href="edit.php?id=<?php echo $topic['id']; ?>"class="edit">edit</a></td>
                  <td><a href="index.php?del_id=<?php echo $topic['id']; ?>"class="delete">delete</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End of Admin Content -->
    </div>
    <!-- End of Admin Page Wrapper -->


    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <!-- Custom Script -->
    <script type="text/javascript" src="../../assets/js/scripts.js"></script>
  </body>
</html>
