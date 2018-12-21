<?php
function index(){
    session_destroy();
    header('Location: ?page=user');
    exit;
}