<?php

class Estado extends Conexion{
    public function ListarEstado($valor){
            
        $arr_response = [];
        
        try {
            $cn = $this->Conectar();
            
            $sql = "select * from estado;";

            $snt = $cn->prepare($sql);

            $snt->execute();

            if ($snt->rowCount() > 0) {
                $arr_response['estado'] = $snt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $arr_response['mensaje_error'] = "No se encontró el estado";
            }

        } catch (PDOException $e) {
            $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
        }  
        
        echo json_encode($arr_response);
    }



    public function RegistrarEstado(General $estado)
    {

        try {
            $cn = $this->Conectar();

            $sql = "call sp_registrar_estado(:nombre)";

            $snt = $cn->prepare($sql);

            $snt->bindParam(":nombre", $estado->nombre);
            
            $snt->execute();

            $cn = null;
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function ActualizarEstado(General $estado)
    {

        try {
            $cn = $this->Conectar();

            $sql = "call sp_editar_estado(:id_edit,:nombre_edit)";

            $snt = $cn->prepare($sql);

            $snt->bindParam(":id_edit", $estado->id);
            $snt->bindParam(":nombre_edit", $estado->nombre);
            
            $snt->execute();

            $cn = null;
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }


}