<?php 
$link = mysqli_connect('localhost', 'admin', 'admin', 'sakila');
$query = "
        SELECT f.title, f.description, l.name, count(*) FROM film f
        INNER JOIN inventory i ON i.film_id = f.film_id 
        INNER JOIN language l ON l.language_id = f.language_id
        GROUP BY f.film_id ORDER BY rand() limit 1 
        ";
$result = mysqli_query($link, $query);  
$recomend_list = '';
while($row = mysqli_fetch_array($result)) {
  $recomend_list .= '<tr>';
  $recomend_list .= '<td>'.$row['title'].'</td>';
  $recomend_list .= '<td>'.$row['description'].'</td>';
  $recomend_list .= '<td>'.$row['name'].'</td>';
  $recomend_list .= '<td>'.$row['count(*)'].'</td>';
  $recomend_list .= '</tr>';
} 
mysqli_free_result($result); 
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
        #recomend { color : red;}
        a{text-decoration: none}
    </style>
</head>

<body>
    <h1> 혜정이네 DVD 책방 </h1>
    <hr>
    <h2 id="recomend"> ↓↓↓ 오늘의 추천 DVD ↓↓↓ </h2>
    <table border = 1>
        <tr>
            <th>DVD 이름</th>
            <th>DVD 설명</th>
            <th>언어</th>
            <th>대여 가능</th>
        </tr>
        <?= $recomend_list ?>
    </table>
    <br>
    <hr>
    <h2><a href="film_list.php">DVD 대여 가능한 영화 목록</a></h2>
    <h2><a href="category_film_list.php">카테고리별 영화 목록</a></h2><br>
    <form action="search_actor_film.php" method="POST">
        배우명(first_name):
        <input type="text" name="first_name" placeholder="first_name">
        <input type="submit" value="Search">
    </form>
</body>

</html>