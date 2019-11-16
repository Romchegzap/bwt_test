<?php

/**
 * Reference to following example to specify routes:
 *
 * return [
 *     'url' => [
 *         'controller' => 'controller name',
 *         'action' => 'controller method',
 *         'name' => 'this url unique name',
 *         'perm' => 'required user status',
 *     ],
 *     ...
 * ];
 *
 * 'url' - i.e. 'account/login';  'account/register'; ect. Note that you shouldn't write leading and trailing '/'.
 *              Trlailing '/' is added automticaly.
 *
 *
 * 'controller' - Controller class name for this url.
 *                Your extended controller names should be of that kind: 'NameController' i.e.
 *                'MainController'; 'UserController'.
 *                'Controller' will be automaticaly added to specified name.
 *
 * 'action' - Method name of given controller class which will be called.
 *
 * 'name' - Unique url alias. You can reference to this url via its name. If you do so,
 *          you are free to safely change your url in routes.
 *
 * 'perm' - Group of users allowed to this url i.e. 'guest'; 'autoraized'.
 *
 * @return array
 */

return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
        'name' => 'homepage',
        'perm' => 'autorized',
    ],

    'post_feedback' => [
        'controller' => 'main',
        'action' => 'postFeedback',
        'validator' => 'PostFeedbackValidator',
        'name' => 'post_feedback',
        'perm' => 'all',
    ],
    'login' => [
        'controller' => 'user',
        'action' => 'login',
        'validator' => 'LoginUserValidator',
        'name' => 'login',
        'perm' => 'guest',
    ],

    'register' => [
        'controller' => 'user',
        'action' => 'register',
        'validator' => 'RegisterUserValidator',
        'name' => 'register',
        'perm' => 'guest',
    ],

    'logout' => [
        'controller' => 'user',
        'action' => 'logout',
        'name' => 'logout',
        'perm' => 'autorized',
    ],

];