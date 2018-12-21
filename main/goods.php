<?php
function index() {
    $sql = 'SELECT id, url, size, name, views, price, count FROM gallery2 ORDER BY views DESC';
    $res = mysqli_query(connect(), $sql);
    $content = '';

    $content .= <<<php
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=1">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Товары</li>
        </ol>
    </nav>
        <h1>Товары <span class="badge badge-secondary">New</span></h1>
php;

    $arr = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $arr[] = $row;
    }

    $content .= "<div class='productBlock'><div class='row'>";

    foreach ($arr as $key => $value) {
        $content .= "<div class='col-xl-3 col-lg-4 col-md-6'><div class='card mb-4 shadow-sm'>
    <a href='?page=goods&func=one&id=$value[id]' style='text-decoration: none;'>
    <img class='card-img-top' src='img/$value[url]' alt='$value[name]' style='width: 230px; display: block;'></a>
    <div class='card-body'><p class='card-text'>Цена: $value[price] руб.
    <a href='#' onclick='send($value[id])' class='myBuy btn btn-success float-xl-right float-lg-right' role='button'>Купить</a></p></div></div></div>";
    }

    $content .= "</div></div>";

return $content;
}

function one() {
    $id = (int) $_GET['id'];
    $sql = "SELECT id, url, size, name, views, count, price FROM gallery2 WHERE id = $id";
    $sqlFeed = "SELECT id, text, author, productID FROM feedback WHERE productID = $id";
    $res = mysqli_query(connect(), $sql);
    $resFeed = mysqli_query(connect(), $sqlFeed);
    $row = mysqli_fetch_assoc($res);


    $content = <<<php
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=1">Главная</a></li>
                <li class="breadcrumb-item"><a href="?page=goods">Товары</a></li>
                <li class="breadcrumb-item active" aria-current="page">{$row['name']}</li>
            </ol>
        </nav>
php;
    mysqli_query(connect(), "UPDATE gallery2 SET views = views + 1 WHERE id = $id");

    $content .= "<div class='container'><div class='row'><div class='col'><figure class='figure border'>
            <img src='img/$row[url]' alt='$row[name]'>
            <h2>{$row['name']}</h2><a href='#' onclick='send($row[id])' class='myBuy btn btn-success mr-3 mb-1 float-xl-right float-lg-right' role='button'>Купить</a>
            <figcaption class='figure-caption'>Количество просмотров: " . ($row['views'] + 1) . "</figcaption>
            <h5>Цена: " . $row['price'] . " руб. </h5></figure></div><div class='col'>";

    while ($row = mysqli_fetch_assoc($resFeed)) {
        if ($_GET['id'] == $row['productID']) {
            $content .= "<div class='alert alert-primary' role='alert'><strong>{$row['author']} :</strong> {$row['text']}
            <button  type='button' name='del' class='close' aria-label='Close'>
            <a href='?page=delFeedback&id=$row[id]' name='del' aria-hidden='true' style='text-decoration: none;'>&times;</a></button>
            <a href='?page=editFeedback&id=$row[id]' name='edit' aria-hidden='true' data-target='#exampleModal' style='text-decoration: none;'>
            <i class='fas fa-edit'></i></a>
            </div>";
        }
    }
    $content .= "</div></div></div>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $text = clearStr($_POST['text']);
        $author = clearStr($_POST['author']);
        $productID = (int)($_GET['id']);
        $sql = "INSERT INTO feedback (text, author, productID) VALUES ('$text', '$author', '$productID')";
        mysqli_query(connect(), $sql);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $content .= <<<php
    <form action="" method="post" class="container" style="width: 700px;">
        <h4>Оставь отзыв: </h4>
        <div class="form-row">
            <input class="form-control col mr-3" type="text" name="author" placeholder="Автор">
            <input class="form-control col mr-3" type='text' name='text' placeholder='Текст'>
            <button class='btn btn-primary' name='add' type="submit">Отправить</button>
        </div>
    </form>
php;

    return $content;
}
