$(document).ready(function () {
    modalOpen();
    modalClose();

    listarCliente();
    crearCliente();
    $(".btn_buscar").on("click", function () {
        listarCliente();
    });
});

const listarCliente = () => {
    $.ajax({
        url: './cliente.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            if (response.cliente) {
                let rows = '';
                response.cliente.map((clien, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${clien.nombre}</td>
                            <td>${clien.fecha_registro}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${clien.id}" data-nombre="${clien.nombre}">
                                    <box-icon size="sm" name='edit'></box-icon>
                                </button>
                            </td>
                        </tr>`;
                });

                $("#tbody-cliente").empty();
                $("#tbody-cliente").append(rows);

                $(".btn-accion").on("click", function () {
                    const id = $(this).data("id");
                    const nombre = $(this).data("nombre");

                    $("#txtNombre").val(nombre);
                    $("#clienteId").val(id);

                    $("#exampleModalLongTitle").text("Editar Cliente");
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

const crearCliente = () => {
    $(".btn_crear_registro").on("click", function () {
        const nombre = $("#txtNombre").val();
        const id = $("#clienteId").val();

        if (nombre.trim() === "") {
            alert("Por favor, ingrese un nombre para el cliente.");
            return;
        }

        const accion = id ? 'editar' : 'registrar';
        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id };

        $.ajax({
            url: './cliente.php',
            method: 'POST',
            data: form,
            success: function (response) {
                let mensaje = accion === 'registrar' ? 'El cliente se ha registrado exitosamente.' : 'El cliente se ha editado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);
                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#clienteId").val(null);
                $('#txtNombre').val('');
                $('#exampleModalCenter').modal('hide');

                listarClientes();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde.");
            }
        });
    });
}



// Abrir y Cerrar el modal
const modalOpen = () => {
    $(".btn_abrir_modal").on("click", function () {
        $('#exampleModalCenter').modal('show');
    });
}

const modalClose = () => {
    $(".btn_close").on("click", function () {
        $('#txtNombre').val('');
        $("#clienteId").val(null);
        $('#exampleModalCenter').modal('hide');
    });
}
