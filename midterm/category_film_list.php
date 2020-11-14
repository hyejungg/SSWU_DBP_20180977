<?php 
$link = mysqli_connect('localhost', 'admin', 'admin', 'sakila');

$category_list = '';
if(isset($_GET['category'])){
    $filtered_category = mysqli_real_escape_string($link, $_GET['category']);
    $query = "
            SELECT c.name, f.title, f.rating FROM film f
            INNER JOIN film_category fc ON fc.film_id = f.film_id 
            INNER JOIN category c ON c.category_id = fc.category_id 
            WHERE c.category_id = ".$filtered_category."
            ORDER BY rand() limit 10 
            ";
    // print_r($query);
    $result = mysqli_query($link, $query);
    // print_r($result);
    while($row = mysqli_fetch_array($result)) {
        $category_list .= '<tr>';
        $category_list .= '<td>'.$row['name'].'</td>';
        $category_list .= '<td>'.$row['title'].'</td>';
        $category_list .= '<td>'.$row['rating'].'</td>';
        $category_list .= '</tr>';
    }        
    mysqli_free_result($result); 
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Sakila DVD 대여 시스템 </title>
    <style>
        body{
            text-align : center;
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table{
            text-align : center;
            width: 100%;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
        h2 { color : green;}
        h5 { color : gray;}
        a{text-decoration: none}
    </style>
</head>

<body>
    <h1><a href="index.php"> 혜정이네 DVD 책방</a> | <a href="film_list.php">대여 가능 영화 목록 </a></h1>
    <hr>
    카테고리 선택
    <form action="category_film_list.php" method="GET">
        <!-- <input type="hidden" name="categery" value="0"> -->
        <select name="category">
            <option value ="1">Action</option>
            <option value ="2">Animation</option>
            <option value ="3">Children</option>
            <option value ="4">Classics</option>
            <option value ="5">Comedy</option>
            <option value ="6">Documentary</option>
            <option value ="7">Drama</option>
            <option value ="8">Family</option>
            <option value ="9">Foreign</option>
            <option value ="10">Games</option>
            <option value ="11">Horror</option>
            <option value ="12">Music</option>
            <option value ="13">New</option>
            <option value ="14">Sci-Fi</option>
            <option value ="15">Sports</option>
            <option value ="16">Travel</option>
        </select>
        <input type="submit" value="선택">
        <h5>카테고리 선택 시 해당 카테고리의 10개의 DVD를 랜덤으로 추천해드립니다.</h5>
    </form>
    <table border = 1>
        <tr>
            <th>카테고리</th>
            <th>DVD 이름</th>
            <th>관람가</th>
        </tr>
        <?= $category_list ?>
    </table>
    <h5> 'G' : 전체 관람가 / 'PG' : 12세 전체 이용가 / 'PG13' : 13세 전체이용가 / 'R' : 만 15세 미만 관람 불가 / 'NC-17' : 만 17세 미만 관람 불가 </h5>
    <hr>
</body>

</html>