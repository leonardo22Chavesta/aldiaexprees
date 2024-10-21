$(document).ready(function () {
    listarPorDefecto();
    listarBuscarPerdido();
    crearPedido();
    generaEnvio();
    distrito();
    servicio();
    // listarBuscarPedido();

    modalOpen();
    modalClose();
})

const listarPorDefecto = () => {
    const valor = { listar: 'listar', fecha: '', observaciones: '', distrito_id: '', servicio_id: '' }
    buscarPedidos(valor)
}

const listarBuscarPerdido = () => {
    $(".btn_buscar").on("click", function () {
        const idDistrito = $('#distritos-select').val();
        const idServicio = $('#servicios-select').val();
        const nombre = $("#txtNombreBuscar").val();
        const fecharegistro = $("#txtFechaBuscar").val();
        const valor = {
            listar: 'listar',
            fecha: fecharegistro,
            observaciones: nombre,
            distrito_id: idDistrito,
            servicio_id: idServicio
        }
        // console.log(valor);
        buscarPedidos(valor)
    })
}
const buscarPedidos = (valor) => {
    $.ajax({
        url: './pedido.php',
        method: 'POST',
        data: valor,
        dataType: 'json',
        success: function (response) {

            console.log("data", response)

            if (response.pedido) {
                let rows = '';

                response.pedido.map((ped, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${ped.observaciones}</td>
                            <td>${ped.direccion}</td>
                            <td>${ped.distrito}</td>
                            <td>${ped.servicio}</td>
                            <td>${ped.fecha_registro}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${ped.id}"">
                                    <box-icon type='logo' name='telegram'></box-icon>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-accion-delete btn-sm p-1" data-id="${ped.id}">
                                    <box-icon size="sm" name='trash'></box-icon>
                                </button>
                            </td>
                        </tr>`;
                });

                $("#tbody-pedido").empty();

                $("#tbody-pedido").append(rows);

                $(".btn-accion").on("click", function () {

                    const id = $(this).data("id");
                    $("#pedidoId").val(id);


                    $('#fechasModal').modal('show');
                });

                // $(".btn-accion-delete").on("click", function () {
                //     const id = $(this).data("id");

                //     $("#clienteId").val(id);

                //     $('#deleteModal').modal('show');
                // });

            } else if (response.mensaje_error) {
                alert(response.mensaje_error);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error al obtener los datos: ", xhr);
        }
    });

}
const crearPedido = () => {
    $(".btn_crear_registro").on("click", function () {
        const distrito = $('.distrito').val();
        const servicio = $('.servicio').val();
        const medida = $('.medida').val();
        const observacion = $('#txtObservaciones').val();
        const direccion = $('#txtDireccion').val();

        const form = {
            accion: 'registrar',
            distrito_id: distrito.trim(),
            servicio_id: servicio.trim(),
            medida_id: medida.trim(),
            obs: observacion,
            direcc: direccion
        }

        $.ajax({
            url: './pedido.php',
            method: 'POST',
            data: form,
            success: function (response) {
                console.log(response)
                let mensaje = 'El Paquete se ha registrado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $('.distrito').val('');
                $('.servicio').val('');
                $('.medida').val('');
                $('#txtObservaciones').val('');
                $('#exampleModalCenter').modal('hide');

                listarPorDefecto();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde."); // Mensaje amigable para el usuario
            }
        });

    })
}

const generaEnvio = () => {
    $(".bt_envio").on("click", function () {

        const id = $("#pedidoId").val();
        const fechaEnvio = $("#fechaEnvio").val();
        const fechaEstimada = $("#fechaEstimada").val();

        console.log(id)
        console.log(fechaEnvio)
        console.log(fechaEstimada)

        const form = {
            enviar: 'enviar',
            idPaquete: id.trim(),
            fechaEnvio: fechaEnvio.trim(),
            fechaEstimada: fechaEstimada.trim(),
        }

        $.ajax({
            url: './pedido.php',
            method: 'POST',
            data: form,
            success: function (response) {

                console.log(response)

                let mensaje = 'El Paquete se ha enviado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#pedidoId").val(null);
                $("#fechaEnvio").val('');
                $("#fechaEstimada").val('');
                $('#fechasModal').modal('hide');

                listarPorDefecto();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde."); // Mensaje amigable para el usuario
            }
        });


    });
}


const distrito = () => {
    const valor = { listar: 'listar', nombre: '', fecha_registro: '' }
    $.ajax({
        url: '../distritos/distrito.php',
        method: 'POST',
        data: valor,
        dataType: 'json',
        success: function (response) {
            let $select = $('#distritos-select');  // Referencia al select
            let $selectClass = $('.distrito');  // Referencia al select

            $select.empty();  // Limpiar las opciones anteriores
            $selectClass.empty();  // Limpiar las opciones anteriores

            // Agregar una opción por defecto
            $select.append('<option value="" selected>Buscar Distrito</option>');
            $selectClass.append('<option value="" selected>Buscar Distrito</option>');

            // Iterar sobre los distritos y agregarlos como opciones
            response.distrito.map(distrito => {
                $select.append(`<option value="${distrito.id}">${distrito.nombre}</option>`);
                $selectClass.append(`<option value="${distrito.id}">${distrito.nombre}</option>`);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error al obtener los datos: ", error);
        }
    });
}

const servicio = () => {

    const valor = { listar: 'listar', nombre: '', fecha_registro: '' }

    $.ajax({
        url: '../services/servicio.php',
        method: 'POST',
        data: valor,
        dataType: 'json',
        success: function (response) {
            let $select = $('#servicios-select');  // Referencia al select
            let $selectClass = $('.servicio');  // Referencia al select

            $select.empty();  // Limpiar las opciones anteriores
            $selectClass.empty();  // Limpiar las opciones anteriores

            // Agregar una opción por defecto
            $select.append('<option value="" selected>Buscar Servicios</option>');
            $selectClass.append('<option value="" selected>Buscar Servicios</option>');

            // Iterar sobre los distritos y agregarlos como opciones
            response.servicio.map(servi => {
                $select.append(`<option value="${servi.id}">${servi.nombre}</option>`);
                $selectClass.append(`<option value="${servi.id}">${servi.nombre}</option>`);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error al obtener los datos: ", error);
        }
    });

}

const modalOpen = () => {
    $(".btn_abrir_modal").on("click", function () {
        $('#exampleModalCenter').modal('show');
    });
}
const modalClose = () => {
    $(".btn_close").on("click", function () {
        $('.distrito').val('');
        $("#pedidoId").val(null);
        $('.servicio').val('');
        $('.medida').val('');
        $("#fechaEnvio").val('');
        $("#fechaEstimada").val('');
        $('#txtDireccion').val('')
        $('#txtObservaciones').val('');
        $('#exampleModalCenter').modal('hide');
        $('#deleteModal').modal('hide');
        $('#fechasModal').modal('hide');
    });
}
