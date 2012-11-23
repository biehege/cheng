<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$sqls = explode(';', file_get_contents('install.sql'));

foreach ($sqls as $sql) {
    if (ON_SAE && preg_match('/USE|CREATE\sDATABASE/', $sql)) {
        continue;
    }
    Pdo->
}
