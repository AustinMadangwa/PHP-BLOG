<?php
  function validateUsers($user)
  {
    $errors = array();
    if(empty($user['username'])){
      array_push($errors,'Username is required!');
    }
    if(empty($user['email'])){
      array_push($errors,'Email is required!');
    }
    if(empty($user['password'])){
      array_push($errors,'Password is required!');
    }

    if(empty($user['passwordConf'])){
      array_push($errors,'Confirmation is required!');
    }
    if($user['passwordConf']!== $user['password']){
      array_push($errors,'Password do not match!');
    }

    $existingUserEmail = selectOne('users',['email'=> $user['email']]);
    if ($existingUserEmail) {
      if(isset($user['update-user']) && $existingUserEmail['id'] != $user['id']) {
        array_push($errors, 'Email already exists!');
      }
      if(isset($user['create-admin']) || isset($user['register-btn'])) {
        array_push($errors, 'Email already exists!');
      }
    }

    $existingUserName = selectOne('users',['username'=> $user['username']]);
    if ($existingUserName) {
      if(isset($user['update-user']) && $existingUserName['id'] != $user['id']) {
        array_push($errors, 'Username already exists!');
      }
      if(isset($user['create-admin']) || isset($user['register-btn'])) {
        array_push($errors, 'Username already exists!');
      }
    }
    return $errors;
  }

  function validateLogin($user)
  {
    $errors = array();
    if(empty($user['username'])){
      array_push($errors,'Username is required!');
    }
    if(empty($user['password'])){
      array_push($errors,'Password is required!');
    }
    return $errors;
  }
 ?>
