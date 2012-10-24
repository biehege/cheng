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
    <title>Test for xcPHPLib</title>
    <link rel="stylesheet" type="text/css" href="static/style.css" />
</head>
<body>
    <h1>Test for xcPHPLib</h1>
    <ol><?php include 'test.php'; ?></ol>
</body>
</html>
