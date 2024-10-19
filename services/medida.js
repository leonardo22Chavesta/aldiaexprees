$(document).ready(function () {
    modalOpen();
    modalClose();

    listarMedida();
    crearMedida();
    $(".btn_buscar").on("click", function () {
        listarMedida();
    });
})



const listarMedida = () => {
    $.ajax({
        url: './medida.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {

            if (response.medida) {
                let rows = '';

                response.medida.map((medida, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${medida.nombre}</td>
                            <td>${medida.fecha_registro}</td>
                            <td><button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${medida.id}" data-nombre="${medida.nombre}"><box-icon size="sm" name='edit'></box-icon></button></td>
                        </tr>`;
                });

                $("#tbody-medida").empty();

                $("#tbody-medida").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#medidaId").val(id);


                    $("#exampleModalLongTitle").text("Editar Medida");

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



const crearMedida = () => {
    $(".btn_crear_registro").on("click", function () {
        const nombre = $("#txtNombre").val();
        const id = $("#medidaId").val();

        if (nombre.trim() === "") {
            alert("Por favor, ingrese un nombre para la medida.");
            return;
        }

        const accion = id ? 'editar' : 'registrar';

        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id }

        $.ajax({
            url: './medida.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = accion === 'registrar' ? 'La medida se ha registrado exitosamente.' : 'La medida se ha editado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#medidaId").val(null);
                $('#txtNombre').val('');
                $('#exampleModalCenter').modal('hide');

                listarMedida();
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
        $("#medidaId").val(null);
        $('#exampleModalCenter').modal('hide');
    });
}

