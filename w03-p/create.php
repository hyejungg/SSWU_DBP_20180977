<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root06', 'dbp');
  $query = "SELECT * FROM fFood";
  $result = mysqli_query($link, $query);
  $list = "";
  while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['foodName']}</a></li>";
  }

  $article = array(
    'foodName' => '',
    'reason' => ''
  );

  if (isset($_GET['id'])) {
      settype($_GET['id'], 'integer');
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      $query = "SELECT * FROM foodName WHERE id={$filtered_id}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
      'foodName' => $row['foodName'],
      'reason' => $row['reason']
    );
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> 간식 추가하는 곳 </title>
  <style>
    /* #list { align-items: center;} */
    a{text-decoration: none}

    #listArea{
      background: pink;
      width: 30%;
      height:auto;
    }
  </style>
</head>
<body>
  <h1><a href="index.php">*내가 좋아하는 간식들*</a></h1>
  <div id="listArea">
    <ol id="list"><?= $list ?></ol>
  </div>
    <form action="process_create.php" method="POST">
      <p><input type="text" name="foodName" placeholder="간식명"></p>
      <p><textarea name="reason" placeholder="좋아하는 이유를 쓰세요"></textarea></p>
      <p><input type="submit" value="추가"></p>
    </form>
  </body>
</html>
