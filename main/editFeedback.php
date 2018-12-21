<?php
function index() {
    $id = (int) $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $author = clearStr($_POST['author']);
        $text = clearStr($_POST['text']);
        $sqlUpd = "UPDATE feedback SET author = '$author', text = '$text' WHERE id = $id";
        $sql = "SELECT  author, text, productID FROM feedback WHERE id = $id";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        mysqli_query(connect(), $sqlUpd);
        header('Location:  ?page=goods&func=one&id=' . $row['productID']);
        exit;

    }

    $sql = "SELECT  author, text FROM feedback WHERE id = $id";
    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    $content = <<<php
    <form action="" method="post" class="container" style="width: 700px;">
        <h4>Редактировать отзыв: </h4>
        <div class="form-row">
            <input class="form-control col mr-3" type="text" name="author" placeholder="Автор" value="{$row['author']}">
            <input class="form-control col mr-3" type="text" name="text" placeholder="Текст" value="{$row['text']}">
            <button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </form>
php;

    return $content;
}