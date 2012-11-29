<?php
$dir = dirname ( __FILE__ );
// echo $dir."/_images/portfolio/".$_REQUEST['trend'];
$imagenes = scandir ( $dir . "/_images/portfolio/" . $_REQUEST ['trend'] );
?>

<div class="span11">

	<div class="camera_wrap camera_magenta_skin "
		id="camera_<?=$_REQUEST['trend']?>">
<?php
foreach ( $imagenes as $imagen ) {
	if ($imagen != "thumb.jpg" && $imagen != "thumbs" && $imagen != "." && $imagen != "..") {
		?>
	<div
			data-thumb="_images/portfolio/<?=$_REQUEST['trend']."/thumbs/".$imagen;?>"
			data-src="_images/portfolio/<?=$_REQUEST['trend']."/".$imagen;?>">
			<?php 
				$imagen = substr($imagen, 0, -4);
				$name = explode("@",$imagen);
			?>
			<div class="camera_caption fadeFromBottom"><?=$name[1]?>, <?=$name[2]?></div>
		</div>
	
	<?php
	}
	// echo $imagen."<br/>";
}
?>
	</div>
	<!-- #camera_wrap_2 -->
</div>

