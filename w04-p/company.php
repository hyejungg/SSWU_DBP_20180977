<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root06', 'dbp');

  $query = "SELECT * FROM company";
  $result = mysqli_query($link, $query);
  $company_info = '';
  $escaped = array(
    'name' => '',
    'profile' => ''
  );

  $form_action = 'process_create_author.php'; //기본
  $label_submit = 'Create author'; //기본
  $form_id = ''; //처음 author 페이지에 왔을 땐 비어있어야 함. 클릭 시 -> update 수행

  while ($row = mysqli_fetch_array($result)) {
      $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'name' => htmlspecialchars($row['name']),
      'profile' => htmlspecialchars($row['profile'])
    );
      $company_info .= "<tr>";
      $company_info .= '<td>'.$filtered['id'].'</td>';
      $company_info .= '<td>'.$filtered['name'].'</td>';
      $company_info .= '<td>'.$filtered['profile'].'</td>';
      $company_info .= '<td><a href="company.php?id='.$filtered['id'].'">update</a></td>';
      $company_info .= '
        <td>
          <form action="process_delete_company.php" method="post">
            <input type="hidden" name="id" value="'.$filtered['id'].'">
            <input type="submit" value="delete">
          </form>
        </td>
        ';
      $company_info .= "</tr>";
  };

  if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      settype($filtered_id, 'integer');

      $query = "SELECT * FROM company WHERE id = {$filtered_id}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $escaped['name'] = htmlspecialchars($row['name']);
      $escaped['profile'] = htmlspecialchars($row['profile']);

      $form_action = 'process_update_company.php';
      $label_submit = 'Update company';
      $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>냠냠</title>
  <style>
    a{text-decoration: none}
  </style>
</head>
<body>
  <h1><a href="index.php">*내가 좋아하는 간식들*</a></h1>
  <p><a href="company.php">회사리스트</a></p>

  <table border="1">
    <tr>
      <th>id</th>
      <th>name</th>
      <th>profile</th>
      <th>update</th>
      <th>delete</th>
    </tr>
    <?= $company_info ?>
  </table>
  <br>
  <form action="<?= $form_action ?>" method="POST">
    <?= $form_id ?>
    <label for="fname">name:</label><br>
    <input type="text" id="name" name="name"
          placeholder="name" value="<?= $escaped['name'] ?>"><br>
    <label for="lname">profile:</label><br>
    <input type="text" id="profile" name="profile"
           placeholder="profile" value="<?= $escaped['profile'] ?>"><br><br>
    <input type="submit" value="<?= $label_submit?>">
  </form>
</html>
