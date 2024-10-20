<?php

    class Distrito extends Conexion {
        public function ListarDistrito($nombre, $fechaR){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "call sp_buscar_distrito(:p_nombre,:fecha)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":p_nombre", $nombre);
                $snt->bindParam(":fecha", $fechaR);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['distrito'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                } else {
                    $arr_response['mensaje_error'] = "No se encontró el Distritos";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  
            
            return $arr_response;

            
        }
        public function RegistrarDistrito(Distrito $distrito)
        {
            try {
                
                $cn = $this->Conectar();

                $sql = "call sp_registrar_distrito(:nombre)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre", $distrito->nombre);//nombre es de la base de datos
                
                $snt->execute();

                $cn = null;

            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function ActualizarDistrito(Distrito $distrito)
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
        public function EliminarDistrito($id){
            try {
                $cn = $this->Conectar();

                $sql = "call sp_eliminar_distrito(:id_)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_", $id);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    