<?php

use Alura\Cursos\Controller\{
    ListCourses,
    ControllerInsert,
    Persistence,
    ControllerDelete,
    ControllerUpdate,
    LoginForm,
    DoLogin,
    Logoff
};

return [
    '/list-courses' => ListCourses::class,
    '/new-course' => ControllerInsert::class,
    '/save-course' => Persistence::class,
    '/delete-course' => ControllerDelete::class,
    '/update-course' => ControllerUpdate::class,
    '/login' => LoginForm::class,
    '/do-login' => DoLogin::class,
    '/logout' => Logoff::class
];
