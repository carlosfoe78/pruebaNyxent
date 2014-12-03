<?php
include ('lib/pager.php');

//obneren la pagina a generar
$numpage = isset($_POST['page']) && $_POST['page']>1 ? $_POST['page'] : 1; 
//instancia de la clase Pager
$page = new Pager (1,$numpage);
?>

<html lang="es">
<head>
	<meta charset="utf-8"/>
	<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<title></title>
</head>
<body>
	<div id="header">
		<label >Pagina <?php print $numpage; ?> de <?php print $page->totalPages;?></label><br />
		<input type="hidden" id="numpage" value="<?php print $numpage; ?>">
		<input type="hidden" id="tpage" value="<?php print $page->totalPages; ?>">
		<input type="submit" value="Back" id="back">
		<input type="submit" value="Next" id="next">

	</div>
	<?php
	//llamado a lafuncion que genera los doatos
	$page->getContentPages();
	?>
</body>
</html>