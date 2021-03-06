<?php

$dir = dirname ( __FILE__ );
//echo $dir . "<br>";
$folders = scandir ( $dir );

foreach ( $folders as $categorias ) {
	//echo $categorias . "<br>";
	if ($categorias != "." && $categorias != ".." && $categorias != "index.php") {
		$cat = $dir . "/" . $categorias;
		// echo $cat;
		$list = scandir ( $cat );
		foreach ( $list as $carpeta ) {
			if ($carpeta != "." && $carpeta != ".." && $carpeta != "index.php") {
				// echo $carpeta;
				echo $dir . "/" . $categorias."/".$carpeta."<br/>";
				$images = scandir ( $dir . "/" . $categorias . "/" . $carpeta );
				
				//create thumbs
				createThumbs ( $dir . "/" . $categorias . "/" . $carpeta . "", $dir . "/" . $categorias . "/" . $carpeta . "/thumbs", 75 );
				//reducir
				resize_image ( $dir . "/" . $categorias . "/" . $carpeta . "", $dir . "/" . $categorias . "/" . $carpeta . "" , 650);
				
				echo "se crearon los archivos.<br/>";
			}
		}
	}
}
function createThumbs($pathToImages, $pathToThumbs, $thumbWidth) {
	// open the directory
	$dir = opendir ( $pathToImages );
	
	if (! is_dir ( $pathToThumbs )) {
		
		//echo "se creo $pathToThumbs<br/>";
		if (! mkdir ( $pathToThumbs, 0777, true )) {
			die ( 'Failed to create folders...' );
		}
		//echo "se creo $pathToThumbs<br/>";
	}
	
	// loop through it, looking for any/all JPG files:
	while ( false !== ($fname = readdir ( $dir )) ) {
		// parse path for the extension
		$info = pathinfo ( $pathToImages . $fname );
		// continue only if this is a JPEG image
		if (strtolower ( $info ['extension'] ) == 'jpg') {
			// load image and get image size
			$img = imagecreatefromjpeg ( "{$pathToImages}" . "/" . "{$fname}" );
			$width = imagesx ( $img );
			$height = imagesy ( $img );
			
			// tamaño del del slide
			$hdflt = 400;
			$wdflt = 650;
			{
				// calculate thumbnail size
				$new_width = $thumbWidth;
				$new_height = $thumbWidth;
			}
			
			// create a new temporary image
			$tmp_img = imagecreatetruecolor ( $new_width, $new_height );
			
			// copy and resize old image into new image
			imagecopyresized ( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			
			// save thumbnail into a file
			imagejpeg ( $tmp_img, "{$pathToThumbs}" . "/" . "{$fname}" );
			
			//echo "$pathToThumbs" . "/" . "$fname<br/>";
		}
	}
	// close the directory
	closedir ( $dir );
}



function resize_image( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      //echo "Se redujo la imagen  {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}"."/"."{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}"."/"."{$fname}" );
      
      //echo "$pathToThumbs" . "/" . "$fname<br/>";
    }
  }
  // close the directory
  closedir( $dir );
}






?>