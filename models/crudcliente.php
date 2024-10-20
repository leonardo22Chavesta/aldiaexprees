<?php

    class Cliente extends Conexion {
        public function ListarCliente($nombre, $fechaR){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "call sp_buscar_cliente(:p_nombre,:fecha)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":p_nombre", $nombre);
                $snt->bindParam(":fecha", $fechaR);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['cliente'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                } else {
                    $arr_response['mensaje_error'] = "No se encontró el Cliente solicitado.";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  
            return $arr_response;
        }
        public function RegistrarCliente(Cliente $cliente)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_registrar_cliente(:nombre_registrar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre_registrar", $cliente->nombre);//nombre es de la base de datos
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function ActualizarCliente(Cliente $cliente)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_editar_cliente(:nombre_editar,:id_buscar)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_buscar", $cliente->id);
                $snt->bindParam(":nombre_editar", $cliente->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function EliminarCliente($id){
            try {
                $cn = $this->Conectar();

                $sql = "call sp_eliminar_cliente(:id_)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_", $id);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
      
    }

    