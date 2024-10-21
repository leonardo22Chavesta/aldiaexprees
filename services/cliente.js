$(document).ready(function () {
    listarPorDefecto();
    listarBuscarCliente();
    crearCliente();
    eliminarCliente();


    modalOpen();
    modalClose();
})

const listarPorDefecto = () => {
    const valor = { listar: 'listar', nombre: '', fecha_registro: '' }
    buscarClientes(valor)
}
const listarBuscarCliente = () => {
    $(".btn_buscar").on("click", function () {
        const nombre = $("#txtNombreBuscar").val();
        const fecharegistro = $("#txtFechaBuscar").val();
        const data = { listar: 'buscar', nombre: nombre.trim(), fecha_registro: fecharegistro }
        buscarClientes(data);
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

        const form = { accion: accion, nombre: nombre.toUpperCase(), id: id }

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

                listarPorDefecto();
            },
            error: function (xhr, status, error) {
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo más tarde."); // Mensaje amigable para el usuario
            }
        });
    });
}
const eliminarCliente = () => {
    $(".btn-eliminar").on("click", function () {

        const id = $("#clienteId").val();


        const form = { accion: 'delete', nombre: '', id: id };

        $.ajax({
            url: './cliente.php',
            method: 'POST',
            data: form,
            success: function (response) {

                let mensaje = 'El cliente se ha Eliminado exitosamente.';

                $("#registroToast .toast-body").text(mensaje);
                const toastEl = document.getElementById('registroToast');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

                $("#clienteId").val(null);
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
const buscarClientes = (valor) => {

    var url = './cliente.php?listar=' + valor.listar + '&nombre=' + valor.nombre + '&fecha_registro=' + valor.fecha_registro
    $.ajax({
        url: url,
        method: 'GET',
        data: valor,
        dataType: 'json',
        success: function (response) {
            console.log("data", response)

            if (response.cliente) {
                let rows = '';

                response.cliente.map((client, index) => {
                    rows += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${client.nombre}</td>
                            <td>${client.fecha_registro}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info btn-accion btn-sm p-1" data-id="${client.id}" data-nombre="${client.nombre}">
                                    <box-icon size="sm" name='edit'></box-icon>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-accion-delete btn-sm p-1" data-id="${client.id}">
                                    <box-icon size="sm" name='trash'></box-icon>
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


                    $("#exampleModalLongTitle").text("Editar cliente");

                    $('#exampleModalCenter').modal('show');
                });

                $(".btn-accion-delete").on("click", function () {
                    const id = $(this).data("id");

                    $("#clienteId").val(id);

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
        $("#clienteId").val(null);
        $('#exampleModalCenter').modal('hide');
        $('#deleteModal').modal('hide');
    });
}

