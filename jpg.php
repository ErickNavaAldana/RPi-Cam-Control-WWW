<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo "It looks like GD is installed";
} else {
    echo "It looks like GD is NOT installed";
}
?>
