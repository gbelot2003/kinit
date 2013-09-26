<?php

/**
* @ Entradas
* Controlador de las clases de administracion de los articulos a publicar
* Class controller hereda de adminController
*
*/
Load::model('entradas');

class EntradasController extends adminController
{
	protected  function before_filter()
	{
		$this->siteTitle = "CRUD de Entradas";
		$this->title = $this->siteTitle;
	}

	public function index()
	{
		$this->title = "Articulos y Noticias";
		// Creaccion de tabla de contenido
		$this->rows = Load::model('entradas')->listado();
	}

	public function create()
	{
		$this->title = "Nueva Entrada";
		$this->userid = Auth::get('id');
		if(Input::hasPost('entradas'))
		{
			$this->entradas = new entradas(Input::post('entradas'));
			if($this->entradas->save()){
				Flash::valid('!! Nueva entrada creada... ¡¡');
				return Router::redirect();
			}
		}
	}

	public function edit($id)
	{
		if(isset($id)):
			$this->id = (int) $id;
		endif;

		if(Input::hasPost('entradas')):

		endif;

		$this->entrada = Load::model("entradas")->find_by_id($this->id);
		$this->title = $this->entrada->titulo;
	}

	public function delete($id)
	{

	}

	public function callBack($id)
	{

	}

}