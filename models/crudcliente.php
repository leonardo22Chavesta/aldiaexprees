<?php

    class Cliente extends Conexion {
        public function ListarCliente($valor){
            
            $arr_response = [];
            
            try {
                $cn = $this->Conectar();
                
                $sql = "select * from cliente;";

                $snt = $cn->prepare($sql);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['cliente'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                } else {
                    $arr_response['mensaje_error'] = "No se encontró el Cliente solicitado.";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  
            
            echo json_encode($arr_response);
        }
        public function RegistrarCliente(Cliente $cliente)
        {

            try {
                $cn = $this->Conectar();

                $sql = "call sp_registrar_cliente(:nombre)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":nombre", $cliente->nombre);//nombre es de la base de datos
                
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

                $sql = "call sp_editar_cliente(:id_edit,:nombre_edit)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":id_edit", $cliente->id);
                $snt->bindParam(":nombre_edit", $cliente->nombre);
                
                $snt->execute();

                $cn = null;
            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function BuscarCliente($id){
            
            $arr_response = [];

            try {
                $cn = $this->Conectar();

                // Preparar la consulta
                $sql = "call sp_buscar_cliente(:id)";
                $snt = $cn->prepare($sql);

                // Asociar parámetro
                $snt->bindParam(":id", $id, PDO::PARAM_STR, 36);

                // Ejecutar la consulta
                $snt->execute();

                if ($snt->rowCount() > 0) {
                   
                    $arr_response['cliente'] = $snt->fetch(PDO::FETCH_OBJ);
                } else {
                   
                    $arr_response['mensaje_error'] = "No se encontró el Cliente con el código '{$id}'.";
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

    