<?php
    require_once '../../models/conexion.php';
    require_once '../../models/cruddistrito.php';

    $distrito = new Distrito();
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listar'])){
        $accion = $_POST['listar'];
        if ($accion === 'buscar') {
            $valor = $_POST['nombre'];
            $distrito->ListarDistrito(valor: $valor);
        }else{
            $distrito->ListarDistrito(valor: '');
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
                $distrito->ActualizarProducto($distrito);
            } else {
                $distrito->RegistrarProducto(distrito: $distrito); 
            }
    
            echo json_encode(['success' => true, 'message' => 'Distrito procesado correctamente.']);
            exit;
        }
    }