<?php
// Crear una imagen en blanco y añadir algún texto
$im = imagecreatetruecolor(320, 240);
$color_texto = imagecolorallocate($im, 150, 200, 50);
$datetime = date("Y/m/d H:i:s");
imagestring($im, 20, 5, 5,  $datetime, $color_texto);

// Establecer la cabecera de tipo de contenido - en este caso image/jpeg
header('Content-Type: image/jpeg');

// Imprimir la imagen
imagejpeg($im);

// Liberar memoria
imagedestroy($im);
?> 
