private function createThumb($filePath, $to)
    {
        if (file_exists($filePath))
        {
            $thumbWidth = 134;
            $thumbHeight = 189;
            $thumbBeforeWord = "thumb";
            $image_details = getimagesize($filePath);
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $originalWidth = $image_details[0];
            $originalHeight = $image_details[1];
            $filename = $_FILES['isthombe']['name'];
            if ($originalWidth > $originalHeight)
            {
                $new_width = $thumbWidth;
                $new_Height = intval($originalHeight * $new_width / $originalWidth);
                echo "width is more than height<br>";
            }
            else
            {
                $new_Height = $thumbHeight;
                $new_width = intval($originalWidth * $new_Height / $originalHeight);
                echo "Height is more than width<br>";
            }
            $dest_x = intval(($thumbWidth * $new_width) / 2);
            $dest_y = intval(($thumbHeight * $new_Height) / 2);
            if ($fileType == "jpg" || $fileType == "jpeg")
            {
                $imgt = "ImageJPEG";
                $src = imagecreatefromjpeg($filePath);
            }
            else if ($fileType == "png")
            {
                $imgt = "ImagePNG";
                $src = imagecreatefrompng($filePath);
            }
            else{
                $imgt = "ImageGIF";
                $src = imagecreatefromgif($filePath);
            }
            if ($src)
            {
                
                $ox = imagesx($src);
                $oy = imagesy($src);

                $nx = self::WOI;
                $ny = floor($oy * (self::WOI / $ox));

                $nm = imagecreatetruecolor($nx, $ny);

                imagecopyresized($nm, $src, 0,0,0,0,$nx, $ny, $ox, $oy);
                imagejpeg($nm, $to, 100);
                return (true);
            }
        }
        return (false);
    }
