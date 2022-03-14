<?php
include_once("flag.php");

if (isset($_GET['debug'])) {
    die(highlight_file(__FILE__));
  }

// $curr_time = time()
// $hash = strrev(sha1("AAAAAAAAAAAAAAAA{$curr_time}AAAAAAAAAAAAAAAAAAA".chr(rand(97,122))));

if (isset($_GET["hash"])){
    if ($TOKEN === md5($_GET["hash"])){
        echo $FLAG;
    } else {
        echo 'L';
    }
}
?>
<pre>hello</pre>
<!-- ?debug for source code -->
