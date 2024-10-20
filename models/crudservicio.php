<?php

    class Servicio extends Conexion {
        public function ListarServicio($nombre, $fechaR){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "call sp_buscar_servicio(:p_nombre,:fecha)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":p_nombre", $nombre);
                $snt->bindParam(":fecha", $fechaR);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['servicio'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                } else {
                    $arr_response['mensaje_error'] = "No se encontró el Distritos";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  
            
            echo json_encode($arr_response);
        }
        public function RegistrarServicio(Servicio $servicio)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_registrar_servicio(:nombre_registrar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre_registrar", $servicio->nombre);//nombre es de la base de datos
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function ActualizarServicio(Servicio $servicio)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_editar_service(:nombre_editar,:id_buscar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_buscar", $servicio->id);
                $snt->bindParam(":nombre_editar", $servicio->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function EliminarServicio($id){
            try {
                $cn = $this->Conectar();

                $sql = "call sp_eliminar_servicio(:id_)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_", $id);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }
