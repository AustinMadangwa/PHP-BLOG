<?php

  include(ROOT_PATH. "/app/database/db.php");
  include(ROOT_PATH. "/app/helpers/validateUser.php");

  $username = '';
  $email = '';
  $id = '';
  $password = '';
  $passwordConf = '';
  $admin = '';
  $errors = array();
  $table = 'users';
  $admin_users = selectAll($table);


  //Loging the user into the system
  function LoginUser($user)
  {
    //sessions to store the user information while logged in
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['message'] = 'You are now logged in!';
    $_SESSION['type'] = 'success';
    if ($_SESSION['admin']) {
      header('location: '. BASE_URL . '/admin/dashboard.php');
    }else {
      header('location: '. BASE_URL . '/index.php');
    }
    exit();
  }

  //Creating a user
  if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){

    $errors = validateUsers($_POST);

    if(count($errors) === 0){
      unset($_POST['register-btn'],$_POST['passwordConf'],$_POST['create-admin']);
      $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

      if (isset($_POST['admin'])) {
        $_POST['admin'] = 1;
        $user_id = create($table,$_POST);
        $_SESSION['message'] = 'Admin user created successfully!';
        $_SESSION['type'] = 'success';
        header('location: '. BASE_URL .'/admin/users/index.php');
        exit();
      }
      else {
        $_POST['admin'] = 0;
        $user_id = create($table,$_POST);
        $user = selectOne($table,['id' => $user_id]);
        //Log the user in
        LoginUser($user);
      }
    }
    else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $admin = isset($_POST['admin'])? 1 : 0 ;
      $password = $_POST['password'];
      $passwordConf = $_POST['passwordConf'];
    }
  }


  //Updating the user
  if (isset($_POST['update-user'])) {
    adminOnly();
    $errors = validateUsers($_POST);

    if(count($errors) === 0){
      $id = $_POST['id'];
      unset($_POST['passwordConf'],$_POST['update-user'],$_POST['id']);
      $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $_POST['admin'] = isset($_POST['admin'])? 1 : 0 ;
      $user_id = update($table,$id,$_POST);
      $_SESSION['message'] = 'Admin user updated successfully!';
      $_SESSION['type'] = 'success';
      header('location: '. BASE_URL .'/admin/users/index.php');
      exit();
    }
    else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $admin = isset($_POST['admin'])? 1 : 0 ;
      $password = $_POST['password'];
      $passwordConf = $_POST['passwordConf'];
    }
  }
  //Updating the user information
  if (isset($_GET['id'])) {
    $user = selectOne($table,['id'=> $_GET['id']]);
    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
    $admin = $user['admin'];
  }

  //Logging in the user
  if(isset($_POST['login-btn'])){
    $errors = validateLogin($_POST);

    if(count($errors) === 0){
      // $user = selectOne($table,['username' => $_POST['username']]);
      $user = loginUserEmailOrPassword($table,['username' => $_POST['username'],'email' => $_POST['username']]);

      if($user && password_verify($_POST['password'],$user['password']) ){
        //Log the user in
        LoginUser($user);
      }
      else {
        array_push($errors, 'Wrong credentials!!');
      }
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
  }

  //Deleting a user from the database
  if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table,$_GET['delete_id']);
    $_SESSION['message'] = 'User deleted successfully!';
    $_SESSION['type'] = 'success';
    header('location: '. BASE_URL .'/admin/users/index.php');
    exit();
  }

 ?>
