<?php
    session_start();

    $page = ! empty($_GET['page']) ? $_GET['page'] : 'index';
    $func = ! empty($_GET['func']) ? $_GET['func'] : 'index';

    $dir = __DIR__ .'/';

    if (! file_exists($dir. $page .'.php')){
        $page = 'index';
    }

    include($dir . $page .'.php');

    if (! function_exists($func)){
        $func = 'index';
    }

    include ($dir . 'config.php');

    $content = $func();

    $msg = '';
    if ($_SESSION['msg']){
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    $template = file_get_contents($dir . 'tmpl/' . 'public.html' );

    $newDate = [
        '{CONTENT}' => $content,
        '{___MSG_}' => $msg,
        '{__COUNT}' => count($_SESSION['goods'])
    ];

    /*var_dump($_SESSION);*/
    echo strtr($template, $newDate);