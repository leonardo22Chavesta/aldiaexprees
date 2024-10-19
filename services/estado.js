$(document).ready(function () {
    modalOpen();
    modalClose();

    listarEstado();
    crearEstado();
    $(".btn_buscar").on("click", function () {
        listarEstado();
    });
})



const listarEstado = () => {
    $.ajax({
        url: './estado.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {

            if (response.estado) {
                let rows = '';

                response.estado.map((estado, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${estado.nombre}</td>
                            <td>${estado.fecha_registro}</td>
                            <td><button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${estado.id}" data-nombre="${estado.nombre}"><box-icon size="sm" name='edit'></box-icon></button></td>
                        </tr>`;
                });

                $("#tbody-estado").empty();

                $("#tbody-estado").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#estadoId").val(id);


                    $("#exampleModalLongTitle").text("Editar Estado");

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



const crearEstado = () => {
    $(".btn_crear_registro").on("click", function () {
        const nombre = $("#txtNombre").val();
        const id = $("#estadoId").val();

        if (nombre.trim() === "") {
            alert("Por favor, ingrese un nombre para el estado.");
            return;
        }

        const accion = id ? 'editar' : 'registrar';

        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id }

        $.ajax({
            url: './estado.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = accion === 'registrar' ? 'El estado se ha registrado exitosamente.' : 'El estado se ha editado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);

                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#estadoId").val(null);
                $('#txtNombre').val('');
                $('#exampleModalCenter').modal('hide');

                listarEstado();
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
        $("#estadoId").val(null);
        $('#exampleModalCenter').modal('hide');
    });
}

