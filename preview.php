<!DOCTYPE html> <html>
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" media="all" href="style.css">
    <link rel="stylesheet" type="text/css" media="all" href="table.css">
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script class="init">$(document).ready(function() { $('#example').dataTable(); } ); </script>
    <title>RPi Cam Download</title>
  </head>
  <body>
    <p><a href="index.php">Back</a></p>
    <?php
      if(isset($_GET["delete"])) {
        unlink("media/" . $_GET["delete"]);
      }
      if(isset($_GET["delete_all"])) {
        $files = scandir("media");
        foreach($files as $file) unlink("media/$file");
      }
      else if(isset($_GET["file"])) {
        echo "<h2>Preview: " . $_GET["file"] . "</h2>";
        echo "<div class='preview2'>";
        if(substr($_GET["file"], -3) == "jpg"){
            echo "<a href='media/" . $_GET["file"] . "' target='_blank'><img src='media/" . $_GET["file"] . "' width='640' alt=" . $_GET["file"] . "></a>";
        } else {
            echo "<video width='640' controls><source src='media/" . $_GET["file"] . "' type='video/mp4'>Your browser does not support the video tag.</video>";
        }
        echo "</div>";
        echo "<p><input type='button' value='Download' onclick='window.open(\"download.php?file=" . $_GET["file"] . "\", \"_blank\");'> ";
        echo "<input type='button' value='Delete' onclick='window.location=\"preview.php?delete=" . $_GET["file"] . "\";'></p>";
      }
    ?>
    <h1>Files</h1>
    <?php
      $files = scandir("media");
      if(count($files) == 2) {
        echo "<p>No videos/images saved</p>";
      } else {
        echo "<div class='tableList'>";
	echo "<table id='example' class='display'>";
        echo "<thead><tr><th>No</th><th>Name</th><th>Type</th><th>Date</th><th>Time</th><th>Size</th></tr></thead>";
        echo "<tbody>";

	function sizeFilter( $bytes ) {
	    $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
	    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
	    return( round( $bytes, 2 ) . " " . $label[$i] );
	}

        $i=0;
        foreach($files as $file) {
          if(($file != '.') && ($file != '..')) {
            $alt="";
            $i+=1;
            if($i % 2){$alt ='class="alt"';}
            $type = strtoupper(substr($file, -3));
            $fdate = date ("Y/m/d", filectime("./media/" . $file));
            $ftime = date ("H:i:s", filectime("./media/" . $file));
            $fsz = sizefilter(filesize("media/" . $file)); //round ((filesize("media/" . $file)) / (1024 * 1024));
            echo "<tr><td>$i</td><td><a href='preview.php?file=$file'>$file</a><td>$type</td><td>$fdate</td><td>$ftime</td><td>$fsz</td></tr>";
          }
        }

        echo "<tbody>";
        echo "<tfoot><tr><th>No</th><th>Name</th><th>Type</th><th>Date</th><th>Time</th><th>Size</th></tr></tfoot>";
        echo "</table>";
        echo "</div>";
        echo "<p><input type='button' value='Delete all' onclick='if(confirm(\"Delete all?\")) {window.location=\"preview.php?delete_all\";}'></p>";
      }
    ?>
    <p>Last modification: <?php echo(date("F d Y H:i:s.", getlastmod())); ?> <a href="Copyright.txt">Copyright.</a></p>
  </body> </html>
