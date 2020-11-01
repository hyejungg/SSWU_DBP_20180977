<?php 
$link = mysqli_connect('localhost', 'admin', 'admin', 'sakila');
$filtered_name = mysqli_real_escape_string($link, $_POST['first_name']);
$query = "
        SELECT fa.actor_id, f.title, f.length, f.rating FROM film_actor fa 
        INNER JOIN film f ON f.film_id = fa.film_id 
        INNER JOIN actor a ON a.actor_id = fa.actor_id 
        WHERE a.first_name = '".$filtered_name."'
        ";
// print_r($query);
$result = mysqli_query($link, $query);
// print_r($result);
$actor_film_list = '';
$filtered_actor_id = '';
while($row = mysqli_fetch_array($result)) {
    $filtered_actor_id = $row['actor_id'];

    $actor_film_list .= '<tr>';
    $actor_film_list .= '<td>'.$row['title'].'</td>';
    $actor_film_list .= '<td>'.$row['length'].'</td>';
    $actor_film_list .= '<td>'.$row['rating'].'</td>';
    $actor_film_list .= '</tr>';
}        
mysqli_free_result($result); 

$film_count = '';
$query = "
        SELECT count(*) AS count FROM film_actor
        WHERE actor_id = ".$filtered_actor_id."
         ";
// print_r($query);
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$film_count = $row[0];
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
        h2 { color : green;}
        h3 { color : blue;}
        h5 { color : gray;}
        a{text-decoration: none}
    </style>
</head>

<body>
    <h1><a href="index.php"> 혜정이네 DVD 책방</a></h1>
    <h5> 'G' : 전체 관람가 / 'PG' : 12세 전체 이용가 / 'PG13' : 13세 전체이용가 / 'R' : 만 15세 미만 관람 불가 / 'NC-17' : 만 17세 미만 관람 불가 </h5>
    <h3><?= $filtered_name ?>의 영화는 총 <?= $film_count ?>개 입니다.</h3>
    <table border = 1>
        <tr>
            <th>DVD 이름</th>
            <th>러닝타임(분)</th>
            <th>관람가</th>
        </tr>
        <?= $actor_film_list ?>
    </table>
    <br>
    <hr>
</body>

</html>