<?php
function index() {
    $sql = "SELECT login, password, name, typeUser FROM users";
    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = clearStr($_POST['login']);
        $password = md5($_POST['password']);
        $name = clearStr($_POST['name']);
        $sql = "INSERT INTO users (login, password, name, typeUser) VALUES ('$login', '$password', '$name', 'user')";
        mysqli_query(connect(), $sql);
        header('Location: ?page=account');
    }

    $content = '';
    if (!empty($row)) {
        $content .= <<<php
    <form action="?page=account" method="post" class="container border p-4" style="width: 200px;">
        <div class="form-group">
        <input class="form-control" name="login" type="text" placeholder="Login">
        </div>
        <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
      <div class="form-group">
        <input class="form-control" name="name" type="text" placeholder="Name">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
php;
    }
    return $content;

}