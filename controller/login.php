<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

/**
* todo:
* test for back_url
* - if come from register? to register first and then redirect to another because of check in reister
*/

if (isset($_GET['logout']) && isset($user)) {
    $user->logout();
    redirect();
}

if ($has_login) {
    redirect();
}

$username = _post('username');
$password = _post('password');

$msg = '';
if ($is_post) {
    if (User::check($username, $password)) {
        $user = User::getByName($username);
        $type = $user->type;
        $$type = $user->instance();
        $$type->login();
        $back_url = _get('back') ?: DEFAULT_LOGIN_REDIRECT_URL;
        redirect($back_url);
    }
}

$view .= '?master';
