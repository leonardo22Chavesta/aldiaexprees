<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudservicio.php';

    $servicio = new Servicio();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listar'])){
        $accion = $_POST['listar'];
        $nombre = $_POST['nombre'];
        $fechaR = $_POST['fecha_registro'];
        if ($accion === 'buscar') {
            $servicio->ListarServicio($nombre, $fechaR);
        }else{
            $servicio->ListarServicio( $nombre, $fechaR);
        }
    }
    
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
                $servicio->RegistrarServicio($servicio); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Servicio procesado correctamente.']);
            exit;
        }

        if($accion === 'delete'){
            $id = $_POST['id']; 
            $servicio->EliminarServicio($id); 
        }
    }