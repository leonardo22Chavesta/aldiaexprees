<?php
    require_once '../../models/conexion.php';
    require_once '../../models/cruddistrito.php';

    $distrito = new Distrito();
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listar'])){
        $accion = $_POST['listar'];
        $nombre = $_POST['nombre'];
        $fechaR = $_POST['fecha_registro'];
        if ($accion === 'buscar') {
            $distrito->ListarDistrito($nombre, $fechaR);
        }else{
            $distrito->ListarDistrito( $nombre, $fechaR);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion === 'registrar' || $accion === 'editar') {
            $nombre = $_POST['nombre'];
            $distrito = new Distrito();
            $distrito->nombre = $nombre;
    
            if ($accion === 'editar') {
                $distrito->id = $_POST['id']; 
                $distrito->ActualizarDistrito($distrito);
            } else {
                $distrito->RegistrarDistrito(distrito: $distrito); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Distrito procesado correctamente.']);
            exit;
        }
        if($accion === 'delete'){
            $id = $_POST['id']; 
            $distrito->EliminarDistrito($id); 
        }
    }

    
