<!DOCTYPE html>
<html>
  <head>
    <title>AWS Technical Essentials v4.1</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

      <div class="row">
    		<div class="col-md-12">
      <?php include('menu.php'); ?>
      <?php 
      echo "after menu.php<br>";
      ?>
      <div class="jumbotron">
      <?php 
      echo "before put-cpu-load.php<br>";
      ?>

      <?php include('put-cpu-load.php'); ?>
      <?php 
      echo "after put-cpu-load.php<br>";
      ?>

      <hr />

      <?php 
      echo "before get-cpu-load.php<br>";
      ?>
      <?php include('get-cpu-load.php'); ?>
      <?php 
      echo "after get-cpu-load.php<br>";
      ?>

    </p>
    <p>
    </p>
  </div>
</div>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
  </body>
</html>
