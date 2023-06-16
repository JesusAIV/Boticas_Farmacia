<?php
session_start();

// Generar el código CAPTCHA aleatorio
$captcha = generateCaptcha();
$_SESSION['captcha'] = $captcha;

// Crear una imagen CAPTCHA
$image = imagecreate(120, 40);
$background = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 30, 12, $captcha, $textColor);

// Mostrar la imagen CAPTCHA
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

// Generar el código CAPTCHA aleatorio
function generateCaptcha($length = 6) {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $captcha = '';
  $charactersLength = strlen($characters);
  for ($i = 0; $i < $length; $i++) {
    $captcha .= $characters[rand(0, $charactersLength - 1)];
  }
  return $captcha;
}
?>
