<?php
    $link = mysqli_connect('localhost','admin', 'admin', 'employees');
    settype($_POST['emp_no'], 'integer');
    $filtered_id = mysqli_real_escape_string($link, $_POST['emp_no']);
    $query = "
        SELECT * FROM employees WHERE emp_no = '{$filtered_id}'
    ";
    // print_r($query);
    $result = mysqli_query($link, $query);
    $selected_user = '';
    while($row = mysqli_fetch_array($result)){
        $selected_user .= 
        '<table border="1">
            <tr>
            <th>emp_no</th>
            <th>birth_date</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>gender</th>
            <th>hire_date</th>
        </tr>';  
        $selected_user .= '<tr>';
        $selected_user .= '<td>'.$row['emp_no'].'</td>';
        $selected_user .= '<td>'.$row['birth_date'].'</td>';
        $selected_user .= '<td>'.$row['first_name'].'</td>';
        $selected_user .= '<td>'.$row['last_name'].'</td>';
        $selected_user .= '<td>'.$row['gender'].'</td>';
        $selected_user .= '<td>'.$row['hire_date'].'</td>'; 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>직원 관리 시스템</title>
</head>
<body>
    <h1> 직원 관리 시스템 </h1>
    <a href="emp_select.php">(1) 직원 정보 조회</a><br>
    <form action="index.php" method="POST">
    (1)-1. 해당 직원 정보 조회 :
    <input type="text" name="emp_no" placeholder="emp_no">
    <input type="submit" value="Search">
    </form>
    <a href="emp_insert.php">(2) 신규 직원 등록</a> <br >
    <form action="emp_update.php" method="POST">
    (3) 직원 정보 수정 :
    <input type="text" name="emp_no" placeholder="emp_no">
    <input type="submit" value="Search"> <br >
    </form>
    <form action="emp_delete.php" method="POST">
    (3) 직원 정보 삭제 :
    <input type="text" name="emp_no" placeholder="emp_no">
    <input type="submit" value="Delete"> <br >
    </form>
    <?= $selected_user ?>
</body>
</html>