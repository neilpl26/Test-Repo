<?php 
function base64_encode_image ($filename=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . substr($filename,(strrpos($filename, '.'))+1) . ';base64,' . base64_encode($imgbinary);
    }
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>My Base64 Converter</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- CSS Links
  ================================================== -->
	<link href="css/reset.css" type="text/css"  rel="stylesheet"/><!-- carga reset css -->
	<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"><!-- carga bootstrap 3 -->
	<link href="css/custom.css" type="text/css"  rel="stylesheet"/><!-- carga css peronalizado -->
		
	<!-- JavaScript Files
  ================================================== -->
	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script> <!-- carga jQuery -->
	<script src="js/bootstrap.min.js" type="text/javascript"></script> <!-- carga jQuery -->
</head>
<body>	
	<div class="center">
		<form enctype="multipart/form-data" action="index.php" method="POST">
		
			<div class="row show-grid">
				<div class="col-md-2"></div>
				<div class="texto_centrado col-md-8">
					<img src="images/logo.png">
				</div>
				<div class="col-md-2"></div>
			</div>
			
			<div class="row show-grid">
				<div class="col-md-2"></div>
				<div class="texto_centrado col-md-8">	
					<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
					<input onchange="copiaRuta()" id="userfile" name="userfile" type="file" />
					<div class="form-group">
						<input onclick="getDir()" class="form-control" id="fakefile" name="fakefile" type="text" placeholder="Seleccione el fichero"/>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
			
			<div class="row show-grid">
				<div class="col-md-4"></div>
				<div class="texto_centrado col-md-4">
					<a class="btn btn-default">Acerca de ...</a>
					<button type="submit" class="btn btn-default">Convertir</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
		<div>
				<?php
		if(isset($_FILES['userfile'])){
			$uploaddir = 'uploads\\';
			$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				echo base64_encode_image($uploadfile);
			} else {
				echo "Error";
			}
		}
		?>
		</div>
    </div>
	
<script type="text/javascript">
	function getDir(){
		$('#userfile').click();
	}
	
	function copiaRuta(){
		document.getElementById('fakefile').value = document.getElementById('userfile').value
		$('#userfile').addClass('')
	}
</script>

	
</body>
</html>
