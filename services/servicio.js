$(document).ready(function () {
    listarPorDefecto();
    listarBuscarServicio();
    crearServicio();
    eliminarServicios();


    modalOpen();
    modalClose();
})

const listarPorDefecto = () => {
    const valor = { listar: 'listar', nombre: '', fecha_registro: '' }
    buscarServicios(valor)
}
const listarBuscarServicio = () => {
    $(".btn_buscar").on("click", function () {
        const nombre = $("#txtNombreBuscar").val();
        const fecharegistro = $("#txtFechaBuscar").val();
        const data = { listar: 'buscar', nombre: nombre.trim(), fecha_registro: fecharegistro }
        buscarServicios(data);
    });
}
const crearServicio = () => {
    $(".btn_crear_registro").on("click", function () {
        const nombre = $("#txtNombre").val();
        const id = $("#servicioId").val();

        if (nombre.trim() === "") {
            alert("Por favor, ingrese un nombre para el servicio.");
            return;
        }

        const accion = id ? 'editar' : 'registrar';

        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id }

        $.ajax({
            url: './servicio.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = accion === 'registrar' ? 'El servicio se ha registrado exitosamente.' : 'El servicio se ha editado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#servicioId").val(null);
                $('#txtNombre').val('');
                $('#exampleModalCenter').modal('hide');

                listarPorDefecto();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde."); // Mensaje amigable para el usuario
            }
        });
    });
}
const eliminarServicios = () => {
    $(".btn-eliminar").on("click", function () {

        const id = $("#servicioId").val();


        const form = { accion: 'delete', nombre: '', id: id };

        $.ajax({
            url: './servicio.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = 'El servicio se ha Eliminado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);
                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#servicioId").val(null);
                $('#txtNombre').val('');
                $('#exampleModalCenter').modal('hide');
                $('#deleteModal').modal('hide');
                listarPorDefecto();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde.");
            }
        });
    });
}

/// Abrir y Cerrar el modal
const buscarServicios = (valor) => {
    $.ajax({
        url: './servicio.php',
        method: 'POST',
        data: valor,
        dataType: 'json',
        success: function (response) {
            console.log("data", response)

            if (response.servicio) {
                let rows = '';

                response.servicio.map((serv, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${serv.nombre}</td>
                            <td>${serv.fecha_registro}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${serv.id}" data-nombre="${serv.nombre}">
                                    <box-icon size="sm" name='edit'></box-icon>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-accion-delete btn-sm p-1" data-id="${serv.id}">
                                    <box-icon size="sm" name='trash'></box-icon>
                                </button>
                            </td>
                        </tr>`;
                });

                $("#tbody-servicio").empty();

                $("#tbody-servicio").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#servicioId").val(id);


                    $("#exampleModalLongTitle").text("Editar servicio");

                    $('#exampleModalCenter').modal('show');
                });

                $(".btn-accion-delete").on("click", function () {
                    const id = $(this).data("id");

                    $("#servicioId").val(id);

                    $('#deleteModal').modal('show');
                });

            } else if (response.mensaje_error) {
                alert(response.mensaje_error);
            }
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
        $('#txtNombre').val('');
        $("#servicioId").val(null);
        $('#exampleModalCenter').modal('hide');
        $('#deleteModal').modal('hide');
    });
}