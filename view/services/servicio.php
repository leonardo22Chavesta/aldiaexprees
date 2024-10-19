<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudservicio.php';

    $servicio = new Servicio();
    $servicio->ListarServicio('n');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion === 'registrar' || $accion === 'editar') {
            $nombre = $_POST['nombre'];
            $servicio = new Servicio();
            $servicio->nombre = $nombre;
    
            if ($accion === 'editar') {
                $servicio->id = $_POST['id']; 
                $servicio->ActualizarServicio($servicio);
            } else {
                $servicio->RegistrarServicio($$servicio); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Servicio procesado correctamente.']);
            exit;
        }
    }