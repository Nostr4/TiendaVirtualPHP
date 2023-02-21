<?php
   function resizeImage($file) {
        $src = imagecreatefromstring(file_get_contents($file));
        $width = imagesx($src);
        $height = imagesy($src);
        $newwidth = 75;
        $newheight = 75;
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        ob_start();
        imagejpeg($dst);
        $image_data = ob_get_contents();
        ob_end_clean();
        imagedestroy($dst);
        imagedestroy($src);
    
        return $image_data;
    }
?>
