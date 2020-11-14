<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root06', 'dbp');
  $query = "SELECT * FROM fFood";
  $result = mysqli_query($link, $query);
  $list = "";
  while($row = mysqli_fetch_array($result)){
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['foodName']}</a></li>";
  }

  $article = array(
    'title' => '맛있겠다.',
    'reason' => ''
  );

  if( isset($_GET['id'])){
    $query = "SELECT * FROM fFood WHERE id={$_GET['id']}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $article = array(
      'title' => $row['foodName'],
      'reason' => $row['reason']
    );
  }
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    /* #list { align-items: center;} */
    a{text-decoration: none}

    #listArea{
      background: pink;
      width: 30%;
      height:auto;
    }

    #addFoodArea{
      width: 30%;
      height:auto;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      border-style: dashed;
    }

  </style>
  <meta charset="utf-8">
  <title> 냠냠 </title>
</head>
<body>
  <h1><a href="index.php">*내가 좋아하는 간식들*</a></h1>
  <div id="listArea">
    <ol id="list"><?= $list ?></ol>
  </div>
  <div id="addFoodArea">
    <a href ="create.php">간식 추가하기</a>
  </div>
  <h2><?= $article['title'] ?></h2>
  <?= $article['reason'] ?>
</body>
</html>
