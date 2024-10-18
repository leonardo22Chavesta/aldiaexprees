<?php

    class Distrito extends Conexion {
        public function ListarDistrito($valor){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "select * from distrito;";

                $snt = $cn->prepare($sql);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['distrito'] = $snt->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $arr_response['mensaje_error'] = "No se encontró el Distritos";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  
            
            echo json_encode($arr_response);
        }
        public function RegistrarProducto(Distrito $distrito)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_registrar_distrito(:nombre)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre", $distrito->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function ActualizarProducto(Distrito $distrito)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_editar_distrito(:id_edit,:nombre_edit)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_edit", $distrito->id);
                $snt->bindParam(":nombre_edit", $distrito->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function BuscarDistrito($id){
            
            $arr_response = [];

            try {
                $cn = $this->Conectar();

                // Preparar la consulta
                $sql = "call sp_buscar_distrito(:id)";
                $snt = $cn->prepare($sql);

                // Asociar parámetro
                $snt->bindParam(":id", $id, PDO::PARAM_STR, 36);

                // Ejecutar la consulta
                $snt->execute();

                if ($snt->rowCount() > 0) {
                   
                    $arr_response['dsitrito'] = $snt->fetch(PDO::FETCH_OBJ);
                } else {
                   
                    $arr_response['mensaje_error'] = "No se encontró Distrito con el código '{$id}'.";
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

    