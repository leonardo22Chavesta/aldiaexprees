<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../utils/bootstrap/css/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./../../utils/bootstrap/css/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="./../../utils/style/normalize.css" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./../../services/jquery.js" ></script>
    <script src="./../../services/distrito.js" ></script>
    <title>Distritos</title>
    
</head>
<body>
    <?php
       include "../../components/navar.php";
    ?>
    <div class="container-fluid ">
        
        <form>
            <div class="card mt-4 mb-2" >
                <div class="card-header">
                   <div class="d-flex justify-content-between align-items-center">
                        <span>Buscar</span>
                        <div>
                            <button type="button" class="btn btn-outline-secondary btn_buscar">Buscar</button>
                            <button type="button" class="btn_abrir_modal btn btn-outline-success">Crear Distrito</button>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Buscar Nombre" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Fecha Registro:</label>
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <h4>Distritos:</h4>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha Registro</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-distrito">
                            
                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!--Crea y Edita-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear Distrito</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Nombre:</label>
                                <input type="text" class="form-control" name="txtNombre" placeholder="Nombre del Distrito" id="txtNombre" />
                                <input type="hidden" id="distritoId" /> <!-- Campo oculto para el ID del distrito -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_close btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn_crear_registro btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast" id="registroToast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
        <div class="toast-header">
            <strong class="me-auto">Distrito</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            El distrito se ha registrado exitosamente.
        </div>
    </div>

    <script src="./../../utils/bootstrap/css/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>