<?php
class categoriasController extends AppController

{

/**
 * [__construct description]
 */
    public function __construct(){

    parent::__construct();

    }
/**
 * [index description]
 * @return [type] [description]
 */
    public function index(){

    $categorias = $this->loadModel("categoria");

    $this->_view->categorias = $categorias->listarTodo();

    $this->_view->titulo = "Listado de categorias";

    $this->_view->renderizar("index");

    }
/**
 * [agregar description]
 * @return [type] [description]
 */
    public function agregar(){
        if ($_POST) {
            $categorias = $this->loadModel("categoria");
            if ($categorias->guardar($_POST)) {
                $this->_messages->success(
                    'Categoría guardada correctamente', 
                    $this->redirect(array("controller"=>"categorias"))
                );
            }
        } 

        $categorias=$this->loadModel("categoria");
        $this->_view->categorias=$categorias->listarTodo();
        
        $this->_view->titulo="Agregar categoría";
        $this->_view->renderizar("agregar");
    }
/**
 * [editar description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function editar($id=null){
        if ($_POST) {
            $categoria = $this->loadModel("categoria");
            if ($categoria->actualizar($_POST)) {
                $this->_messages->success(
                    'Categoría editada correctamente', 
                    $this->redirect(array("controller"=>"categorias", "action"=>"index"))
                );
            } else {
               $this->_view->flashMessage = "La categoría no se guardó";
               $this->redirect(array(
                    "controller"=>"categorias",
                    "action"=>"editar/".$id)
                );
            }

           $this->redirect(array("controller"=>"categorias"));
        }
     

        $categoria = $this->loadModel("categoria");
        $this->_view->categoria=$categoria->buscarPorId($id);


        $categorias=$this->loadModel("categoria");
        $this->_view->categorias=$categorias->listarTodo();

        $this->_view->titulo="Editar categoría";
        $this->_view->renderizar("editar");
    }
 /**
  * [eliminar description]
  * @param  [type] $id [description]
  * @return [type]     [description]
  */
    public function eliminar($id){
        $categoria = $this->loadModel("categoria");
        $registro = $categoria->buscarPorId($id);

        if (!empty($registro)) {
            $categoria->eliminarPorId($id);
            $this->_messages->success(
                    'Categoría eliminada correctamente', 
                    $this->redirect(array("controller"=>"categorias"))
                );
        }
    }
}