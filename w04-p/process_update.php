<?php
 $link = mysqli_connect("localhost:3307", "root", "root06", "dbp");
 settype($_GET['id'], 'integer');
 $filtered = array(
   'id' => mysqli_real_escape_string($link, $_POST['id']),
   'foodName' => mysqli_real_escape_string($link, $_POST['foodName']),
   'reason' => mysqli_real_escape_string($link, $_POST['reason'])
 );

 $query = "
   UPDATE fFood
    SET
      foodName = '{$filtered['foodName']}',
      reason = '{$filtered['reason']}'
    WHERE id = '{$filtered['id']}'
 ";

 $result = mysqli_query($link, $query);

 if ($result == false) {
     echo '수정하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
     error_log(mysqli_error($link));
 } else {
     echo 'DB에 수정을 성공했습니다. <a href="index.php">돌아가기</a>';
 }
