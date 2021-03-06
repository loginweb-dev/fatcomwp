<?php 
    // require_once('../../../../wp-load.php');
    

    include('qrcode/qrlib.php');
    // include('qrcode/qrconfig.php');
  
    
    $QR_BASEDIR = dirname(__FILE__).DIRECTORY_SEPARATOR;

    $cod_order = $_GET["cod_order"];
    $text_qr = $_GET["text_qr"];

    $codeContents = $text_qr;
    $tempDir = $QR_BASEDIR.'qrcode/temp/';
    $fileName = $cod_order.'.jpg';
    $outerFrame = 4;
    $pixelPerPoint = 5;
    $jpegQuality = 95;
    
    // echo 'prueba3';
    // // generating frame-----------------------------------------------
    $frame = QRcode::text($codeContents, false, QR_ECLEVEL_M);
    // echo "hola mundo4";
    // rendering frame with GD2 (that should be function by real impl.!!!)
    $h = count($frame);
    $w = strlen($frame[0]);
    
    $imgW = $w + 2*$outerFrame;
    $imgH = $h + 2*$outerFrame;
    
    $base_image = imagecreate($imgW, $imgH);
    
    $col[0] = imagecolorallocate($base_image,255,255,255); // BG, white 
    $col[1] = imagecolorallocate($base_image,0,0,0);     // FG, blue

    imagefill($base_image, 0, 0, $col[0]);

    for($y=0; $y<$h; $y++) {
        for($x=0; $x<$w; $x++) {
            if ($frame[$y][$x] == '1') {
                imagesetpixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]); 
            }
        }
    }
    
    // saving to file-------------------------------------------
    $target_image = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint);
    imagecopyresized(
        $target_image, 
        $base_image, 
        0, 0, 0, 0, 
        $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH
    );
    imagedestroy($base_image);
    imagejpeg($target_image, $tempDir.$fileName, $jpegQuality);
    imagedestroy($target_image);
?>