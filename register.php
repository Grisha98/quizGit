<?php

  include 'db/query.php';

  $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

  $dbCall->insert('Users', $_POST);


?>
