<?php
function resizeThumbnailImage($image,$nail, $w=100,$h=100)
	{   
		$qual =90 ;
		list($width, $height, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$dest = $nail ;
		if($w == 0){
			$w = ($h/$height)*$width ;
		}
		if($h == 0){
			$h = ($w/$width)*$height ;
		}
		$ratio = $w/$h ;

		$ratio_pic = $width / $height;
		$outputX  = $w;
		$outputY  = $h;
		
		if($ratio_pic < 1 ){
			if($ratio >= 1){
				$heightx = ($width/$w) *$h ;
				$deltaX   = 0;
				if($height - $heightx > 0){
					$deltaY   = ($height - $heightx) / 2;
				} else{
					$deltaY   = 0 ;
				}
				$portionX = $width;
				$portionY = $heightx;
			}
			if($ratio <  1){
				$tmp_h =   ($w/$width) * $height;
				$tmp_w =  ($h/$height) * $width;
				if($tmp_w >= $w){
					$widthx = ($height/$h) *$w ;
					if($width - $widthx > 0){
						$deltaX   = ($width - $widthx) / 2;
					} else{
						$deltaX   = 0;
					}
					$deltaY   = 0;
					$portionX = $widthx;
					$portionY = $height;
				} else if($tmp_h >=$h ){
					$heightx = ($width/$w) *$h ;
					$deltaX   = 0;
					if($height - $heightx > 0){
						$deltaY   = ($height - $heightx) / 2;
					} else{
						$deltaY   = 0 ;
					}
					$portionX = $width;
					$portionY = $heightx;
				}
			}
		} else if($ratio_pic > 1) {
			if($ratio > 1){
				$tmp_h =   ($w/$width) * $height;
				$tmp_w =  ($h/$height) * $width;
				if($tmp_w >= $w){
					$widthx = ($height/$h) *$w ;
					if($width - $widthx > 0){
						$deltaX   = ($width - $widthx) / 2;
					} else{
						$deltaX   = 0;
					}
					$deltaY   = 0;
					$portionX = $widthx;
					$portionY = $height;
				} else if($tmp_h >=$h ){
					$heightx = ($width/$w) *$h ;
					$deltaX   = 0;
					if($height - $heightx > 0){
						$deltaY   = ($height - $heightx) / 2;
					} else{
						$deltaY   = 0 ;
					}
					$portionX = $width;
					$portionY = $heightx;
				}
			}
			if($ratio <=  1){
				$widthx = ($height/$h) *$w ;
				if($width - $widthx > 0){
					$deltaX   = ($width - $widthx) / 2;
				} else{
					$deltaX   = 0;
				}
				$deltaY   = 0;
				$portionX = $widthx;
				$portionY = $height;
			}
		} else{
			if($ratio > 1){
				$heightx = ($width/$w) *$h ;
				$deltaX   = 0;
				if($height - $heightx > 0){
					$deltaY   = ($height - $heightx) / 2;
				} else{
					$deltaY   = 0 ;
				}
				$portionX = $width;
				$portionY = $heightx;
			}
			if($ratio <  1){
				$widthx = ($height/$h) *$w ;
				if($width - $widthx > 0){
					$deltaX   = ($width - $widthx) / 2;
				} else{
					$deltaX   = 0;
				}
				$deltaY   = 0;
				$portionX = $widthx;
				$portionY = $height;
			}
			if($ratio ==  1){
				$deltaX   = 0;
				$deltaY   = 0;
				$portionX = $width;
				$portionY = $height;
			}
		}
		$thumb = imagecreatetruecolor($outputX, $outputY);
		switch ($imageType){
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source = imagecreatefromjpeg($image);
				imagecopyresampled($thumb, $source, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY);
				imagejpeg($thumb, $dest, $qual);
				break;
			case "image/gif":
				$source = imagecreatefromgif($image);
				imagecopyresampled($thumb, $source, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY);
				imagegif($thumb, $dest, $qual);
				break;
			case "image/png":
			case "image/x-png":
				$source = imagecreatefrompng($image);
				imagecopyresampled($thumb, $source, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY);
				imagepng($thumb, $dest);
				break;
			default:
				echo "Unsupported filetype selected";
				exit;
		}
		imagedestroy($thumb);
		imagedestroy($source);
}
function secureStr($str)
{
	$str = trim($str) ;
	$regx = array('"','<','>',"\\(","\\)","'","eval\\((.*)\\)","[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']") ;
	$place = array('&#34;','&lt;','&gt;',"&#40;","&#41;","&#39;","","\"\"") ;
	$str2 = str_replace($regx,$place , $str) ;
	return $str2;
}
 ?>
