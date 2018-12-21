<?php

function index(){

    if (! empty($_POST)){
        isUorToken();
        $login = clearStr($_POST['login']);
        $sql = "SELECT login, password, name, typeUser FROM users WHERE login = '$login'";
        $res = mysqli_query(connect(), $sql);
        $row = mysqli_fetch_assoc($res);
        if (empty($row)){
            $_SESSION['msg'] = 'Не верный логин или пароль';
            header('Location: ?page=user');
            exit;
        }
        if ($row['password'] == md5($_POST['password'])) {
            $_SESSION['user'] = [
                'name' => $row['name'],
                'typeUser' => $row['typeUser'],
            ];
            $_SESSION['isUser'] = IS_USER;

            if ($row['typeUser'] == 'admin'){
                $_SESSION['isAdmin'] = IS_USER;
            }


        }
        $_SESSION['msg'] = 'Не верный логин или пароль';
        header('Location: ?page=user');
        exit;
    }

    if (! empty($_SESSION['isUser']) && $_SESSION['isUser'] == IS_USER){
        $content = <<<php
		<a href="?page=exit" class="btn btn-primary" role="button">Выход</a>
php;
    } else {
        $token = newToken();
        $content = <<<php
    <form action="?page=account" method="post" class="container border p-4" style="width: 200px;">
            $token
            <div class="form-group">
        <input class="form-control" name="login" type="text" placeholder="Login">
        </div>
        <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <a class="btn btn-primary mb-2" href="?page=newAccount" role="button">New Account</a>
      <button class="btn btn-primary mb-2" role="submit">Submit</button>
    </form>
php;

    }
    return $content;
}

function addUser() {
    isAdmin();
}