<?php
  $table = 'comments';
  //Adding a acomment
  if (isset($_POST['add-comment'])) {
    $comment_post_ID = $_POST['comment_post_ID'];
    $comment_c = commentCount($comment_post_ID);
    $comment_count = $comment_c['comment_count'] + 1;
    unset($_POST['add-comment']);
    $_POST['comment_approved'] = 1;
    $c = create($table,$_POST);
    $count = update('posts',$comment_post_ID, ['comment_count'=> $comment_count]);
    header('location: '. BASE_URL .'/single.php?post_id='.$comment_post_ID);
    exit();
  }

//Deleting a comment
  if(isset($_GET['delete-comment-id'])){
    adminOnly();
    $count = delete($table, $_GET['delete-comment-id']);
  }
?>
