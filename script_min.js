//
// MJPEG
//
var mjpeg_img;

function reload_img() {
    "use strict";
    mjpeg_img.src = "cam_pic.php?time=" + new Date().getTime();
}

function error_img() {
    "use strict";
    setTimeout("mjpeg_img.src = 'cam_pic.php?time=' + new Date().getTime();", 100);
}

//
// Init
//
function init() {
    // mjpeg
    "use strict";
    mjpeg_img = document.getElementById("mjpeg_dest");
    mjpeg_img.onload = reload_img;
    mjpeg_img.onerror = error_img;
    reload_img();
}
