<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudestado.php';

    $estado = new Estado();
    $estado->ListarEstado('n');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion === 'registrar' || $accion === 'editar') {
            $nombre = $_POST['nombre'];
            $estado = new Estado();
            $estado->nombre = $nombre;
    
            if ($accion === 'editar') {
                $estado->id = $_POST['id']; 
                $estado->ActualizarEstado($estado);
            } else {
                $estado->RegistrarEstado($estado); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Estado procesado correctamente.']);
            exit;
        }
    }