<?php include("../../path.php"); ?>
<?php
  include(ROOT_PATH. "/app/helpers/middleware.php");
  include(ROOT_PATH. "/app/controllers/posts.php");
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
    <title>Admin Section - Edit Posts</title>
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
          <a href="create.php"class="btn btn-big">Add Post</a>
          <a href="index.php"class="btn btn-big">Manage Post</a>
        </div>

        <div class="content">
          <h2 class="page-title">Edit Post</h2>
          <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>
          <form class="" action="edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="">
              <label for="">Title</label>
              <input type="text" name="post_title" value="<?php echo $post_title; ?>" class="text-input">
            </div>
            <div class="">
              <label for="">Body</label>
              <textarea name="post_content" id="body"><?php echo $post_content; ?></textarea>
            </div>
            <div class="">
              <label for="">Image</label>
              <input type="file" name="post_image_name" value="" class="text-input">
            </div>
            <div class="">
              <label for="">Topic</label>
              <select class="text-input" name="topic_id">
                <option value=""></option>
                <?php foreach ($topics as $key => $topic): ?>
                  <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                      <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                  <?php else: ?>
                      <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="">
              <?php if (empty($post_status) && $post_status == 0): ?>
                <label for="">
                  <input type="checkbox" name="post_status" value="">
                  Publish Post
                </label>
              <?php else: ?>
                <label for="">
                  <input type="checkbox" name="post_status" checked value="">
                  Publish Post
                </label>
              <?php endif; ?>
            </div>
            <div class="">
              <?php if (empty($comment_status) && $comment_status == 0): ?>
                <label for="">
                  <input type="checkbox" name="comment_status" value="">
                  Allow Comments
                </label>
              <?php else: ?>
                <label for="">
                  <input type="checkbox" name="comment_status" checked value="">
                  Allow Comments
                </label>
              <?php endif; ?>
            </div>
            <div class="">
              <button type="submit" name="update-post" class="btn btn-big">Update Post</button>
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
