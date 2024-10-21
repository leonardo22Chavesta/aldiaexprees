<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudcliente.php';

    $cliente = new Cliente();
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['listar'])){
        
        $data = null;
        
        $accion = $_GET['listar'];
        $nombre = $_GET['nombre'];
        $fechaR = $_GET['fecha_registro'];
        
        if ($accion === 'buscar') {
            $data = $cliente->ListarCliente($nombre, $fechaR);
        }else{
            $data = $cliente->ListarCliente( $nombre, $fechaR);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion === 'registrar' || $accion === 'editar') {
            $nombre = $_POST['nombre'];
            $cliente = new Cliente();
            $cliente->nombre = $nombre;
    
            if ($accion === 'editar') {
                $cliente->id = $_POST['id']; 
                $cliente->ActualizarCliente($cliente);
            } else {
                $cliente->RegistrarCliente($cliente); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Distrito procesado correctamente.']);
            exit;
        }
        if($accion === 'delete'){
            $id = $_POST['id']; 
            $cliente->EliminarCliente($id); 
        }
    }