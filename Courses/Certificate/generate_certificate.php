<?php
session_start();

// Example: pull from session if set, otherwise from POST
$name   = $_SESSION['user_name'] ?? ($_POST['user_name'] ?? 'John Doe');
$course = $_SESSION['course_name'] ?? ($_POST['course_name'] ?? 'Sample Course');
$date  = date('F j, Y');

// Paths
$templatePath = __DIR__ . '/Certificate.png'; // certificate template
$fontPath     = __DIR__ . '/times.ttf'; // font path

// Load template
$image = imagecreatefrompng($templatePath);
$textColor = imagecolorallocate($image, 0, 0, 0); // Black text

// Function: Centered text with auto font scaling
function centerText($image, $text, $fontPath, $maxWidth, $y, $maxFontSize, $minFontSize, $color) {
    $fontSize = $maxFontSize;
    do {
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = abs($bbox[4] - $bbox[0]);
        if ($textWidth <= $maxWidth) break;
        $fontSize--;
    } while ($fontSize >= $minFontSize);

    // Center horizontally
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2;

    imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
}

// Certificate layout ()
centerText($image, $name,   $fontPath, 1200, 700, 60, 30, $textColor);
imagettftext($image, 40, 0, 850, 870, $textColor, $fontPath, $course);
imagettftext($image, 33, 0, 1550, 1000, $textColor, $fontPath, $date);

// this is for using with quiz results javascript 
// Output as Base64 for AJAX
// ob_start();
// imagejpeg($image, null, 90); // 90% quality
// imagedestroy($image);
// $imageData = ob_get_clean();

// echo base64_encode($imageData);

// === OUTPUT IMAGE === for self testing 
header('Content-Type: image/jpeg');
// header('Content-Disposition: attachment; filename="certificate_test.jpg"');
imagejpeg($image, null, 90);
imagedestroy($image);

?>