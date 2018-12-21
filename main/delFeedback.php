<?php
function index() {
    if ($_GET['id']) {
        $id = (int) $_GET['id'];
        $sql = "DELETE FROM feedback WHERE id = $id";
        mysqli_query(connect(), $sql);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}

