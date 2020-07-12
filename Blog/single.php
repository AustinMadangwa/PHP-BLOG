<?php include("path.php") ?>
<?php
  // include(ROOT_PATH. "/app/controllers/topics.php");
  include(ROOT_PATH. "/app/helpers/middleware.php");
  include(ROOT_PATH. "/app/controllers/posts.php");
  include(ROOT_PATH. "/app/controllers/comments.php");

  if (isset($_GET['post_id'])) {
    $post = selectOne('posts',['id' => $_GET['post_id']]);
  }

  $posts = selectAll('posts',['post_status' => 1]);
  $comments = getPostComments($_GET['post_id']);
  // Display(commentCount($_GET['post_id']));
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
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/comments.css?v=<?php echo time(); ?>">
    <title><?php echo $post['post_title']; ?> | MilesLifeGuide</title>
  </head>

  <body>
    <!-- FaceBook Page Plugin javascript SDK -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0"></script>
    <!-- Navigation Bar -->
    <?php include(ROOT_PATH . "/app/includes/header.php") ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
      <!-- CONTENT -->
      <div class="content clearfix">
        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
          <!-- Main Content -->
          <div class="main-content single">
            <h1 class="post-title"><?php echo $post['post_title'] ?></h1>
            <img class="post-image" src="<?php echo BASE_URL."/assets/images/". $post['post_image_name']; ?>" alt="No Post Image">
            <div class="post-content">
              <?php echo html_entity_decode($post['post_content']); ?>
            </div>
            <!-- THE COMMENT SECTION -->
            <?php if ($post['comment_status']): ?>
              <div id="respond">
                  <?php if (!empty($_SESSION['id'])): ?>
                    <h3>Leave a Comment</h3>
                    <form action="single.php" method="post" >
                      <label for="comment" class="required">Your Comment</label>
                      <textarea name="comment_content" rows="10" tabindex="4"   required="required"></textarea>
                      <input type="hidden" name="comment_author" value="<?php echo $_SESSION['id']; ?>" />
                      <input type="hidden" name="comment_post_ID" value="<?php echo $_GET['post_id']; ?>">
                      <input type="hidden" name="comment_author_email" value="<?php echo $_SESSION['email']; ?>">
                      <div class="buttons-right">
                          <input name="add-comment" type="submit" value="Submit Comment" class="btn btn-big contact-btn" />
                      </div>
                    </form>
                  <?php endif; ?>
                  <h2>Comments</h2>
                  <?php if (!empty($_SESSION['admin'])): ?>
                    <?php foreach ($comments as $key => $comment): ?>
                      <div class="clearfix comment-whole">
                        <a href="#"><h4 class="comment-name"><?php echo $comment['username']; ?></h4></a>
                        <div class="comment-content">
                          <p class="comment_con">
                            <?php echo $comment['comment_content']; ?>
                          </p>
                        </div>
                        <div class="comment-change">
                          <a href="single.php?post_id=<?php echo  $post['id'];?>&delete-comment-id=<?php echo $comment['id']; ?>">delete</a>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <?php foreach ($comments as $key => $comment): ?>
                      <div class="clearfix comment-whole">
                        <!-- <img src="assets/images/ellens.jpg" alt="Avatar" class="avatar"> -->
                        <a href="#"><h4 class="comment-name"><?php echo $comment['username']; ?></h4></a>
                        <p class="comment_con">
                          <?php echo $comment['comment_content']; ?>
                        </p>
                      </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </div>
            <?php endif; ?>
          </div>
          <!-- //Main Content -->
        </div>

        <!-- Side Bar -->
        <div class="sidebar single">
          <div class="fb-page" data-href="https://www.facebook.com/Scholarships-103161318063710/?modal=admin_todo_tour" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/Scholarships-103161318063710/?modal=admin_todo_tour" class="fb-xfbml-parse-ignore">
              <a href="https://www.facebook.com/Scholarships-103161318063710/?modal=admin_todo_tour">Scholarships</a>
            </blockquote>
          </div>
          <div class="section popular">
            <h2 class="section-title">Popular</h2>
            <?php foreach ($posts as $key => $p): ?>
              <div class="post clearfix">
                <img src="<?php echo BASE_URL. '/assets/images/'. $p['post_image_name'] ?>" alt="">
                <a href="single.php?post_id=<?php echo $p['id']; ?>"><h4><?php echo $p['post_title'] ?></h4></a>
              </div>
            <?php endforeach; ?>

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
