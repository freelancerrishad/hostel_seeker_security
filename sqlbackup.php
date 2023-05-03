<?php

    include_once "Mysqldump.php" ;
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=hostel_seeker', 'root', '');
    $d = date('y-m-d');
    $r = rand(10000,90000);
    $dump->start('storage/'.$d.$r.'dump.sql');

  echo '  <script>alert("Your backup done successfully");
  document.location = "index.php"</script>';
    ?>