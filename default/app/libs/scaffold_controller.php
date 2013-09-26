<?php

/**
 * Controlador base para la construcción de CRUD para modelos rapidamente
 *
 * @category Kumbia
 * @package Controller
 */
class ScaffoldController extends AdminController
{

    public $scaffold = 'bootstrap';
    public $model;


    protected function before_filter()
    {
        $this->siteTitle = $this->model . ":" . $this->action_name;
        $this->title = $this->siteTitle;
        if (Input::isAjax()) {
          View::template(NULL);
        }
    }

    public function index($page=1)
    {
        $this->results = Load::model($this->model)->paginate("page: $page", 'order: id desc');
    }

    /**
     * Crea un Registro
     */
    public function crear()
    {
        if (Input::hasPost($this->model)) {

            $obj = Load::model($this->model);
            //En caso que falle la operación de guardar
            if (!$obj->save(Input::post($this->model))) {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->{$this->model} = $obj;
                return Redirect::to();
                return;
            }
            Flash::valid("El registro se a salvado correctamente");
            return Redirect::to();
        }
        // Solo es necesario para el autoForm
        $this->{$this->model} = Load::model($this->model);
    }

    /**
     * Edita un Registro
     */
    public function editar($id)
    {

        View::select('crear');

        //se verifica si se ha enviado via POST los datos
        if (Input::hasPost($this->model)) {
            $obj = Load::model($this->model);
            if (!$obj->update(Input::post($this->model))) {
                Flash::error('Falló Operación');
                //se hacen persistente los datos en el formulario
                $this->{$this->model} = Input::post($this->model);
                return Redirect::to();
            } else {
                Flash::valid("El registro se a actualizado correctamente");
                return Redirect::to();
            }
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->{$this->model} = Load::model($this->model)->find((int) $id);
    }

    /**
     * Borra un Registro
     */
    public function borrar($id)
    {
        if (!Load::model($this->model)->delete((int) $id)) {
            Flash::error('Falló Operación');
        }
        //enrutando al index para listar los articulos
        Flash::valid("El registro se a eliminado correctamente");
        Redirect::to();
    }

    /**
     * Ver un Registro
     */
    public function ver($id)
    {
        $this->result = Load::model($this->model)->find_first((int) $id);
    }

}