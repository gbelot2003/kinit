<?php

Load::models('productos', 'facturas');
Load::lib("json/JSON");
class FacturasController extends AppController
{
	protected  function before_filter()
	{
		$this->siteTitle = "Ejemplo de Facturas"; // title y h2 de la pagina en cualquier caso
		$this->title = $this->siteTitle; 
		$this->menu['facturas'] = "active"; // Controlamos clase de menu.active
	}

	public function index()
	{

	}

	public function callback($id)
	{
			$this->id = (int) $id;
			$this->productos = Load::model('productos')->find_by_id($id);
				
	}

}