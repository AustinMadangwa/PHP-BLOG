<?php
  include(ROOT_PATH. "/app/database/db.php");
  include(ROOT_PATH. "/app/helpers/validatePost.php");

  $table = 'posts';
  $errors = array();
  $topics = selectAll('topics');
  $posts = selectAll($table);

  $post_title = '';
  $post_content = '';
  $topic_id = '';
  $post_status = '';
  $comment_status = '';
  $comment_count = '';
  $id = '';
//creating the post
  if (isset($_POST['add-post'])) {
    adminOnly();
    //Validating the post information first
    $errors = validatePosts($_POST);
    if (!empty($_FILES['post_image_name']['name'])) {
      $image_name = time() .'_'. $_FILES['post_image_name']['name'];
      $image_destination = ROOT_PATH . "/assets/images/" . $image_name;

      $result = move_uploaded_file($_FILES['post_image_name']['tmp_name'],$image_destination);
      if ($result) {
        $_POST['post_image_name'] = $image_name;
      } else {
        array_push($errors,'Failed to upload the image!!');
      }
    }
    else {
      array_push($errors,'Post image required!');
    }

    if(count($errors) === 0){
      unset($_POST['add-post']);
      $_POST['post_author'] = $_SESSION['id'];
      $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
      $_POST['comment_status'] = isset($_POST['comment_status']) ? 1 : 0;
      $_POST['comment_count'] = 0;////To be implemented
      $_POST['post_content'] = htmlentities($_POST['post_content']);

      //Creating the post in the database
      $post = create($table,$_POST);
      $_SESSION['message'] = 'Post has been created successfully';
      $_SESSION['type'] = 'success';
      header('location: '. BASE_URL .'/admin/posts/index.php');
      exit();
    }
    else{
      $post_title = $_POST['post_title'];
      $post_content = $_POST['post_content'];
      $topic_id = $_POST['topic_id'];
      $post_status = isset($_POST['post_status']) ? 1 : 0;
      $comment_status = isset($_POST['comment_status']) ? 1 : 0;
    }
  }

  //Getting the post ID for updating
  if (isset($_GET['id'])) {
    $post = selectOne($table,['id'=>$_GET['id']]);
    $id = $post['id'];
    $post_title = $post['post_title'];
    $post_content = $post['post_content'];
    $topic_id = $post['topic_id'];
    $post_status = $post['post_status'];;
    $comment_status = $post['comment_status'];
    $comment_count = $post['comment_count'];
  }

  //Getting the post ID for deleting and delete
  if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'Post has been deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: '. BASE_URL .'/admin/posts/index.php');
    exit();
  }

  //publishing and unpublishing the post
  if (isset($_GET['post_status']) && isset($_GET['p_id'])) {
    adminOnly();
    $post_status = $_GET['post_status'];
    $p_id = $_GET['p_id'];
    //updating the publishing state
    $count = update($table,$p_id, ['post_status'=> $post_status]);
    $_SESSION['message'] = 'Post published state changed';
    $_SESSION['type'] = 'success';
    header('location: '. BASE_URL .'/admin/posts/index.php');
    exit();
  }

  //Updating the post
  if (isset($_POST['update-post'])) {
    adminOnly();
    //Validating the post information first
    $errors = validatePosts($_POST);
    if (!empty($_FILES['post_image_name']['name'])) {
      $image_name = time() .'_'. $_FILES['post_image_name']['name'];
      $image_destination = ROOT_PATH . "/assets/images/" . $image_name;

      $result = move_uploaded_file($_FILES['post_image_name']['tmp_name'],$image_destination);
      if ($result) {
        $_POST['post_image_name'] = $image_name;
      } else {
        array_push($errors,'Failed to upload the image!!');
      }
    }
    else {
      array_push($errors,'Post image required!');
    }
    if(count($errors) === 0){
      $comment_c = commentCount($_POST['id']);
      $comment_count = $comment_c['comment_count'];

      unset($_POST['update-post']);
      $_POST['post_author'] = $_SESSION['id'];
      $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
      $_POST['comment_status'] = isset($_POST['comment_status']) ? 1 : 0;
      $_POST['comment_count'] = $comment_count;
      $_POST['post_content'] = htmlentities($_POST['post_content']);
      $id = $_POST['id'];
      unset($_POST['id']);
      //Creating the post in the database
      $post = update($table,$id,$_POST);
      $_SESSION['message'] = 'Post has been updated successfully';
      $_SESSION['type'] = 'success';
      header('location: '. BASE_URL .'/admin/posts/index.php');
      exit();
    }
    else{
      $post_title = $_POST['post_title'];
      $post_content = $_POST['post_content'];
      $topic_id = $_POST['topic_id'];
      $post_status = isset($_POST['post_status']) ? 1 : 0;
      $comment_status = isset($_POST['comment_status']) ? 1 : 0;
    }
  }
?>
