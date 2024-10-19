<?php

class Medida extends Conexion {
    public function ListarMedida($valor){
            
        $arr_response = [];
        
        try {
            $cn = $this->Conectar();
            
            $sql = "select * from medida;";

            $snt = $cn->prepare($sql);

            $snt->execute();

            if ($snt->rowCount() > 0) {
                $arr_response['medida'] = $snt->fetchAll(PDO::FETCH_OBJ);
            } else {
                $arr_response['mensaje_error'] = "No se encontró la medida";
            }

        } catch (PDOException $e) {
            $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
        }  
        
        echo json_encode($arr_response);
    }

    

    public function RegistrarMedida(General $medida)
    {

        try {
            $cn = $this->Conectar();

            $sql = "call sp_registrar_medida(:nombre)";

            $snt = $cn->prepare($sql);

            $snt->bindParam(":nombre", $medida->nombre);
            
            $snt->execute();

            $cn = null;
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function ActualizarMedida(General $medida)
    {

        try {
            $cn = $this->Conectar();

            $sql = "call sp_editar_medida(:id_edit,:nombre_edit)";

            $snt = $cn->prepare($sql);

            $snt->bindParam(":id_edit", $medida->id);
            $snt->bindParam(":nombre_edit", $medida->nombre);
            
            $snt->execute();

            $cn = null;
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }


}