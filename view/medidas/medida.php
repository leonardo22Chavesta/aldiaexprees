<?php
    require_once '../../models/conexion.php';
    require_once '../../models/crudmedida.php';

    $medida = new Medida();

    

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        
        $data = null;

        $id = $_GET['id'];

        $data = $medida->MedidaXid( $id);
        
        header('Content-Type: application/json');
        
        echo json_encode($data);
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        $data = null;

        $nombre = $_GET['nombre'];
        $fechaR = $_GET['fecha_registro'];
        
       
        $data = $medida->ListarMedida( $nombre, $fechaR);
        
        header('Content-Type: application/json');
        
        echo json_encode($data);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        
        if (isset($data['nombre'])) {
            $nombre = $data['nombre'];
    
            $medida = new Medida();
            $medida->nombre = $nombre;
    
            
            $data = $medida->RegistrarMedida($medida); 
            
    
            echo json_encode(['data' => $data, 'message' => 'Medida procesado correctamente.']);

        }else {
            // Si no hay 'nombre' en los datos, retorna un error
            echo json_encode(['error' => 'El campo nombre es requerido.']);
        }
        
        exit;
        
    }
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        
        if (isset($data['nombre'])) {
            $id = $_GET['id'];
            $nombre = $data['nombre'];
            $medida = new Medida();
            $medida->id = $id;
            $medida->nombre = $nombre;
    
            
            $data = $medida->ActualizarMedida($medida); 
            
    
            echo json_encode(['data' => $data, 'message' => 'Medida actualizado correctamente.']);

        }else {
            // Si no hay 'nombre' en los datos, retorna un error
            echo json_encode(['error' => 'El campo nombre es requerido.']);
        }
        
        exit;
        
    }
    if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
       
        $id = $_GET['id'];
        $medida->EliminarMedida($id); 
        
        echo json_encode(['message' => 'Medida eliminado correctamente.']);

        
        exit;
        
    }