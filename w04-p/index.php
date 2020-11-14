<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root06', 'dbp');
  $query = "SELECT * FROM fFood";
  $result = mysqli_query($link, $query);
  $list = "";
  while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['foodName']}</a></li>";
  }

  $article = array(
    'title' => '맛있겠다.',
    'reason' => '',
    'name' => '',
  );

  $updated = '';
  $deleted = '';
  $company = ''; //초기화 필수! 없으면 값 가져와도 안보여줌!

  if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      $query = "SELECT * FROM fFood LEFT JOIN company
      ON ffood.company_id = company.id WHERE ffood.id={$filtered_id}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      // print_r($row);
      $article['title'] = htmlspecialchars($row['foodName']);
      $article['reason'] = htmlspecialchars($row['reason']);
      $article['name'] = htmlspecialchars($row['name']);

      $updated = '<a href="update.php?id='.$_GET['id'].'">수정하기</a>';
      $deleted = '
      <form action="process_delete.php" method="POST">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="삭제하기">
      </form>
    ';

      $company = "<p>by {$article['name']}</p>";
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

    /* #addFoodArea{
      width: 30%;
      height:auto;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      border-style: dashed;
    } */

  </style>
  <meta charset="utf-8">
  <title> 냠냠 </title>
</head>
<body>
  <h1><a href="index.php">*내가 좋아하는 간식들*</a></h1>
  <a href="company.php">회사</a>
  <div id="listArea">
    <ol id="list"><?= $list ?></ol>
  </div>
  <!-- <div id="addFoodArea"> -->
    <a href ="create.php">간식 추가하기</a>
    <?= $updated ?>
    <?= $deleted ?>
  <!-- </div> -->
  <h2><?= $article['title'] ?></h2>
  <?= $article['reason'] ?>
  <?= $company ?>
</body>
</html>
