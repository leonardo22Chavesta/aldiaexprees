<?php

    class Medida extends Conexion {
        public function ListarMedida($nombre, $fechaR){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "call sp_buscar_medida(:p_nombre,:fecha)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":p_nombre", $nombre);
                $snt->bindParam(":fecha", $fechaR);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    
                    $arr_response['medida'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                
                } else {
                    $arr_response['mensaje_error'] = "No se encontró medidas solicitado.";
                }

            } catch (PDOException $e) {
                
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            
            }

            return $arr_response;
        }
        public function MedidaXid($id){
            
            $response = null;
            
            try {
                $cn = $this->Conectar();
                
                $sql = "call sp_buscarid_medida(:id_)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":id_", $id);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    
                    $response = $snt->fetch(PDO::FETCH_OBJ);
                
                } else {
                    $response['mensaje_error'] = "No se encontró Medida solicitado.";
                }

            } catch (PDOException $e) {
                
                $response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            
            }

            return $response;
        }   
        public function RegistrarMedida(Medida $medida)
        {
            $response = null;

            try {
                $cn = $this->Conectar();

                $sql = "call sp_registrar_medida(:nombre_registrar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre_registrar", $medida->nombre);//nombre es de la base de datos
                
                $snt->execute();

                $response = $snt->fetch(PDO::FETCH_OBJ);

                $cn = null;
            }catch (PDOException $e) {

                die($e->getMessage());
            
            }

            return $response;
        }

        public function ActualizarMedida(Medida $medida)
        {
            $response = null;

            try {
                $cn = $this->Conectar();

                $sql = "call sp_editar_medida(:nombre_editar,:id_buscar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_buscar", $medida->id);
                $snt->bindParam(":nombre_editar", $medida->nombre);
                
                $snt->execute();

                $response = $snt->fetch(PDO::FETCH_OBJ);

                $cn = null;

            }catch (PDOException $e) {

                die($e->getMessage());

            }

            return $response;
        }

        public function EliminarMedida($id){
            try {
                $cn = $this->Conectar();

                $sql = "call sp_eliminar_medida(:id_)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_", $id);
                
                $snt->execute();

                $cn = null;

            }catch (PDOException $e) {

                die($e->getMessage());

            }
        }
      
    }