<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{

    final protected function initialize()
    {
    	View::template('bootstrap/bootstrapLayerMain');
    	$this->siteTitle = "Kinit 0.1";
    	$this->title = NULL;
    }

    final protected function finalize()
    {
		if (Input::isAjax()) {
		  View::template(NULL);
		}
    }

}
