<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class IndexController extends AppController
{

	private function befor_filter()
	{

	}

    public function index()
    {
        $this->title = "KumbiaPHP está listo para usarse";
        $this->menu['inicio'] = "active";
    }

    public function login()
    {
    	View::template('bootstrap/bootstrapLogin');

        $this->navbar = NULL;
		$this->title = "Login de Sistema";

		if(Input::hasPost("usuario", "pass")):
			$user = Input::Post('usuario');
			$pass = Input::Post('pass');
			$pws  = md5($pass);
			$auth = new Auth("model", "class: usuarios", "usuario: $user", "pass: $pws");
			if($auth->authenticate()):
				Flash::valid("<strong>Bienvenido $user</strong>");
				Router::redirect("/");
			else:
				Flash::error("<strong>Atención, La información de usuario no coinside !!</strong>");
			endif;
		endif;
    }

    public function logout(){
        Auth::destroy_identity();
        Flash::info("loged-out");
        Router::redirect("/");
    }

}
