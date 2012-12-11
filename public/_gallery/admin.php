<?php
$dir = dirname ( __FILE__ );

// echo $dir;

$lista = scandir ( $dir );

// echo $dir_clientes = "TEC/Centros";
// echo $dir ."/_images/logos_clientes"."<br>";
// $lista_clientes = scandir ( $dir_clientes );

foreach ( $lista as $categoria ) {
	
	if (! ($categoria == "." || $categoria == ".." || $categoria == "uploaded_files" || $categoria == "admin.php" || $categoria == "index.php" || $categoria == "upload.processor.php")) {
		$lista_clientes = scandir ( $categoria );
		// echo $categoria . "<br/>";
		
		// echo '<div style="border:solid 1px #000;width:800px;">';
		echo '<table style="border:solid 1px #000;width:800px;background:#987;"><tr><td>Carpeta: <b>' . $categoria . "</b></td></tr></table>";
		
		foreach ( $lista_clientes as $galeria ) {
			
			if (! ($galeria == "." || $galeria == "..")) {
				
				$galeria_path = $dir . "/" . $categoria . "/" . $galeria;
				
				$lista_imagenes = scandir ( $galeria_path );
				
				$i = 0;
				echo '<table style="border:solid 1px #000;">';
				echo "<tr> Galeria : $galeria </tr>";
				
				foreach ( $lista_imagenes as $imagen ) {
					if (! ($imagen == "." || $imagen == ".." || $imagen == "thumbs")) {
						// echo $imagen . "<br/>";
						
						// echo $imagen . "<br/>";
						// $dir_clientes = $galeria . "/" . $imagen; // echo
						// echo $dir_clientes."<br>";
						
						if ($i % 6 == 0) {
							echo "<tr>";
						}
						echo '<td><img src="' . $categoria . "/" . $galeria . '/' . $imagen . '"  style="max-height:60px; max-width:130px;" /></td>';
						$i ++;
					}
				}
				
				if($i==0){
					echo "<tr><td>Galeria vacia</td></tr>";
				}
				
			}
		}
		
		// echo "</div>";
	}
}

?>