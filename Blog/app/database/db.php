<?php
    session_start();
    require("connect.php");

    //A function to help bind and execute queries
    function ExecuteQuery($sql, $data)
    {
      global $conn;
      $stmt = $conn->prepare($sql);
      $values = array_values($data);
      $types = str_repeat('s',count($values));
      $stmt->bind_param($types,...$values);
      if ($stmt->execute()) {
        return $stmt;
      } else {
        echo "Error! :". $conn->connect_error;
      }/////////////////////////////////////////// TODO:
    }
    //A function to select a table from the database
    function selectAll($table, $conditions = [])
    {
      global $conn;
      $sql = "SELECT * FROM $table";
      if(empty($conditions)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
      }
      else{
        $i = 0;
        foreach ($conditions as $key => $value) {
          if($i == 0){
              $sql = $sql." WHERE $key = ?";
          }
          else{
              $sql = $sql." AND $key = ?";
          }
          $i++;
        }
        $stmt = ExecuteQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
      }
    }
    //A function to select one row from the database
    function selectOne($table, $conditions)
    {
      global $conn;
      $sql = "SELECT * FROM $table";
      $i = 0;
      foreach ($conditions as $key => $value) {
        if($i == 0){
            $sql = $sql." WHERE $key = ?";
        }
        else{
            $sql = $sql." AND $key = ?";
        }
        $i++;
      }

      $sql = $sql." LIMIT 1";
      $stmt = ExecuteQuery($sql, $conditions);
      $records = $stmt->get_result()->fetch_assoc();
      return $records;
    }

    //A function to insert data from the database
    function create($table,$data)
    {
      global $conn;
      $sql = "INSERT INTO $table SET ";

      $i = 0;
      foreach ($data as $key => $value) {
        if($i == 0){
            $sql = $sql." $key = ?";
        }
        else{
            $sql = $sql.", $key = ?";
        }
        $i++;
      }
      $stmt = ExecuteQuery($sql, $data);
      $id = $stmt->insert_id;
      return $id;
    }

    //A function to update data from the database
    function update($table,$id, $data)
    {
      global $conn;
      $sql = "UPDATE $table SET ";

      $i = 0;
      foreach ($data as $key => $value) {
        if($i == 0){
            $sql = $sql." $key = ?";
        }
        else{
            $sql = $sql.", $key = ?";
        }
        $i++;
      }
      $sql = $sql." WHERE id=?";
      $data['id'] = $id;
      $stmt = ExecuteQuery($sql, $data);
      return $stmt->affected_rows;
    }
    //A function to delete data from the database
    function delete($table,$id)
    {
      global $conn;
      $sql = "DELETE FROM $table WHERE id=?";
      $stmt = ExecuteQuery($sql, ['id'=> $id]);
      return $stmt->affected_rows;
    }

    // A function to display the data
    function Display($value)
    {
      echo "<pre>",print_r($value,true),"<pre>";
      die();
    }

    //A function to query the username who is the author of the post. post/user relationship
    function getPublishedPosts()
    {
      global $conn;
      $sql = "SELECT p.*, u.username
              FROM posts AS p
              JOIN users AS u
              ON p.post_author = u.id
              WHERE p.post_status = ?
              ORDER BY p.post_date DESC";
      $stmt = ExecuteQuery($sql, ['p.post_status' => 1]);
      $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
    }


    // A function to query posts by their topics
    function getPostsByTopicID($topic_id)
    {
      global $conn;
      $sql = "SELECT p.*, u.username
              FROM posts AS p
              JOIN users AS u
              ON p.post_author = u.id
              WHERE p.post_status = ?
              AND topic_id = ?";
      $stmt = ExecuteQuery($sql, ['p.post_status' => 1, 'topic_id' => $topic_id]);
      $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
    }
    //A function to query posts by a search term
    function searchPosts($term)
    {
      global $conn;
      $match = '%'.$term.'%';
      $sql = "SELECT p.*, u.username
              FROM posts AS p
              JOIN users AS u
              ON p.post_author = u.id
              WHERE p.post_status = ?
              AND p.post_title LIKE ?
              OR p.post_content LIKE ?";
      $stmt = ExecuteQuery($sql, ['p.post_status' => 1, 'post_title' => $match, 'post_content'=> $match]);
      $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
    }

    //A function to get Post comments
    function getPostComments($post_id)
    {
      global $conn;
      $sql = "SELECT  c.*,u.username
              FROM comments as c
              JOIN users as u
              ON c.comment_author = u.id
              JOIN posts as p
              ON c.comment_post_ID = p.id
              WHERE c.comment_post_ID = ?";
        $stmt = ExecuteQuery($sql, ['comment_post_ID' => $post_id]);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }

    //A function to get all posts
    function getAllPosts()
    {
      global $conn;
      $sql = "SELECT p.*, u.username
              FROM posts AS p
              JOIN users AS u
              ON p.post_author = u.id";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
    }

    //A function to count comments
    function commentCount($post_c_id)
    {
      global $conn;
      $sql = "SELECT count(c.id) as comment_count
              FROM comments as c
              WHERE c.comment_post_ID = ?";
      $stmt = ExecuteQuery($sql, ['comment_post_ID' => $post_c_id]);
      $records = $stmt->get_result()->fetch_assoc();
      return $records;
    }

    //A function to select one row from the database
    function loginUserEmailOrPassword($table, $conditions)
    {
      global $conn;
      $sql = "SELECT * FROM $table";
      $i = 0;
      foreach ($conditions as $key => $value) {
        if($i == 0){
            $sql = $sql." WHERE $key = ?";
        }
        else{
            $sql = $sql." OR $key = ?";
        }
        $i++;
      }


      $sql = $sql." LIMIT 1";
      $stmt = ExecuteQuery($sql, $conditions);
      $records = $stmt->get_result()->fetch_assoc();
      return $records;
    }
 ?>
