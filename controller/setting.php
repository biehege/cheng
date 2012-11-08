<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');

$settings = Setting::get();
$name_map = $config['setting_name_map'];

$msg = '';
$ERROR_INFO = $config['error']['info'];
if ($by_post) {
    $password = _post('password');
    $new_password = _post('new_password');
    $re_password = _post('re_password');

    if (empty($password)) {
        $msg = $ERROR_INFO['PASSWORD_EMPTY'];
    } elseif (!$user->checkPassword($password)) {
        $msg = $ERROR_INFO['PASSWORD_INCORRECT'];
    } elseif (empty($new_password)) {
        $msg = $ERROR_INFO['NEW_PASSWORD_EMPTY'];
    } elseif ($new_password !== $re_password) {
        $msg = $ERROR_INFO['PASSWORD_NOT_SAME'];
    } else {
        $user->changePassword($new_password);

        redirect();
    }
}

if ($target === 'password') {
    $matter = 'password';
} else {
    $matter = $view;
}
$view = 'board?master';
