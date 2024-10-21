<?php
    class Pedido extends Conexion {

        public function ListarPedido(Pedido $pedido){
            
            $arr_response = [];
            
            try {

                $cn = $this->Conectar();
                
                $sql = "call sp_buscar_pedido(:p_nombre,:id_distrito,:id_servicio,:fecha)";

                $snt = $cn->prepare(query: $sql);

                $snt->bindParam(":p_nombre", $pedido->observaciones);
                $snt->bindParam(":id_distrito",$pedido->distrito_id);
                $snt->bindParam(":id_servicio",var: $pedido->servicio_id);
                $snt->bindParam(":fecha",$pedido->fechaRegistro);

                $snt->execute();

                if ($snt->rowCount() > 0) {
                    $arr_response['pedido'] = $snt->fetchAll(PDO::FETCH_OBJ);//tabla registro
                } else {
                    $arr_response['mensaje_error'] = "No se encontro el pedidos por la variable.";
                }

            } catch (PDOException $e) {
                $arr_response['mensaje_error'] = "Error en la consulta: " . $e->getMessage();
            }  

            return $arr_response;
        }

        public function RegistrarPedido(Pedido $pedido){
            try {
                
                $cn = $this->Conectar();

                $sql = "call sp_registrar_paquete(:direccion_,:observaciones_,:distritoid_,:servicioid_,:medidaid_)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":direccion_", $pedido->direccion);//nombre es de la base de datos
                $snt->bindParam(":observaciones_", $pedido->observaciones);//nombre es de la base de datos
                $snt->bindParam(":distritoid_", $pedido->distrito_id);//nombre es de la base de datos
                $snt->bindParam(":servicioid_", $pedido->servicio_id);//nombre es de la base de datos
                $snt->bindParam(":medidaid_", $pedido->medida_id);//nombre es de la base de datos
                
                $snt->execute();

                $cn = null;

            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function RealizarEnvio($fecha_envio,$fecha_estimada,$paquete_id){
            try {
                
                $cn = $this->Conectar();

                $sql = "call sp_enviar_paquete(:fecha_envio_,:fecha_estimada_,:id_paquete)";

                $snt = $cn->prepare($sql);

                $snt->bindParam(":fecha_envio_", $fecha_envio);
                $snt->bindParam(":fecha_estimada_", $fecha_estimada);
                $snt->bindParam(":id_paquete", $paquete_id);
                
                $snt->execute();

                $cn = null;

            }catch (PDOException $e) {
                die($e->getMessage());
            }
        }


    }







    