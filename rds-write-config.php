<!DOCTYPE html>
<html>
<head>
  <title>AWS Technical Essentials v4.1</title>
  <meta http-equiv="refresh" content="3,URL=rds.php" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

  <body>
    <div class="container">

      <div class="row">
      <div class="col-md-12">
      <?php include('menu.php'); ?>

      <div class="jumbotron">

      <?php
        $ep = $_POST['endpoint'];
      	$db = $_POST['database'];
        $un = $_POST['username'];
        $pw = $_POST['password'];
        $pt = $_POST['PORT'];

        try {
          $mysqli = mysqli_init();

          if (!$mysqli->real_connect($ep, $un, $pw, $db, $pt, null)) {
            die("Connect failed: " . mysqli_connect_error());
          }

          $mysqli->query("CREATE DATABASE IF NOT EXISTS ".$db." CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
          $mysqli->query("USE ".$db);
          $mysqli->select_db($db);
        } catch (mysqli_sql_exception $e) {
          die($e->getMessage());
        }

        $sql = file_get_contents('sql/addressbook.sql');
        if ($sql === false) {
          die("Could not read SQL file.");
        }
        try {
          if (!$mysqli->multi_query($sql)) {
          die("First query failed: " . $mysqli->error);
          }
        } catch (mysqli_sql_exception $e) {
          die($e->getMessage());
        }
 

        if ($mysqli->errno) {
            die("Error after executing script: " . $mysqli->error);
        }


            echo "<br /><p>Writing config out to rds.conf.php </p>";

            $rds_conf_file = 'rds.conf.php';
            $handle = fopen($rds_conf_file, 'w') or die('Cannot open file:  '.$rds_conf_file);
            $data = "<?php \$RDS_URL='" . $ep . "'; \$RDS_DB='" . $db . "'; \$RDS_user='" . $un . "'; \$RDS_pwd='" . $pw . "'; ?>";
            fwrite($handle, $data);
            fclose($handle);

        echo "<br /><br /><p><i>Redirecting to rds.php in 3 seconds (or click <a href=rds.php>here</a>)</i></p>";


      ?>

    </div>
    </div>
  </div>
  </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
