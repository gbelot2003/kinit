<?php
/**
 * Controlador Archivos
 * 
 * @category App
 * @package Controllersç
 *
 */

Load::model("imagenes");
Load::lib("json/JSON");
class ArchivosController extends AppController
{
	public $limit_params = FALSE;
	public function upload()
	{
		$this->menu['upload'] = "active";	
        //$this->img = Load::model("imagenes")->find("order: id desc");
	}
	
	public function tableCallBack(){
		$this->img = Load::model("imagenes")->find("order: id desc");
	}

	public function datos()
	{
        if (Input::hasPost('oculto')) {  //para saber si se envió el form
            $archivo = Upload::factory('archivo', 'image');//llamamos a la libreria y le pasamos el nombre del campo file del formulario
            $archivo->setExtensions(array('jpg', 'png', 'gif', 'tif')); //le asignamos las extensiones a permitir
            if ($archivo->isUploaded()) { 
                if ($archivo->save()) {

                    $nombre = $_FILES['archivo']['name'];
					
                    $path = PUBLIC_PATH ."img/upload/". $nombre;

                    $img = new imagenes();
                    $img->titulo = $nombre;
                    $img->url = $path;
                    if($img->save()):
                        Flash::valid('El archivo <strong>"'. $nombre .'"</strong> se ha subido correctamente...!!!');
                        $this->img = Load::model("imagenes")->find_by_id($img->id);
                    endif;
                }
            }else{
                    Flash::warning('No se ha Podido Subir el Archivo...!!!');
                    //Router::redirect("archivos/upload");
            }
        }		
	}

    public function delDatos($id = NULL){
        
        if(!isset($id)):
			Router::redirect("/upload");
		endif;

		$this->id = (int) $id;
	
        if(isset($this->id)):
            $img = Load::model("imagenes")->find_by_id($this->id);
            $nombre = $img->titulo;
            $path = "C:\\xampp\htdocs\kinit\default\public\img\upload\\". $nombre;

            if ($img->delete()):
                unlink($path);
                Flash::notice('El archivo eliminado <strong>"'. $nombre .'"</strong> se ha <strong>borrado</strong> correctamente...!!!');
                Router::redirect("/upload");
            endif;
        else:
            Flash::error('La direccion dada no es correcta');
            Router::redirect("/upload");
        endif;
    }
}
