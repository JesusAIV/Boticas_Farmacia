<?php
// Texto que se convertirá en código de barras
$texto = '0123456789';

// Crear una imagen en blanco
$ancho = 300; // Ancho de la imagen
$alto = 100; // Alto de la imagen
$imagen = imagecreatetruecolor($ancho, $alto);

// Definir colores
$colorBlanco = imagecolorallocate($imagen, 255, 255, 255); // Color blanco
$colorNegro = imagecolorallocate($imagen, 0, 0, 0); // Color negro

// Rellenar la imagen con color blanco
imagefilledrectangle($imagen, 0, 0, $ancho, $alto, $colorBlanco);

// Crear el código de barras usando la fuente de código de barras
$fuente = 5; // Tamaño de la fuente
$espacio = 10; // Espacio entre los dígitos
$x = 10; // Posición x inicial
$y = 50; // Posición y
for ($i = 0; $i < strlen($texto); $i++) {
    imagestring($imagen, $fuente, $x, $y, $texto[$i], $colorNegro);
    $x += $espacio;
}

// Generar la imagen como archivo PNG
imagepng($imagen, 'codigo_de_barras.png');

// Liberar la memoria utilizada por la imagen
imagedestroy($imagen);

echo 'Código de barras generado y almacenado como imagen.';
?>
