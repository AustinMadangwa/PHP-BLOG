<?php include("path.php") ?>
<?php

  include(ROOT_PATH. "/app/controllers/topics.php");

  $posts = array();
  $post_title = 'Recent Posts';
  $topics = selectAll('topics');

  if (isset($_GET['t_id'])) {
    $posts = getPostsByTopicID($_GET['t_id']);
    $post_title = "You searched for posts under '". $_GET['name']. "'";
  }
  else if (isset($_POST['search-term'])) {
    $post_title = "You searched for '". $_POST['search-term']. "'";
    $posts = searchPosts($_POST['search-term']);
  }
  else {
    $posts = getPublishedPosts();
  }
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
    <title>Miles LifeGuide Blog</title>
  </head>


  <body>
    <!-- Navigation Bar -->
    <?php include(ROOT_PATH . "/app/includes/header.php") ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php") ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">

      <!-- Post Slider -->
      <div class="post-slider">
        <h1 class="slider-title">Trending Posts</h1>
        <i class="fa fa-chevron-left prev"></i>
        <i class="fa fa-chevron-right next"></i>
        <div class="post-wrapper">

          <?php foreach ($posts as $key => $post): ?>
            <div class="post">
                <img src="<?php echo BASE_URL. '/assets/images/'. $post['post_image_name'] ?>" alt="" class="slider-image">
                <div class="post-info">
                  <h4 class="post-slider-all-content"><a href="single.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['post_title'] ?></a></h4>
                  <i class="fa fa-user post-slider-all-content"><?php echo $post['username'] ?></i>
                  &nbsp;
                  <i class="fa fa-calendar post-slider-all-content"><?php echo date('F j, Y',strtotime($post['post_date'])) ?></i>
                </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
      <!-- End of Post Slider -->
      <!-- CONTENT -->
      <div class="content clearfix">
        <!-- Main Content -->
        <div class="main-content">
          <h1 class="recent-post-title"><?php echo $post_title ?></h1>


          <?php foreach ($posts as $key => $post): ?>
            <div class="post clearfix">
              <img src="<?php echo BASE_URL. '/assets/images/'. $post['post_image_name'] ?>" alt="" class="post-image">
              <div class="post-preview">
                <h2><a href="single.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['post_title'] ?></a></h2>
                <i class="fa fa-user"><?php echo $post['username'] ?></i>
                &nbsp;
                <i class="fa fa-calendar"><?php echo date('F j, Y',strtotime($post['post_date'])) ?></i>
                <p class="preview-text">
                  <?php echo html_entity_decode(substr($post['post_content'],0,150).'...'); ?>
                </p>
                <a href="single.php?post_id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
        <!-- //Main Content -->
        <!-- Side Bar -->
        <div class="sidebar">
          <!-- search bar -->
          <div class="section search">
            <h2 class="section-title">Search</h2>
            <form class="" action="index.php" method="post">
              <input type="text" name="search-term" value="" class="text-input" placeholder="Search...">
            </form>
          </div>
          <!-- topic section -->
          <div class="section topics">
            <h2 class="section-title">Topics</h2>
            <ul>
              <?php foreach ($topics as $key => $topic): ?>
                <li><a href="<?php echo BASE_URL."/index.php?t_id=". $topic['id'] . "&name=". $topic['name']; ?>"><?php echo $topic['name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- //Side Bar -->
      </div>
      <!-- //CONTENT -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- WEBSITE FOOTER -->
    <?php include(ROOT_PATH . "/app/includes/footer.php") ?>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <!-- Slick Courosel -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Custom Script -->
    <script type="text/javascript" src="assets/js/scripts.js"></script>
  </body>
</html>
