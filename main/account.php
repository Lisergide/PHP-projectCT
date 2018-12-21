<?php
function index() {
    $sql = "SELECT id, login, password, name, typeUser FROM users";
    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);
    $content = '';
    if (!empty($row)) {
        $_SESSION['IS_ADMIN'] = $_POST['login'];
        $content .= <<<php
    <div class="jumbotron">
      <h1 class="display-4">Hello, {$_SESSION['IS_USER']}{$_SESSION['IS_ADMIN']}!</h1>
      <p class="lead">Your login: {$_SESSION['IS_USER']}{$_SESSION['IS_ADMIN']}.</p>
      <hr class="my-4">
      <a class="btn btn-primary btn-lg" href="?page=exit" role="button">Выход</a>
    </div>
php;
    }
    return $content;
}