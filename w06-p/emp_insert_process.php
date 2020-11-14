<?php  
    $link = mysqli_connect('localhost','admin', 'admin', 'employees');
    settype($_GET['emp_no'], 'integer');
    $filtered = array(
        'emp_no' => mysqli_real_escape_string($link, $_POST['emp_no']),
        'birth_date' => mysqli_real_escape_string($link, $_POST['birth_date']),
        'first_name' => mysqli_real_escape_string($link, $_POST['first_name']),
        'last_name' => mysqli_real_escape_string($link, $_POST['last_name']),
        'gender' => mysqli_real_escape_string($link, $_POST['gender']),
        'hire_date' => mysqli_real_escape_string($link, $_POST['hire_date'])
    );

    $select_query = "
        SELECT * FROM employees WHERE emp_no = '{$filtered['emp_no']}';
    ";

    $insert_query = "
        INSERT INTO employees(
            emp_no, 
            birth_date, 
            first_name, 
            last_name, 
            gender, 
            hire_date
            ) VALUES (
                '{$filtered['emp_no']}',
                '{$filtered['birth_date']}',
                '{$filtered['first_name']}',
                '{$filtered['last_name']}',
                '{$filtered['gender']}',
                '{$filtered['hire_date']}'
    )";

    $select_result = mysqli_query($link, $select_query);
    $row = mysqli_fetch_array($select_result);
    // print_r($row);
    // $insert_result = mysqli_query($link, $insert_query);
    // print_r($select_query);
    if($row){
        echo '이미 존재하는 emp_no 입니다 <a href="emp_insert.php">돌아가기</a>';
        $select_result->close();
    }else{
        $insert_result = mysqli_query($link, $insert_query);
        if($insert_result == false){
            echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
            error_log(mysqli_error($link));
        }else{
            header('Location:emp_select.php');
        }
    }

?>