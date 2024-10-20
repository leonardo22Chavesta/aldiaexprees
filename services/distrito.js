$(document).ready(function () {
    listarPorDefecto();
    listarBuscarDistro();
    crearDistrito();
    eliminarDistrito();


    modalOpen();
    modalClose();
})

const listarPorDefecto = () => {
    const valor = { listar: 'listar', nombre: '', fecha_registro: '' }
    buscarDistritos(valor)
}
const listarBuscarDistro = () => {
    $(".btn_buscar").on("click", function () {
        const nombre = $("#txtNombreBuscar").val();
        const fecharegistro = $("#txtFechaBuscar").val();
        const data = { listar: 'buscar', nombre: nombre.trim(), fecha_registro: fecharegistro }
        buscarDistritos(data);
    });
}
const crearDistrito = () => {
    $(".btn_crear_registro").on("click", function () {
        const nombre = $("#txtNombre").val();
        const id = $("#distritoId").val();

        if (nombre.trim() === "") {
            alert("Por favor, ingrese un nombre para el distrito.");
            return;
        }

        const accion = id ? 'editar' : 'registrar';

        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id }

        $.ajax({
            url: './distrito.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = accion === 'registrar' ? 'El distrito se ha registrado exitosamente.' : 'El distrito se ha editado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#distritoId").val(null);
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
const eliminarDistrito = () => {
    $(".btn-eliminar").on("click", function () {

        const id = $("#distritoId").val();


        const form = { accion: 'delete', nombre: '', id: id };

        $.ajax({
            url: './distrito.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = 'El Distrito se ha Eliminado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);
                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#distritoId").val(null);
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
const buscarDistritos = (valor) => {
    $.ajax({
        url: './distrito.php',
        method: 'POST',
        data: valor,
        dataType: 'json',
        success: function (response) {
            console.log("data", response)

            if (response.distrito) {
                let rows = '';

                response.distrito.map((distri, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${distri.nombre}</td>
                            <td>${distri.fecha_registro}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${distri.id}" data-nombre="${distri.nombre}">
                                    <box-icon size="sm" name='edit'></box-icon>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-accion-delete btn-sm p-1" data-id="${distri.id}">
                                    <box-icon size="sm" name='trash'></box-icon>
                                </button>
                            </td>
                        </tr>`;
                });

                $("#tbody-distrito").empty();

                $("#tbody-distrito").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#distritoId").val(id);


                    $("#exampleModalLongTitle").text("Editar Distrito");

                    $('#exampleModalCenter').modal('show');
                });

                $(".btn-accion-delete").on("click", function () {
                    const id = $(this).data("id");

                    $("#distritoId").val(id);

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
        $("#distritoId").val(null);
        $('#exampleModalCenter').modal('hide');
        $('#deleteModal').modal('hide');
    });
}

