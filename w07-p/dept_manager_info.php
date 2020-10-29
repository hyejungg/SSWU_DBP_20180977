<?php
  $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');
  $query = "
    SELECT dept.dept_no, d.dept_name, count(*) 
    FROM employees e 
    INNER JOIN dept_manager dept ON dept.emp_no = e.emp_no
    INNER JOIN departments d ON d.dept_no = dept.dept_no
    GROUP BY dept.dept_no";
  $result = mysqli_query($link, $query);  
  $dept_manager_info = '';
  while($row = mysqli_fetch_array($result)) {
    $dept_manager_info .= '<tr>';
    $dept_manager_info .= '<td>'.$row['dept_no'].'</td>';
    $dept_manager_info .= '<td>'.$row['dept_name'].'</td>';
    $dept_manager_info .= '<td>'.$row['count(*)'].'</td>'; 
    $dept_manager_info .= '</tr>';
  }  

  mysqli_free_result($result);
  mysqli_close($link);
  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>직원 관리 시스템</title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table{
            width: 100%;
            text-align: center;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>
</head>
<body>
    <h2><a href="index.php">직원 관리 시스템</a> | 직원 정보 조회</h2>
    <table>
        <tr>
            <th>부서번호(dept_no)</th>
            <th>부서명(dept_name)</th>
            <th>해당 부서 내 매니저 인원</th>
        </tr>
        <?= $dept_manager_info ?>
    </table>
    <hr>
    <!-- <h3>부서 내 매니저 정보</h3> -->
    <!-- <form action="dept_manager_info.php" method="GET">
        부서번호(dept_no)을 입력하세요.<br >
        <input type="text" name="dept_no" placeholder="dept_no">
        <input type="submit" value="Search">
    </form>-->
    <!--  $manager   -->
</body>
</html>