<?php
  function validatePosts($post)
  {
    $errors = array();
    if(empty($post['post_title'])){
      array_push($errors,'Post title is required!');
    }
    if(empty($post['post_content'])){
      array_push($errors,'Post content is required!');
    }

    // if(empty($post['post_image_name'])){
    //   array_push($errors,'Post image is required!');
    // }

    if(empty($post['topic_id'])){
      array_push($errors,'Please select a topic!');
    }

    $existingPostTitle = selectOne('posts',['post_title'=> $post['post_title']]);
    if ($existingPostTitle) {
      if(isset($post['update-post']) && $existingPostTitle['id'] != $post['id']) {
        array_push($errors, 'A post with that title already exists!');
      }
      if(isset($post['add-post'])) {
        array_push($errors, 'A post with that title already exists!');
      }
    }
    return $errors;
  }
?>
