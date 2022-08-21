<?php
include_once __DIR__ . '/router.php';

Router::get('/', function() {
    include_once __DIR__ . '/login.php';
});
Router::get('/view', function () {
    include_once __DIR__ . '/view.php';
});

Router::get('/logout', function () {
    header('location: /logout.php');
});

Router::get('/login', function () {
    include_once __DIR__ . '/login.php';
});

Router::post('/login', function () {
    include_once __DIR__ . '/login.php';
});

Router::get('/add' , function () {
    include_once __DIR__ . '/add.php';
});

Router::post('/create', function () {
    include_once __DIR__ . '/create.php';
});

Router::post('/UD', function () {
    include_once __DIR__ . '/UD.php';
});

Router::post('/update', function () {
    include_once __DIR__ . '/update.php';
});

Router::get('/register', function () {
    include_once __DIR__ . '/register.php';
});

Router::post('/register', function () {
    include_once __DIR__ . '/register.php';
});

Router::get('/forget', function () {
    include_once __DIR__ . '/forget.php';
});

Router::post('/forget', function () {
    include_once __DIR__ . '/forget.php';
});

Router::get('/change' , function() {
    include_once __DIR__ . '/change.php';
});

Router::post('/change' , function() {
    include_once __DIR__ . '/change.php';
});