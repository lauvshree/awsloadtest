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

        echo $ep.' '.$db.' '.$un.' '.$pw;
        $mysql_command = "mysql -u $un -p$pw -h $ep $db < sql/addressbook.sql";
        try {
          $mysqli = new mysqli($ep, $un, $pw, $db);
        } catch (mysqli_sql_exception $e) {
          echo $e->getMessage();
        }

        $sql = file_get_contents('./sql/addressbook.sql');
        if ($sql === false) {
          die("Could not read SQL file.");
        }

        if (!$mysqli->multi_query($sql)) {
          die("First query failed: " . $mysqli->error);
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
