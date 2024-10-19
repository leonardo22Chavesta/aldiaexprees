<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudcliente.php';

    $cliente = new Cliente();
    $cliente->ListarCliente('n');

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
    }