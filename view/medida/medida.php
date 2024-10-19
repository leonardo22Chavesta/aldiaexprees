<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudmedida.php';

    $medida = new Medida();
    $medida->ListarMedida('n');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion === 'registrar' || $accion === 'editar') {
            $nombre = $_POST['nombre'];
            $medida = new Medida();
            $medida->nombre = $nombre;
    
            if ($accion === 'editar') {
                $medida->id = $_POST['id']; 
                $medida->ActualizarMedida($medida);
            } else {
                $medida->RegistrarMedida($medida); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Estado procesado correctamente.']);
            exit;
        }
    }