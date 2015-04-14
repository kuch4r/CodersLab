<?php


$logourl = 'http://www.coderslab.pl/img/logo.png';
$imgurl  = 'http://c.wrzuta.pl/wi6414/725f6a34002ca29b500d7c28';

$img = imagecreatefromjpeg($imgurl);
$img_width = imagesx($img);
$img_height = imagesy($img);

$logo = imagecreatefrompng($logourl);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);


if( $img_width < $img_height) {
	$dest_height = intval($img_height * 0.7);
	$dest_width  = $logo_width * $dest_height / $logo_height;
} else {
	$dest_width = intval($img_width * 0.7);
	$dest_height  = $logo_height * $dest_width / $logo_width;
}

$dest_x = $img_width - $dest_width- 5;
$dest_y = $img_height - $dest_height - 5;


imagealphablending($img, false);
imagesavealpha($img, true);

$new_watermark = imagecreatetruecolor($dest_width, $dest_height);
imagealphablending($new_watermark, false);
$color = imagecolortransparent($new_watermark, imagecolorallocatealpha($new_watermark, 0, 0, 0, 127));
imagefill($new_watermark, 0, 0, $color);
imagesavealpha($new_watermark, true);
imagecopyresampled($new_watermark, $logo, 0, 0, 0, 0, $dest_width, $dest_height, $logo_width,$logo_height);

$cut = imagecreatetruecolor($dest_width, $dest_height);
imagecopy($cut, $img, 0, 0, $dest_x, $dest_y, $dest_width, $dest_height);
imagecopy($cut, $new_watermark, 0, 0, 0, 0, $dest_width, $dest_height); 
imagecopymerge($img, $cut, $dest_x, $dest_y, 0, 0, $dest_width, $dest_height, 50); 

//imagecopyresized  ($img, $logo, intval($dest_x), intval($dest_y), 0, 0,  $dest_width, $dest_height, $logo_width, $logo_height);

header('Content-type: image/png');


imagepng($img);

imagedestroy($img);
imagedestroy($logo);


