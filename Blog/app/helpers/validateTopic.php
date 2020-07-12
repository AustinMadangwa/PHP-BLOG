<?php
  function validateTopic($topic)
  {
    $errors = array();
    if(empty($topic['name'])){
      array_push($errors,'Topic name is required!');
    }

    $existingTopicName = selectOne('topics',['name'=> $topic['name']]);
    if ($existingTopicName) {
      if(isset($topic['update-topic']) && $existingTopicName['id'] != $topic['id']) {
        array_push($errors, 'Topic name already exists!');
      }
      if(isset($topic['add-topic'])) {
        array_push($errors, 'Topic name already exists!');
      }
    }
    return $errors;
  }
 ?>
