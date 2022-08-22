<?php

spl_autoload_register(function(string $namespace)
{
  $path = str_replace('Alura\\Bank', 'src', $namespace);
  $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
  $path = $path . '.php';

  if (file_exists($path))
  {
    require_once $path;
  }
});

?>
