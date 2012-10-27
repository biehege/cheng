<?php

ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define('IN_PTF', 1);

define('APP_ROOT', __DIR__ . '/../');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>Test for Cheng</title>
    <link rel="stylesheet" type="text/css" href="static/style.css" />
</head>
<body>
    <a href="?a=clear">clear all side effects in db</a>
    <h1><a href="?">Test for Cheng</a></h1>
    <div class="conclusion fail" id="pre-box">SOME FAIL!</div>
    <ol><?php include 'test.php'; ?></ol>
    <div class="conclusion <?= $all_pass? 'pass' : 'fail' ?>"><?= $all_pass? 'ALL PASS' : 'SOME FAIL!' ?></div>
    <script>
    window.onload = function () {
        var box = document.getElementById('pre-box');
        box.style.display = 'none';
    };
    </script>
</body>
</html>
