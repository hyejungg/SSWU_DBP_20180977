<?php 
$link = mysqli_connect('localhost', 'admin', 'admin', 'sakila');
$query = "
        SELECT f.title, f.description, l.name, count(*) FROM film f
        INNER JOIN inventory i ON i.film_id = f.film_id 
        INNER JOIN language l ON l.language_id = f.language_id
        GROUP BY f.film_id ORDER BY count(*) desc limit 10 
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

$query = "     
        SELECT f.title, f.description, l.name, f.length, f.rating 
        FROM film f  
        INNER JOIN language l ON l.language_id = f.language_id 
        GROUP BY f.film_id ORDER BY length limit 10;
        ";
$result = mysqli_query($link, $query);  
$short_list = '';
while($row = mysqli_fetch_array($result)) {
  $short_list .= '<tr>';
  $short_list .= '<td>'.$row['title'].'</td>';
  $short_list .= '<td>'.$row['description'].'</td>';
  $short_list .= '<td>'.$row['name'].'</td>';
  $short_list .= '<td>'.$row['length'].'</td>';
  $short_list .= '<td>'.$row['rating'].'</td>';
  $short_list .= '</tr>';
}
mysqli_free_result($result);

$query = "     
        SELECT f.title, f.description, l.name, f.length, f.rating 
        FROM film f  
        INNER JOIN language l ON l.language_id = f.language_id 
        GROUP BY f.film_id ORDER BY length desc limit 10;
        ";
$result = mysqli_query($link, $query);  
$long_list = '';
while($row = mysqli_fetch_array($result)) {
  $long_list .= '<tr>';
  $long_list .= '<td>'.$row['title'].'</td>';
  $long_list .= '<td>'.$row['description'].'</td>';
  $long_list .= '<td>'.$row['name'].'</td>';
  $long_list .= '<td>'.$row['length'].'</td>';
  $long_list .= '<td>'.$row['rating'].'</td>';
  $long_list .= '</tr>';
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
        h2 { color : orange;}
        h5 { color : gray;}
        a{text-decoration: none}
    </style>
</head>

<body>
    <h1><a href="index.php"> 혜정이네 DVD 책방</a> | <a href="category_film_list.php">카테고리별 영화 목록 </a></h1>
    <hr>
    <h2> DVD 대여 가능한 수가 많은 영화 목록 순 </h2>
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
    <hr>
    <h2> 영화 시간이 가장 짧은 DVD top 10 </h2>
    <h5> 'G' : 전체 관람가 / 'PG' : 12세 전체 이용가 / 'PG13' : 13세 전체이용가 / 'R' : 만 15세 미만 관람 불가 / 'NC-17' : 만 17세 미만 관람 불가 </h5>
    <table border = 1>
        <tr>
            <th>DVD 이름</th>
            <th>DVD 설명</th>
            <th>언어</th>
            <th>러닝타임(분)</th>
            <th>관람가</th>
        </tr>
        <?= $short_list ?>
    </table>
    <br>
    <hr>
    <hr>
    <h2> 영화 시간이 가장 긴 DVD top 10 </h2>
    <h5> 'G' : 전체 관람가 / 'PG' : 12세 전체 이용가 / 'PG13' : 13세 전체이용가 / 'R' : 만 15세 미만 관람 불가 / 'NC-17' : 만 17세 미만 관람 불가 </h5>
    <table border = 1>
        <tr>
            <th>DVD 이름</th>
            <th>DVD 설명</th>
            <th>언어</th>
            <th>러닝타임(분)</th>
            <th>관람가</th>
        </tr>
        <?= $long_list ?>
    </table>
    <br>
    <hr>
</body>

</html>