<?php
class ImageComponent extends Object
{
    
    function upload($imagen,$to = null)
     {
        
        $imagevars= getimagesize($imagen["tmp_name"]);
        
        /** */
        if(empty($imagevars))
        {
            echo "archivo de imagen no v&aacute;lido"; exit();
        }
        /** me desago de los caracteres extra�os*/        
        $fileName=preg_replace('/[^a-zA-Z0-9]/','',uniqid('img').$imagen["name"]);
        $fileName=substr($fileName,0,-3);
        
       /** Seteo las variables del objeto */  
       $this->imagen=$imagevars;
       if($imagevars[2]==1){$this->imageext = 'gif';} 
       if($imagevars[2]==2){$this->imageext = 'jpg';} 
       if($imagevars[2]==3){$this->imageext = 'png';} 
       $this->name=$fileName.".".$this->imageext; 
       $this->width =$imagevars["0"];
       $this->height =$imagevars["1"];
       
       if(!$to)
       $to=$this->tempdir;
       
        
       if(move_uploaded_file($imagen["tmp_name"],$to.$this->name))
            {
                return $this->name;
            }
            else
            {
                return false;
            }
            
          
     } 
    
      
     function copy_and_optimize($image_src,$top_width=null,$top_height=null,$folderName)
     {
        $tempuploaddir = "img/Foto/orig/";
        $destinationddir = "img/$folderName";
        if(!is_dir($destinationddir))
        mkdir($destinationddir,0777,true);
        $imagen=getimagesize($tempuploaddir.$image_src);
             
       if($imagen[2]==1){$img = imagecreatefromgif($tempuploaddir.$image_src);}
       if($imagen[2]==2){$img = imagecreatefromjpeg($tempuploaddir.$image_src);}
       if($imagen[2]==3){$img = imagecreatefrompng($tempuploaddir.$image_src);}  
       
       if($top_width && $top_height)
        {if($imagen[0]>$top_width)//si la imagen es mas ancha
        {
            $width=$top_width;
            $height=($top_width/$imagen[0])*$imagen[1];            
        }
        else
        {
            $width=$imagen[0];
            $height=$imagen[1];
        }
        if($height>$top_height)//si el alto es mas alto todavia
        {
           $width= ($top_height/$height)* $width;
           $height=$top_height;
        }//se crea una imagen
        }
        else        
        {
             if(!$top_width)
             {
                $width= ($top_height/$imagen[1])* $imagen[0];
                $height=$top_height;
                
             }
             if(!$top_height)
             {
                $width=$top_width;
                $height=($top_width/$imagen[0])*$imagen[1];
                
             }           
        }
                         
        $img_des = ImageCreateTrueColor($width,$height);
		imagecopyresampled ($img_des,$img, 0, 0, 0, 0, $width, $height, $imagen[0], $imagen[1]);
        //genero un nombre y verifico caracteres extra�os y logitud
        $fileName=$image_src;
        
       // if(strlen($fileName)>50)
//        $fileName=substr($fileName, 0, 49);
		//guardo la imagen
       if($imagen[2]==1){imagegif($img_des,$destinationddir.$fileName,100); }
       if($imagen[2]==2){imagejpeg($img_des,$destinationddir.$fileName,100); }
       if($imagen[2]==3){imagepng($img_des,$destinationddir.$fileName); }        
       //unlink($tempuploaddir.$image_src);//borrar la imagen del tmp
      
     }
     
         /**
     * ImageComponent::upload_image_and_thumbnail()
     * 
     * @param mixed $name nombre de campo
     * @param mixed $data $this->data
     * @param mixed $datakey $this->modelClass
     * @param mixed $imgscale escala grande
     * @param mixed $thumbscale escala normal
     * @param mixed $folderName folder donde se guardara "$this->name"
     * @param mixed $square si quieres sacar cuadrado
     * @return
     */
     
    function upload_image_and_thumbnail($name,$data, $datakey, $imgscale, $thumbscale,$folderName,$square,$full=false,$orig=false) {
       
     	if (strlen($data[$datakey][$name]['name'])>4){
		  
					$error = 0;
					$tempuploaddir = "img//temp"; // the /temp/ directory, should delete the image after we upload
					$biguploaddir = "img//".$folderName."//big"; // the /big/ directory
					$smalluploaddir = "img//".$folderName."//small"; // the /small/ directory for thumbnails
                    $fulldir = "img//".$folderName."//full";
                    $origdir = "img//".$folderName."//orig";
					
					// Make sure the required directories exist, and create them if necessary
                    
					if(!is_dir($tempuploaddir))
                     mkdir($tempuploaddir,0777,true);
					if(!is_dir($biguploaddir))
                     mkdir($biguploaddir,0777,true);
					if(!is_dir($smalluploaddir))
                     mkdir($smalluploaddir,0777,true);
                    if(!is_dir($fulldir))
                     mkdir($fulldir,0777,true);
                     if(!is_dir($origdir))
                     mkdir($origdir,0777,true);
					
					$filetype = $this->getFileExtension($data[$datakey][$name]['name']);
					$filetype = strtolower($filetype);
 
					if (($filetype != "jpeg")  && ($filetype != "jpg") && ($filetype != "gif") && ($filetype != "png"))
					{
						// verify the extension
						return;
					}
					else
					{
						// Get the image size
						$imgsize = GetImageSize($data[$datakey][$name]['tmp_name']);
					}

					// Generate a unique name for the image (from the timestamp)
					$id_unic = str_replace(".", "", uniqid($name,true));
					$filename = $id_unic;
					  
					settype($filename,"string");
					$filename.= ".";
					$filename.=$filetype;
					$tempfile = $tempuploaddir . "/$filename";
					$resizedfile = $biguploaddir . "/$filename";
					$croppedfile = $smalluploaddir . "/$filename";
                    $fullfile = $fulldir . "/$filename";
                    $origfile = $origdir . "/$filename";
					
					
//					if (is_uploaded_file($data[$datakey][$name]['tmp_name']))
//                    {                    
						// Copy the image into the temporary directory
                        if (!copy($data[$datakey][$name]['tmp_name'],"$tempfile"))
                        {
                            print "Error Uploading File!.";
                            exit(); 
                        }
						else {				
							/*
							 *	Generate the big version of the image with max of $imgscale in either directions
							 */
							$this->resize_img($tempfile, $imgscale, $resizedfile);							
							
							if($square) {
								/*
								 *	Generate the small square version of the image with scale of $thumbscale
								 */
								$this->crop_img($tempfile, $thumbscale, $croppedfile);
							}
							else {
								/*
								 *	Generate the big version of the image with max of $imgscale in either directions
								 */
								$this->resize_img($tempfile, $thumbscale, $croppedfile);
							}
                            if($full)
                            {
                                $this->resize_img_2($tempfile, $full, $fullfile);
                                
                            }
                             if($orig)
                            {
                                
                                
                                $filetype = $this->getFileExtension($tempfile);
                        		$filetype = strtolower($filetype);
                        			  
                        		switch($filetype){
                        			case "jpeg":
                        			case "jpg":
                        			  $img_src = ImageCreateFromjpeg ($tempfile);
                        			 break;
                        			 case "gif":
                        			  $img_src = imagecreatefromgif ($tempfile);
                        			 break;
                        			 case "png":
                        			  $img_src = imagecreatefrompng ($tempfile);
                        			 break;
		                                      }
                                $width = imagesx($img_src);
                                $height = imagesy($img_src);
                                if($width>'1024' || $height>'768')
                                $this->resize_img($tempfile,'1024', $origfile);
                                else
                                $this->resize_img($tempfile, $width, $origfile);
                                
                            }
                            
							
							// Delete the temporary image
							unlink($tempfile);
						}
                //    }
 
                     // Image uploaded, return the file name
					 return $filename;   
		}
	}
	
	/*
	*	Deletes the image and its associated thumbnail
	*	Example in controller action:	$this->Image->delete_image("1210632285.jpg","sets");
	*
	*	Parameters:
	*	$filename: The file name of the image
	*	$folderName: the name of the parent folder of the images. The images will be stored to /webroot/img/$folderName/big/ and  /webroot/img/$folderName/small/
	*/
	function delete_image($filename,$folderName) {
 
		if(is_file("img/".$folderName."/big/".$filename))
        unlink("img/".$folderName."/big/".$filename);
        
        if(is_file("img/".$folderName."/small/".$filename))        
		unlink("img/".$folderName."/small/".$filename);
                
        if(is_file("img/".$folderName."/full/".$filename))
        unlink("img/".$folderName."/full/".$filename);
        
        
        
	}
	
    function crop_img($imgname, $scale, $filename) {	
		$filetype = $this->getFileExtension($imgname);
		$filetype = strtolower($filetype);
			  
		switch($filetype){
			case "jpeg":
			case "jpg":
			  $img_src = ImageCreateFromjpeg ($imgname);
			 break;
			 case "gif":
			  $img_src = imagecreatefromgif ($imgname);
			 break;
			 case "png":
			  $img_src = imagecreatefrompng ($imgname);
			 break;
		}
		
	    $width = imagesx($img_src);
	    $height = imagesy($img_src);
	    $ratiox = $width / $height * $scale;
	    $ratioy = $height / $width * $scale;
		 
	    //-- Calculate resampling
	    $newheight = ($width <= $height) ? $ratioy : $scale;
	    $newwidth = ($width <= $height) ? $scale : $ratiox;
		
	    //-- Calculate cropping (division by zero)
	    $cropx = ($newwidth - $scale != 0) ? ($newwidth - $scale) / 2 : 0;
	    $cropy = ($newheight - $scale != 0) ? ($newheight - $scale) / 2 : 0;
		
	    //-- Setup Resample & Crop buffers
	    $resampled = imagecreatetruecolor($newwidth, $newheight);
	    $cropped = imagecreatetruecolor($scale, $scale);
		
	    //-- Resample
	    imagecopyresampled($resampled, $img_src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	    //-- Crop
	    imagecopy($cropped, $resampled, 0, 0, $cropx, $cropy, $newwidth, $newheight);

		// Save the cropped image
		switch($filetype)
		{
			case "jpeg":
			case "jpg":
			 imagejpeg($cropped,$filename,100);
			 break;
			 case "gif":
			 imagegif($cropped,$filename,100);
			 break;
			 case "png":
			 imagepng($cropped,$filename);
			 break;
		}
    }
    
    	function resize_img_2($imgname, $size=1037, $filename,$height=270)	{
		$filetype = $this->getFileExtension($imgname);
		$filetype = strtolower($filetype);

		switch($filetype) {
			case "jpeg":
			case "jpg":
			$img_src = ImageCreateFromjpeg ($imgname);
			break;
			case "gif":
			$img_src = imagecreatefromgif ($imgname);
			break;
			case "png":
			$img_src = imagecreatefrompng ($imgname);
			break;
		}

		$true_width = imagesx($img_src);
		$true_height = imagesy($img_src);
        $width=$size;
     
		$img_des = ImageCreateTrueColor($width,$height);
		imagecopyresampled ($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

		// Save the resized image
		switch($filetype)
		{
			case "jpeg":
			case "jpg":
			 imagejpeg($img_des,$filename,100);
			 break;
			 case "gif":
			 imagegif($img_des,$filename,100);
			 break;
			 case "png":
			 imagepng($img_des,$filename);
			 break;
		}
	}
    
	
	function resize_img($imgname, $size, $filename)	{
		$filetype = $this->getFileExtension($imgname);
		$filetype = strtolower($filetype);

		switch($filetype) {
			case "jpeg":
			case "jpg":
			$img_src = ImageCreateFromjpeg ($imgname);
			break;
			case "gif":
			$img_src = imagecreatefromgif ($imgname);
			break;
			case "png":
			$img_src = imagecreatefrompng ($imgname);
			break;
		}

		$true_width = imagesx($img_src);
		$true_height = imagesy($img_src);

		if ($true_width>=$true_height)
		{
			$width=$size;
			$height = ($width/$true_width)*$true_height;
		}
		else
		{
			$width=$size;
			$height = ($width/$true_width)*$true_height;
		}
		$img_des = ImageCreateTrueColor($width,$height);
		imagecopyresampled ($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

		// Save the resized image
		switch($filetype)
		{
			case "jpeg":
			case "jpg":
			 imagejpeg($img_des,$filename,100);
			 break;
			 case "gif":
			 imagegif($img_des,$filename,100);
			 break;
			 case "png":
			 imagepng($img_des,$filename);
			 break;
		}
	}
    function opt_img($imgname, $size, $filename)	{
		$filetype = $this->getFileExtension($imgname);
		$filetype = strtolower($filetype);

		switch($filetype) {
			case "jpeg":
			case "jpg":
			$img_src = ImageCreateFromjpeg ($imgname);
			break;
			case "gif":
			$img_src = imagecreatefromgif ($imgname);
			break;
			case "png":
			$img_src = imagecreatefrompng ($imgname);
			break;
		}

		$true_width = imagesx($img_src);        
		$true_height = imagesy($img_src);
        if($true_width>'1024' || $true_height>'768')
        {
            
        }
        else
        $size=$true_width;                

		if ($true_width>=$true_height)
		{
			$width=$size;
			$height = ($width/$true_width)*$true_height;
		}
		else
		{
			$width=$size;
			$height = ($width/$true_width)*$true_height;
		}
		$img_des = ImageCreateTrueColor($width,$height);
		imagecopyresampled ($img_des, $img_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

		// Save the resized image
		switch($filetype)
		{
			case "jpeg":
			case "jpg":
			 imagejpeg($img_des,$filename,100);
			 break;
			 case "gif":
			 imagegif($img_des,$filename,100);
			 break;
			 case "png":
			 imagepng($img_des,$filename);
			 break;
		}
	}
    
    
    function getImgWidth($imgname,$filetype)
    {


		switch($filetype) {
			case "jpeg":
			case "jpg":
			$img_src = ImageCreateFromjpeg ($imgname);
			break;
			case "gif":
			$img_src = imagecreatefromgif ($imgname);
			break;
			case "png":
			$img_src = imagecreatefrompng ($imgname);
			break;
		}

		return imagesx($img_src);
    }
 
    function getFileExtension($str) {
 
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    
    function returnCorrectFunction($ext){
    $function = "";
    switch($ext){
        case "png":
            $function = "imagecreatefrompng"; 
            break;
        case "jpeg":
            $function = "imagecreatefromjpeg"; 
            break;
        case "jpg":
            $function = "imagecreatefromjpeg";  
            break;
        case "gif":
            $function = "imagecreatefromgif"; 
            break;
    }
    return $function;
}

function parseImage($ext,$img,$file = null){
    switch($ext){
        case "png":
            imagepng($img,($file != null ? $file : '')); 
            break;
        case "jpeg":
            imagejpeg($img,($file ? $file : ''),100); 
            break;
        case "jpg":
            imagejpeg($img,($file ? $file : ''),100);
            break;
        case "gif":
            imagegif($img,($file ? $file : ''));
            break;
    }
}

function setTransparency($imgSrc,$imgDest,$ext){
   
        if($ext == "png" || $ext == "gif"){
            $trnprt_indx = imagecolortransparent($imgSrc);
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                // Get the original image's transparent color's RGB values
                $trnprt_color    = imagecolorsforindex($imgSrc, $trnprt_indx);
                // Allocate the same color in the new image resource
                $trnprt_indx    = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($imgDest, 0, 0, $trnprt_indx);
                // Set the background color for new image to transparent
                imagecolortransparent($imgDest, $trnprt_indx);
            } 
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($ext == "png") {
               // Turn off transparency blending (temporarily)
               imagealphablending($imgDest, true);
               // Create a new transparent color for image
               $color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
               // Completely fill the background of the new image with allocated color.
               imagefill($imgDest, 0, 0, $color);
               // Restore transparency blending
               imagesavealpha($imgDest, true);
            }
            
        }
        }
        
        

    /**
     * ImageComponent::just_move()
     * solo guarda la imagen quitando caracteres extra�os no optimiza ni nada, solo para uso admin!!!
     * @param mixed $img ejm this->data["img"]
     * @param mixed $folderName
     * @return
     */
    function just_move($image_src,$tmp_forder,$to_folder,$uniq) {     
    
    $fileName=preg_replace('/[^a-zA-Z0-9]/',"",$uniq.$image_src);
//    echo $fi
        
    $ext=$this->getFileExtension($image_src);
    
    if(!is_dir($to_folder))
    mkdir($to_folder,0777,true);
    
    if(copy($tmp_forder.$image_src,$to_folder.$fileName.'.'.$ext))
      {
        unlink($tmp_forder.$image_src);//borrar la imagen del tmp
        return $fileName.'.'.$ext;
      }
      else
      {
        return "error.png";
      }
    
    }
    
        function justUpload($data,$folderName) {
        
  $fileName=preg_replace('/[^a-zA-Z0-9.]/',"",$data["name"]);
  
  $id=preg_replace('/[^a-z0-9]/',"",uniqid("",true));
  
  if(move_uploaded_file($data["tmp_name"],"img/$folderName".$id.$fileName))
  {
    return $id.$fileName;
  }
  else
  {
    return "error.png";
  }
    
}
    
    
} 

?>
