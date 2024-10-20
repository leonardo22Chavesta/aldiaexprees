$(document).ready(function () {
    modalOpen();
    modalClose();

    listarServicio();
    crearServicio();
    $(".btn_buscar").on("click", function () {
        listarServicio();
    });
})


const listarDistrito = () => {
    $.ajax({
        url: './servicio.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {

            if (response.servicio) {
                let rows = '';

                response.servicio.map((servi, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${servi.nombre}</td>
                            <td>${servi.fecha_registro}</td>
                            <td><button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${servi.id}" data-nombre="${servi.nombre}"><box-icon size="sm" name='edit'></box-icon></button></td>
                        </tr>`;
                });

                $("#tbody-servicio").empty();

                $("#tbody-servicio").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#servicioId").val(id);


                    $("#exampleModalLongTitle").text("Editar Servicio");

                    $('#exampleModalCenter').modal('show');
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

                listarServicio();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde."); // Mensaje amigable para el usuario
            }
        });
    });
}

/// Abrir y Cerrar el modal

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
    });
}