<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
    <title>RPi Cam Preview</title>
    <script src="script_min.js"></script>
  </head>
  <body onload="setTimeout('init();', 100);">
    <div class="preview"><img src="cam.jpg" id="mjpeg_dest" alt="Actual Image"></div>
  </body>
</html>
