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
    <script src="./../../services/pedido.js" ></script>

    <title>Pedido</title>
    
</head>
<body>
    <?php
       include "../../components/navar.php";
    ?>
    <div class="container-fluid">
        <form>
            <div class="card mt-4 mb-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Buscar</span>
                        <div>
                            <button type="button" class="btn btn-outline-secondary btn_buscar">Buscar</button>
                            <button type="button" class="btn_abrir_modal btn btn-outline-success">Nuevo Pedido</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Nombre:</label>
                                <input type="text" class="form-control" id="txtNombreBuscar" placeholder="Buscar Nombre" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Distrito:</label>
                                <select class="form-select" aria-label="Default select example" id="distritos-select">
                                    <option selected>Buscar Distrito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Servicio:</label>
                                <select class="form-select" aria-label="Default select example" id="servicios-select">
                                    <option selected>Buscar Servicio</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Fecha Registro:</label>
                                <input type="date" id="txtFechaBuscar" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <h4>Pedidos:</h4>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Direccion</th>
                                        <th scope="col">Distrito</th>
                                        <th scope="col">Servicio</th>
                                        <th scope="col">Fecha Registro</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-pedido">
                                    <!-- Aquí se llenarán los servicios -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear Pedido</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Direccion:</label>
                                <input type="text" class="form-control" name="txtDireccion" placeholder="Direccion" id="txtDireccion" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Distrito:</label>
                                <select class="distrito form-select" aria-label="Default select example" >
                                    <option selected>Buscar Distrito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Servicio:</label>
                                <select class="servicio form-select" aria-label="Default select example">
                                    <option selected>Buscar Servicio</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-2">Medida:</label>
                                <select class="medida form-select" aria-label="Default select example">
                                    <option value="" selected>Buscar Medida</option>
                                    <option value="ee3d6ce4-8cfb-11ef-953b-00224836b811" >Litro</option>
                                    <option value="ee2ee9d5-8cfb-11ef-953b-00224836b811" >Metro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label class="form-label">Descripcion:</label>
                               <textarea class="form-control"  rows="2" name="txtObservaciones" id="txtObservaciones"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_close btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn_crear_registro btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Eliminar Distrito-->
    <div class="modal fade  " id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">¿Está seguro de que desea eliminar este registro?</p>
                    <p class="text-muted small">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn_close" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-eliminar btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fechasModal" tabindex="-1" aria-labelledby="fechasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fechasModalLabel">Fechas de Envío</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    <input type="hidden" id="pedidoId" />
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fechaEnvio" class="form-label">Fecha de Envío</label>
                            <input type="date" class="form-control" id="fechaEnvio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaEstimada" class="form-label">Fecha Estimada</label>
                            <input type="date" class="form-control" id="fechaEstimada" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary bt_envio">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="toast" id="registroToast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
        <div class="toast-header">
            <strong class="me-auto">Servicios</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            El servicio se ha registrado exitosamente.
        </div>
    </div>



    <script src="./../../utils/bootstrap/css/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>