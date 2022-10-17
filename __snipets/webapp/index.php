<?php

  //PHP
  include_once "./database/pdo.php"

?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/menu/menu.css">
    <script src="https://kit.fontawesome.com/5a5630a971.js" crossorigin="anonymous"></script>
    <title>WebApp</title>
  </head>
  <body>

    <section class="sideMenu">
      <input type="checkbox" id="toggle_menu">
      <label for="toggle_menu">
        <i class="fa fa-bars" id="open_menu"></i>
        <i class="fa fa-arrow-left" id="close_menu"></i>
      </label>
      <nav class="navigator">
        <header> <a href="index.php">WebApp</a> </header>
        <ul>
          <li><a href="#"><i class="fa fa-box"></i>Dashboard</a></li>
          <li><a href="#"><i class="fa fa-link"></i>Shortcuts</a></li>
          <li><a href="#"><i class="fa fa-stream"></i>Overview</a></li>
          <li><a href="#"><i class="fa fa-calendar-week"></i>Events</a></li>
          <li><a href="#"><i class="fa fa-question-circle"></i>About</a></li>
          <li><a href="#"><i class="fa fa-sliders-h"></i>Services</a></li>
          <li><a href="#"><i class="fa fa-envelope"></i>Contact</a></li>
        </ul>
      </nav>
    </section>

    <div class="div">
        <label for="" class="label">texo</label>
    </div>

  </body>
</html>
