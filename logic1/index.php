<?php
error_reporting(0);

if (isset($_GET['debug'])) {
	  die(highlight_file(__FILE__));
}
?>
<!DOCTYPE html>
<html>
<title>d41d8cd98f00b204e9800998ecf8427e</title>
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
          <center><h3 class="login-length">Enter passphrase</h3></center>
          <br/>
          <form method="POST">
    <div class="form-group">
        <input type="text" style="width: 100%" class="form-control" name="pwd" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
include 'flag.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	  $random = rand();
	      extract($_POST);

	      if($pwd == $random){
		              echo('<br><pre style=\"width: 100%\">Congrats! Here is the '.$flag.'</pre>');
			          }else{
					          echo('<br><pre style=\"width: 100%\">Wrong passphrase!</pre>');
						      }
	      die;
}
?>
</div>
</div>
</div>
<!-- ?debug for source code -->
</html>

