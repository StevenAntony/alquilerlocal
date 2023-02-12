function Estado(estado) {
    var html = '';
    switch (estado) {
        case 'PUB':
            html = `<span class="badg badg-success">${estado}<span>`
            break;
        case 'NUE':
            html = `<span class="badg badg-info">${estado}<span>`
        default:
            html = `<span class="badg badg-info">${estado}<span>`
    }

    return html;
}

$(document).ready(function () {
    var table = $('#table_info').DataTable({
        "ajax": {
            url: '/publicacion/listar',
            type: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                tipo: 'VentaRapidaListar'
            },
            "dataSrc": function (response) {
                if (response.Status == 'Success') {
                    return response.Data
                }
            },
        },
        "order": [[2, "desc"]],
        "deferRender": true,
        "responsive": true,
        "columnDefs": [
            {
                "title": "",
                "targets": [0],
                "visible": true
            },
            {
                "title": "Descripción",
                "targets": [1],
                "visible": true
            },
            {
                "title": "Fecha Pub.",
                "targets": [2],
                "visible": true
            },
            {
                "title": "Tipo",
                "targets": [3],
                "visible": true
            },
            {
                "title": "Maps",
                "targets": [4],
                "visible": true
            },
            {
                "title": "Estado",
                "targets": [5],
                "visible": true
            },
            {
                "title": "Acciones",
                "targets": [6],
                "visible": true
            }
        ],
        "columns": [
            {
                "width": "3%",
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": '',
                render: function (data, type, row) {
                    return `<button type="button" class="btn-info btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-plus"></i></button>`;
                }
            },

            { "data": "descripcion" },

            { "data": "Fecha", "className": 'hidden-xs' },
            {
                "data": null,
                render: function (data, type, row) {
                    return `<span class="badge ${row.tipo == 'Evento' ? 'bg-warning' : 'bg-primary'} text-white">${row.tipo}</span>`
                    // return `${row.Departamento} / ${row.Provincia} / ${row.Distrito}`;
                }
            },

            {
                "data": null, "className": 'hidden-xs text-center',
                render: function (data, type, row) {
                    return `<a href="https://google.cl/maps/place/${row.longitud},${row.latitud}" target="_black"><i class="fa fa-map-marker"
                        style="font-size: 1.5rem;color: #f71b1b;"></i></a>`;
                }
            },
            {
                "data": "estado_VNT", "className": 'hidden-xs',
                render: function (data, type, row) {
                    return Estado(row.estado);
                }
            },
            {
                "data": null,
                "className": 'hidden-xs text-center',
                render: function (data, type, row) {
                    // <button data-key="${row.id_propiedad}" type="button" class="button_control btn btn-info button_small btn_control_info subirGaleria"
                    //         style="font-size:.6rem"
                    //         ><i class="fa fa-camera"></i></button>
                    let buttonAnular = (row.estado != 'ANU') ?  `<button data-key="${row.id_propiedad}" type="button" class="btn btn-danger button_small btn_control_info eliminarPublicacion"
                                                style="font-size:.6rem"
                                                ><i class="fa fa-trash"></i></button>` : '';
                    return `${buttonAnular}`;
                }
            },
        ],
        "language": {
            "url": "lib/datatables/Spanish.son.json"
        },
        "initComplete": function () {
            $('[data-event="tooltip"]').tooltip();
        }
    });
    $('#table_info tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var td = $(this).closest('td');
        if (row.child.isShown()) {
            row.child.hide();
            td.html(`<button type="button" class="btn-info btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-plus"></i></button>`)
            // tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();

            td.html(`<button type="button" class="btn-danger btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-minus"></i></button>`)
            // tr.addClass('shown');
        }
    });

    function format(d) {
        var mapa = "";
        return '<table style="width: 100%;" cellpadding="5" cellspacing="0" border="0">' +
            '<tr>' +
            '<td style="width: 10%;text-align: right;padding: 10px 10px;">Información:</td>' +
            '<td style="text-align: left;padding: 10px 10px;">' + (d.informacion == null ? "--" : d.informacion) + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 10%;text-align: right;padding: 10px 10px;">Dirección:</td>' +
            '<td style="text-align: left;padding: 10px 10px;">' + d.direccion + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 10%;text-align: right;padding: 10px 10px;">Precio:</td>' +
            '<td style="text-align: left;padding: 10px 10px;">' + d.moneda + ': ' + d.precio + '</td>' +
            '</tr>' +
            '</table>';
    }
});

$('.btn_nueva_publicacion').click(function () {
    $('#modal_nueva_informacion').modal('show');
});

var ListCaracteristica = [];
var ImagenPrincipal = null;
var ListaGaleria = [];
var IdPropiedad = null;
class Caracteristica {
    constructor(id, descripcion, estado, identificador) {
        this.id = id;
        this.descripcion = descripcion;
        this.estado = estado;
        this.identificador = identificador;
    }
}

class ImgGaleria {
    constructor(id, img, estado, identificador) {
        this.id = id;
        this.img = img;
        this.estado = estado;
        this.identificador = identificador;
    }
}


class Publicacion {
    constructor(id, descripcion, publicacion_fecha, departamento, provincia, distrito, direccion, longitud, latitud,
        informacion, estado, id_propietario, video, precio, moneda, imagen, identificador) {
        this.Id = id;
        this.Descripcion = descripcion;
        this.Fecha = publicacion_fecha;
        this.Departamento = departamento;
        this.Provincia = provincia;
        this.Distrito = distrito;
        this.Direccion = direccion;
        this.Longitud = longitud;
        this.Latitud = latitud;
        this.Informacion = informacion;
        this.Estado = estado;
        this.IdPropietario = id_propietario;
        this.Video = video;
        this.Precio = precio;
        this.Moneda = moneda;
        this.Imagen = imagen;
        this.Identificador = identificador;
    }
}

function TablaCaracteristica(tabla, lista) {
    var object = lista;
    var htmlTabla = '';
    for (var i in object) {
        if (object.hasOwnProperty(i)) {
            var element = object[i];
            htmlTabla += `<tr class="text-center">
                        <td>${(Number(i) + 1)}</td>
                        <td>${element.descripcion}</td>
                        <td><button type="button" data-key="${element.identificador}"
                                style="font-size: .6rem;"
                                class="btn-accion btn btn-danger btn-accion-danger btnEliminarCaract"><i class="fa fa-trash"></i></button></td>
                      </tr>`;
        }
    }
    $(tabla).html(htmlTabla);
}

$('#agregarCaracteristica').click(function () {
    var newObject = new Caracteristica(null, $('#newDescripcion').val(), false, uuidv4());
    ListCaracteristica.push(newObject);
    TablaCaracteristica('#table-caracteristica', ListCaracteristica);
})

$('#table-caracteristica').on('click', '.btnEliminarCaract', function () {
    var identificar = $(this).data('key');
    var objeto = ListCaracteristica.findIndex((obj) => obj.identificador == identificar);
    ListCaracteristica.splice(objeto, 1);
    TablaCaracteristica('#table-caracteristica', ListCaracteristica);
})

function validarForm() {
    var validar = $('#formProceso .validar-formulario');
    var pass = true;
    var mensaje = [];
    // console.log(validar);
    validar.each(function () {
        // console.log($(this).val().trim().length);
        if ($(this).val().trim().length <= 0 && $(this).prop('disabled') == false) {
            pass = false;
            mensaje.push($(this).attr('text-validate'))
        }
    });

    return [pass, mensaje];
}

function EjecutarProceso() {
    var validacion = validarForm();
    if (validacion[0] == true) {
        $.ajax({
            type: "post",
            url: $('#formProceso').attr('action'),
            data: $('#formProceso').serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.Status == 'Success') {
                    ImagenPrincipal = null;
                    ListCaracteristica = [];
                    TablaCaracteristica('#table-caracteristica', ListCaracteristica);
                    $('#formProceso')[0].reset();
                    $('.loaded').removeClass('loaded-active');
                    $('.loaded').attr('src', '');
                    Swal.fire({
                        title: 'Plataforma',
                        text: response.Mesagge,
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6'
                    });
                    $('#modal_nueva_informacion').modal('hide');
                    location.reload();
                } else {
                    Swal.fire({
                        title: result.Meta.Code,
                        html: result.Meta.Error_Message,
                        icon: result.Meta.Code == 500 ? 'error' : 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    title: 'Upssss!',
                    text: 'El servicio no se encuentra disponible.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                });
            }
        });
    } else {
        var newHtml = "<ul>";
        validacion[1].forEach(element => {
            newHtml += `<li>${element}</li>`;
        });
        newHtml += "</ul>";
        Swal.fire({
            title: 'Campos Imcompletos!',
            html: newHtml,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    }
}

$('.btn_proceso').click(function () {
    $('#itmCaracteristicas').val(JSON.stringify(ListCaracteristica));
    $('#itmAccion').val('Nuevo');
    $('#itmImagenPrincipal').val(ImagenPrincipal);
    EjecutarProceso();
});

function FilePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            ImagenPrincipal = e.target.result;
            $('.loaded').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function FilePreviewMultiple(input) {
    //console.log(input.files);
    var object = input.files;
    console.log(input.files);
    for (var item in object) {
        if (object.hasOwnProperty(item)) {
            var element = object[item];
            var reader = new FileReader();
            reader.onload = function (e) {
                var id = uuidv4();
                var newGaleria = new ImgGaleria(null, e.target.result, false, id);
                ListaGaleria.push(newGaleria);
                html = `<div class="col-md-3 content-one-img">
                  <i class="fa fa-close remover-img-galeria" data-key="${id}"></i>
                  <img style="width: 100%;height: 100px;" src="${e.target.result}"></div>`;
                $('.content-galeria-img').append(html);
            }
            reader.readAsDataURL(element);
        }
    }
}

$('.content-galeria-img').on('click', '.remover-img-galeria', function () {
    var identificar = $(this).data('key');
    var objeto = ListaGaleria.findIndex((obj) => obj.identificador == identificar);
    ListaGaleria.splice(objeto, 1);
    var content = $(this).closest(".content-one-img");
    content.remove();
})

$('#itmImagenPortada').change(function () {
    $('.loaded').addClass('loaded-active')
    FilePreview(this)
});

$('#imtImagenGaleria').change(function () {
    console.log(this);
    // $('.cargar-imagen').addClass('loaded-active')
    FilePreviewMultiple(this)
});

function EjecutarProcesoGaleria() {
    $.ajax({
        type: "post",
        url: '/subirGaleria',
        data: JSON.stringify({
            'IdPropiedad': IdPropiedad,
            'Galeria': ListaGaleria
        }),
        contentType: false,
        processData: false,
        dataType: "json",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.Status == 'Success') {

                swal({
                    title: 'Resultado',
                    text: response.Mesagge,
                    icon: "success",
                });
            } else {
                swal({
                    title: response.Meta.Error_Type,
                    text: response.Meta.Error_Message,
                    icon: "error",
                });
            }
        }
    });
}

$('.btn_proceso_galeria').click(function () {
    EjecutarProcesoGaleria()
});

$('#content-tabla').on('click', '.subirGaleria', function () {
    var key = $(this).data('key');
    IdPropiedad = key;
    $('#modal_galeria').modal('show');
});

$(document).on('click', '.eliminarPublicacion', function () {
    var key = $(this).data('key');
    IdPropiedad = key;
    Swal.fire({
        title: 'Eliminar',
        html: 'Esta a punto de eliminar la publicación este proceso no se puede recuperar.',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        showCancelButton: true,
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: '/eliminar-publicacion',
                data: {
                  'IdPropiedad' : IdPropiedad
                },
                dataType: "json",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                  if (response.Status == 'Success') {
                    Swal.fire({
                      title: 'Resultado',
                      text: response.Mesagge,
                      icon: "success",
                    });
                    location.reload();
                  }else{
                    Swal.fire({
                      title: response.Meta.Error_Type,
                      text: response.Meta.Error_Message,
                      icon: "error",
                    });
                  }
                }
            });
        }
    });
})
