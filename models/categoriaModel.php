<?php 

class CategoriaModel extends AppModel{
    private static $nombre = "categorias";
    
    public function listarTodo(){
        $categorias=$this->_db->query("SELECT * FROM categorias");

        return $categorias->fetchall();
    }

    public function guardar($datos=array()){
        $consulta = $this->_db->prepare(
            "INSERT INTO categorias 
                (nombre)
                VALUES (:nombre)"
        );
        $consulta->bindParam(":nombre", $datos["nombre"]);

        if ($consulta->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function buscarPorId($id){
        $categoria = $this->_db->prepare(
            "SELECT * FROM categorias WHERE id=:id
        ");

        $categoria->bindParam(":id", $id);
        $categoria->execute();
        $registro = $categoria->fetch();

        if ($registro) {
            return $registro;
        } else {
            return false;
        } 
    }

    public function actualizar($datos){
        $consulta = $this->_db->prepare(
            "UPDATE categorias SET
                nombre=:nombre 
                WHERE id=:id
        ");
        $consulta->bindParam(":id", $datos["id"]);
        $consulta->bindParam(":nombre", $datos["nombre"]);

        if ($consulta->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function eliminarPorId($id){
        $consulta = $this->_db->prepare(
            "DELETE FROM categorias WHERE id=:id"
        );
        $consulta->bindParam(":id", $id);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

}