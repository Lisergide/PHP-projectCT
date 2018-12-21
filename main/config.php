<?php
    define('IS_USER', 'asd8yupo0p');

    function connect(){
        static $link;
        if (empty($link)){
            $link = mysqli_connect('localhost', 'root', '', 'gallery');
        }
        return $link;
    }

    function clearStr($str)
    {
        return mysqli_real_escape_string(connect(), strip_tags(trim($str)));
    }

    function isAdmin(){
        if ($_SESSION['isAdmin'] != IS_USER){
            $_SESSION['msg'] = 'Нет доступа';
            header('Location: ?page=user');
            exit;
        }
    }

    function newToken(){
        $token = uniqid();
        $_SESSION['token'] = $token;
        return "<input type='hidden' name='token' value='$token'>";
        header('Location: ?page=account');
    }

    function isUorToken(){
        if (empty($_POST['token']) || $_POST['token'] != $_SESSION['token'] ){
            $_SESSION['msg'] = 'Ошибка формы';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }