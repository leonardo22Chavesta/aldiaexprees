<?php 
    require_once '../../models/conexion.php';
    require_once '../../models/crudpedido.php';

    $pedidos = new Pedido();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listar'])){
        
        $data = null;
        
        $accion = $_POST['listar'];
        $fecha = $_POST['fecha'];
        $observaciones = $_POST['observaciones'];
        $distrito_id = $_POST['distrito_id'];
        $servicio_id = $_POST['servicio_id'];

        // Asignación correcta de propiedades del objeto Pedido
        $pedidos->observaciones = $observaciones;
        $pedidos->distrito_id = $distrito_id;
        $pedidos->servicio_id = $servicio_id;
        $pedidos->fechaRegistro = $fecha;  // Corregido

        if ($accion === 'buscar') {
            $data = $pedidos->ListarPedido($pedidos);
        } else {
            $data = $pedidos->ListarPedido($pedidos);
        }

        echo json_encode($data);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        
        if ($accion === 'registrar') {
            
            $distrito = $_POST['distrito_id'];
            $servicio = $_POST['servicio_id'];
            $medida = $_POST['medida_id'];
            $observacion = $_POST['obs'];
            $direccion = $_POST['direcc'];

            $pedido = new Pedido();
            
            $pedido->distrito_id = $distrito;
            $pedido->servicio_id = $servicio;
            $pedido->medida_id = $medida;
            $pedido->direccion = $observacion;
            $pedido->observaciones = $direccion;
    
           
            $pedidos->RegistrarPedido($pedido); 
           
    
            echo json_encode(['success' => true, 'message' => 'Paquete procesado correctamente.']);
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
        
        $accion = $_POST['enviar'];
        
        if ($accion === 'enviar') {
            
            $fechaEstimada = $_POST['fechaEstimada'];
            $fechaEnvio = $_POST['fechaEnvio'];
            $idPaquete = $_POST['idPaquete'];
           
            $pedidos->RealizarEnvio($fechaEnvio,$fechaEstimada,$idPaquete); 
           
    
            echo json_encode(['success' => true, 'message' => 'Paquete enviado correctamente.']);
            exit;
        }
    }