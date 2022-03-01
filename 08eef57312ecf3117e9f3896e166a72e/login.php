<?php
error_reporting(0);

if (isset($_GET['debug'])) {
  die(highlight_file(__FILE__));
}

include "flag.php";

if($_POST["pwd"]){

 $pass = $_POST["pwd"];
 if(md5($pass) == "2b4b57f505b581209ed16b97c3c544a9"){
   echo('<script>alert("'.$flag.' "); history.back();</script>');
 }else{
   echo('<script>alert("Wrong password!"); history.back();</script>');
 }
die;
}
?>

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
          <center><h3 class="login-length">Password login</h3></center>
          <br/>
          <form method="POST">
          <input name="pwd" class="form-control" type="text" placeholder="Password">
          <br/>
          <button class="x-submit btn btn-primary btn-lg" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
</body>
<!-- ?debug for source code -->
</html>