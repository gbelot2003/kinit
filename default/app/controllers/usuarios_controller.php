<?php
/**
 * Controlador Usuarios
 * 
 * @category App
 * @package Controllers
 */

Load::model('usuarios');
class UsuariosController extends adminController
{
 	protected function before_filter()
	{
		$this->menu['config'] = "active";
		$this->rols = array
		(
			// Aqui los roles detallados en privilegios.ini
			"administrador" => "administrador",
			"editor" => "editor",
		);
	}

	public function index($page=1)
	{
		$this->siteTitle = "Control de Usuarios";
		$this->title = $this->siteTitle;
		$usuarios = new usuarios();
		$this->listUsuarios = $usuarios->getUsuarios($page);
	}

	public function crear()
	{
		$this->title = "Crear Usuario";

		if(Input::hasPost('usuarios')):
			$this->raw = Input::post('usuarios');
			if($this->raw['pass1'] != $this->raw['pass2']):
				Flash::error("los pass no coinciden");
				return Router::redirect();
			else:
				$this->raw['pass'] = $this->raw['pass1'];
			endif;
			
			$this->usuarios = new usuarios($this->raw);

				if($this->usuarios->save()):
					Flash::valid('La información se a guardado correctamente !!');
					return Router::redirect();
				else:
					Flash::error('Ha sucedido un error en al introducción de los datos');
					return Router::redirect();
				endif;
		endif;
	}

	public function editar($id)
	{
		$this->id = (int) $id;
		$users = Load::model('usuarios')->find_by_id($this->id);
		$this->title = $users->usuario;
	
		if(Input::post('usuarios')):
			$this->raw = Input::post('usuarios');
			if($this->raw['pass1'] != ""):
				if(md5($this->raw['pass1']) != $users->pass):
					Flash::error('La contraseña original no coinciden');
					return Router::redirect();
				else:
					if($this->raw['pass2'] != $this->raw['pass3']):
						Flash::error("Las contraseñas nuevas no son iguales");
						return Router::redirect();
					else:
						// Just add the pass to $raw variable
						$this->raw['pass'] = md5($this->raw['pass2']);
						Flash::valid('La contraseña fue cambiada exitosamente');
					endif;
				endif;
			else:
				$this->raw['pass'] = $users->pass;
			endif;

			$this->usuarios = new usuarios($this->raw);

			if($this->usuarios->update()):
				Flash::valid('La información se a guardado correctamente !!');
				return Router::redirect();
			else:
				Flash::error('Ha sucedido un error en al introducción de los datos');
				return Router::redirect();
			endif;
		else:
			$this->usuarios = Load::model("usuarios")->find_by_id($this->id);
		endif;

	}

	public function borrar($id)
	{
		$this->id = (int) $id;
		$this->usuarios = new usuarios();
		if($this->usuarios->delete($this->id))
		{
			Flash::valid("El registro a sido eliminado exitosamente");
			return Router::redirect();

		} else 
		{
			Flash::error("Ocurrio un error en el proceso de borrado, el registro no se ha eliminado");
			return Router::redirect();
		}

	}
}
