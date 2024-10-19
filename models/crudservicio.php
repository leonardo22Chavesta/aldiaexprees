<?php

    class Servicio extends Conexion {
        public function ListarServicio($valor){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "select * from servicio;";

                $snt = $cn->prepare($sql);

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

                $sql = "call sp_registrar_servicio(:nombre)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre", $servicio->nombre);//nombre es de la base de datos
                
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

                $sql = "call sp_editar_servicio(:id_edit,:nombre_edit)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_edit", $servicio->id);
                $snt->bindParam(":nombre_edit", $servicio->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function BuscarServicio($id){
            
            $arr_response = [];

            try {
                $cn = $this->Conectar();

                // Preparar la consulta
                $sql = "call sp_buscar_servicio(:id)";
                $snt = $cn->prepare($sql);

                // Asociar parámetro
                $snt->bindParam(":id", $id, PDO::PARAM_STR, 36);

                // Ejecutar la consulta
                $snt->execute();

                if ($snt->rowCount() > 0) {
                   
                    $arr_response['servicio'] = $snt->fetch(PDO::FETCH_OBJ);
                } else {
                   
                    $arr_response['mensaje_error'] = "No se encontró el Servicio solicitado con el código '{$id}'.";
                }
            } catch (PDOException $e) {
                
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();

            } finally {
                $cn = null; 
            }

            // Enviar la respuesta JSON al cliente
            echo json_encode($arr_response);
        }
    }
