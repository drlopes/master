<?php

namespace Alura\CRUD\Helper;

trait FlashMessage
{
    function flashMessage($message, $type): void
    {
        $_SESSION['message'] = $message;
        $_SESSION['message-type'] = $type;
    }
}
