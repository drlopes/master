<?php

move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . '/' . $_FILES['file']['name']);
