<?php

use Alura\CRUD\Controller\{
    InsertController,
    Persistence,
    ListCourses,
    DeleteController,
    UpdateController,
    LoginForm,
    Logoff,
    DoLogin,
    JsonCourse,
    XmlCourse
};

return [
    '/new-entry' => InsertController::class,
    '/save-course' => Persistence::class,
    '/list-courses' => ListCourses::class,
    '/update-course' => UpdateController::class,
    '/delete-course' => DeleteController::class,
    '/login' => LoginForm::class,
    '/do-login' => DoLogin::class,
    '/logout' => Logoff::class,
    '/getCoursesInJson' => JsonCourse::class,
    '/getCoursesInXml' => XmlCourse::class
];
