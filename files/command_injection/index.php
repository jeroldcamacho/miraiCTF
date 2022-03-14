<!DOCTYPE html>
<html>
<title>dc633aa2cdf5eba7c495bee55c050953</title>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <style>

    .centered {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .login-length { width: 200px;}
    .x-submit { position: relative; left: auto; right: -120px;}
  </style>

<div class="row">
      <div class="centered">
        <div class="well">
          <center><h3 class="login-length">PING? PING!</h3></center>
          <br/>
          <form action="index.php">
    <div class="form-group">
        <strong>Enter domain name.</strong>
        <input type="text" style="width: 100%" class="form-control" name="domain" placeholder="google.com" required>
    </div>
    <button type="submit" class="btn btn-primary">PING</button>
</form>

<?php
    if (isset($_GET['domain'])){
      echo "<br><pre style=\"width: 100%\">";
      system("ping -c 1 " . $_GET['domain']);
      echo "</pre>";
    }
    ?>
        </div>
      </div>
    </div>
<body>

<!-- <div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <div class="search-container">
    <form>
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<div style="padding-left:16px">
  <h3>ping me?</h2>
  

</div>
</body>
</html> -->
