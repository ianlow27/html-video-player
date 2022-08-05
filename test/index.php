<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php

  require_once("../vendor/autoload.php"); 

  $oplayer = new Ianl28\HtmlVideoPlayer\HtmlVideoPlayer();

  echo  $oplayer->gethtml(). "\n";

?>
</body>
</html>
