<?php
require('connection.php');


class Pager {

	public $idDoc;
	public $numPage;
	public $totalPages;

	function __construct($doc, $page)
	{
		$this->idDoc = $doc;
		$this->numPage = $page;
		$this->getTotaPages();
	}
		
	//tomar el total de paginas del documento
	function getTotaPages()
	{
		global $con;
		if ($con->connect_errno) {
	    	echo "Falló la conexión a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
		}
		//estraer los objetos json
		$result =$con->query("select count(id_imag_page) as count from pages where id_docs_page=".$this->idDoc);
		$row = $result->fetch_assoc();
		$this->totalPages=$row['count'];

	}

	//consultar los datos de la pagina a generar
	function getContentPages()
	{
		//Comprobar conexion
		global $con;
		if ($con->connect_errno) {
	    	echo "Falló la conexión a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
		}
		
		//estraer los objetos json
		$result =$con->query("select json_page, id_imag_page from pages where id_docs_page=".$this->idDoc." and num_page=".$this->numPage);
		$row = $result->fetch_assoc();
		//enviar datos para generar la pagina 	
		$this->doPage(json_decode($row['json_page']), $row['id_imag_page']);

	}

	//consultar los datos de la imagen asociada a la pigina
	function getImagePage($imgID)
	{
		global $con;
		//Comprobar conexion
		if ($con->connect_errno) {
	    	echo "Falló la conexión a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
		}
		//estraer los objetos json
		$result =$con->query("select json_imag from images where id_imag=".$imgID);
		$row = $result->fetch_assoc();
		return $this->renderImg(json_decode($row['json_imag']));
	}

	//genrar el contenido de la pagina
	function doPage($page,$idimg)
	{
		print '<div id="pageContent" >';
		print '<div class="left"  >';
		print $this->getImagePage($idimg);
		print '</div>';
		print '<div class="right">';

		foreach ($page->objects as $line => $value) {
			foreach ($page->objects[$line] as $key => $value) {
				print $this->renderElement($key,$page->objects[$line]->$key);
			}
		}
		print '</div>';	
		print '</div>';
	}

	//generar etiqueta para la imagen
	function renderImg($img)
	{
		$html=' <img src="'.$img->img->src.'" alt="'.$img->img->alt.'" height="'.$img->img->height.'" width="'.$img->img->height.'"> ';
		return $html;
	}

	//generar html de los elementos de la pagina
	function renderElement($class, $object)
	{
		
		switch ($class) {
			case 'text':
				$html= 	'<div class="'.$class.'Obj" style="position:absolute; top: '.$object->y.'; left: '.$object->x.
					'; font-family: '.$object->font.'; font-size: '.$object->size.'; font-weight: '.$object->style.
					'; width: '.$object->width.'px "> '.$object->label.' </div>';
				break;
			case 'radiobutton':
				$html= 	'<div class="radioObject" style="position:absolute; top: '.$object->y.'; left: '.$object->x.
					'; width: '.$object->width.'px; height: '.$object->height.';"> '.
					'<input id="itemRadio" type="radio" value="R-1-1" item="1" name="itemRadio">'.
					'<span>'.$object->label.'</span></div>';
				break;
			case 'checkbox':
				$html= 	'<div class="checkboxObject" style="position:absolute; top: '.$object->y.'; left: '.$object->x.
					'; width: '.$object->width.'px; height: '.$object->height.';"> '.
					'<input id="itemCheckbox" type="checkbox" value="R-1-1" item="1" name="itemCheckbox">'.
					'<span>'.$object->label.'</span></div>';
				break;
		}
		
		return $html;
	}
}
?>