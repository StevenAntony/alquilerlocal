@extends('admin.layout.master')
@section('title','Publicaciones')
@section('style')
  <link rel="stylesheet" href="{{asset('lib/datatables/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('lib/sweetalert2/dist/sweetalert2.min.css')}}">
  <style media="screen">
    .swal2-popup {
      font-size: 1.6rem!important;
    }
    .card-main{
      padding: 10px;
      box-shadow: 1px 6px 10px 1px #9d9d9d;
      background: #fff;
      /* border: 0.1px solid #9d9d9d; */
      border: 1px solid rgb(124, 152, 167)!important;
      border-radius: 10px;
      margin: 0.4rem 0rem;
    }
    .uploader{
      align-items: center;
      background-color: #fff;
      display: flex;
      height: 100%;
      justify-content: center;
      border: 3px solid #1cb9aa;
      outline-offset: 5px;
      position: relative;
      width: 100%;
    }
    .uploader img{
      left: 0;
      right: 0;
      bottom: 0;
      height: 100%;
      opacity: 0;
      max-height: 100%;
      max-width: 100%;
      position: absolute;
      top: 0;
      transition: all 300ms ease-in;
      z-index: 100;
      width: 100%;
    }
    .loaded-active{
      opacity: 1!important;
    }
    .uploader i{
      font-size: 5rem;
      color: grey;
    }
    .uploader input{
      display: none;
    }
    .content-one-img .fa{
      position: absolute;
      font-size: 15px;
      background: #d92727;
      padding: 0.7rem 1rem;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      left: 10px;
      color: #fff;
    }
  </style>
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Publicaciones</h1>
    <a href="#" class="d-none btn_nueva_publicacion d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nueva Publicación</a>
</div>
<div class="col-xs-12" id="content-tabla">
    <table id="table_info" class="table table-striped jambo_table bulk_action" style="width:100%">
    </table>
  </div>
<div class="modal fade" id="modal_nueva_informacion" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="flex-direction: row-reverse">
          <button type="button" class="close" style="margin: 0px; padding: 0px" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-camera"></i> Nueva Publicación</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('app.realizarpublicacionproceso')}}" id="formProceso" method="post" class="row">
          @csrf
          <input type="hidden" name="itmAccion" id="itmAccion" value="">
          <input type="hidden" name="itmCoordenada" text-validate="Ingrese Coordenadas" class="validar-formulario" id="itmCoordenada" value="">
          <input type="hidden" name="itmCaracteristicas" text-validate="Ingrese Mínimo una caracteristica" class="validar-formulario" id="itmCaracteristicas" value="">
          <input type="hidden" name="itmImagenPrincipal" id="itmImagenPrincipal" value="">
          <div class="d-flex flex-wrap w-100">
            <div class="col-md-6" style="padding:0px">
              <div class="col-md-12 px-3 pb-3">
                <div class="input-container-main">
                    <label for="itmDescripcion"  class=" label-form-main" style="">Titulo <i title="Obligatorio" class="fa fa-exclamation-circle"></i></label>
                    <input id="itmDescripcion" type="text" name="itmDescripcion" autocomplete="off" text-validate="Ingrese Descripción"
                            class="validar-formulario input-form-main form-control"  value="" placeholder="">
                </div>
              </div>
              <div class="col-md-12 px-3 pb-3">
                <div class="input-container-main">
                    <label for="itmInformacion" class="label-form-main" style="">Información</label>
                    <textarea style="height: 140px!important;" name="itmInformacion" id="itmInformacion" placeholder="Información"
                            class="input-form-main form-control" autocomplete="off" rows="8" cols="6"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content-img" style="align-items: center;display: flex;justify-content: center;height: 100%; ">
                <label class="uploader class=" loaded="" ondragover="return false">
                    <i class="fa fa-save "></i>
                    <img src="" class="loaded">
                    <input type="file" name="itmImagenPortada" class="form-control" id="itmImagenPortada" accept="image/*">
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-4 px-3 pb-3">
            <div class="input-container-main">
              <select class="select-form-main form-control" name="itmDepartamento" id="itmDepartamento">
                <option value="-1">Departamento</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 px-3 pb-3">
            <div class="input-container-main">
              <select class="select-form-main form-control" name="itmProvincia" id="itmProvincia">
                <option value="-1">Provincia</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 px-3 pb-3">
            <div class="input-container-main">
              <select class="select-form-main form-control" name="itmDistrito" id="itmDistrito">
                <option value="-1">Distrito</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmDireccion" class="label-form-main" style="">Dirección <i title="Obligatorio" class="fa fa-exclamation-circle"></i></label>
                <input id="itmDireccion" type="text"  name="itmDireccion" autocomplete="off"
                text-validate="Ingrese Dirección" class="form-control validar-formulario input-form-main"  value="" placeholder="">
            </div>
          </div>
          <div class="col-md-3 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmPrecio" class="label-form-main" style="">Precio <i title="Obligatorio" class="fa fa-exclamation-circle"></i></label>
                <input id="itmPrecio" type="number" name="itmPrecio" autocomplete="off" text-validate="Ingrese Precio"
                    class="validar-formulario input-form-main form-control"  value="" placeholder="">
            </div>
          </div>
          <div class="col-md-3 px-3 pb-3">
            <div class="input-container-main" style="margin-top: 32px;">
              <select class="select-form-main form-control" name="itmMoneda" id="itmMoneda">
                <option value="SOLES">SOLES</option>
                <option value="DOLAR">DOLAR</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmPrecio" class="label-form-main" style="">Tipo <i title="Obligatorio" class="fa fa-exclamation-circle"></i></label>
                <select class="select-form-main form-control" name="itmTipo" id="itmTipo">
                    <option value="Alquilar">Alquilar</option>
                    <option value="Evento">Evento</option>
                </select>
            </div>
          </div>
          <div class="col-md-2 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmCapacidad" class="label-form-main" style="">Capacidad <i title="Obligatorio" class="fa fa-exclamation-circle"></i></label>
                <input id="itmCapacidad" type="number" name="itmCapacidad" autocomplete="off" text-validate="Ingrese Capacidad"
                    class="validar-formulario input-form-main form-control"  value="" placeholder="">
            </div>
          </div>
          <div class="col-md-2 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmDecoracion" class="label-form-main" style="">Decoración</label>
                <input id="itmDecoracion" type="checkbox" name="itmDecoracion" autocomplete="off"
                    class="form-control"  placeholder="">
            </div>
          </div>
          <div class="col-md-2 px-3 pb-3">
            <div class="input-container-main">
                <label for="itmPiscina" class="label-form-main" style="">Piscina</label>
                <input id="itmPiscina" type="checkbox" name="itmPiscina" autocomplete="off"
                    class="form-control"   placeholder="">
            </div>
          </div>
          <div class="col-md-6 px-3 pb-3">
            <div class="card-main">
              <div class="card-main-header">
                <h4>Incluye</h4>
              </div>
              <div class="card-main-body row">
                <div class="col-md-12">
                  <div class="input-container-main input-container-group d-flex flex-wrap">
                        <label for="newDescripcion" class="label-form-main col-12" style="">Descripción</label>
                        <input id="newDescripcion" type="text" name="newDescripcion" autocomplete="off" class="input-form-main form-control col-10"  value="" placeholder="">
                        <button type="button" id="agregarCaracteristica" class="btn btn-primary col-2" name="button"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <div class="col-md-12" style="margin-top:1.5rem;">
                  <div class="content-table">
                    <table class="table table-main">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Descripción</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody id="table-caracteristica">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div id="map_canvas" style="height:350px">

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="button_control btn btn-danger btn_control-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
          <button type="button" class="button_control btn btn-success btn_proceso"> <i class="fa fa-save"></i> Publicar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_galeria" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-camera"></i> Galeria de Foto</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="content-img" style="align-items: center;display: flex;justify-content: center; ">
              <label class="uploader class=" loaded="" ondragover="return false">
                <i class="fa fa-save "></i>
                <img src="" class="cargar-imagen">
                <input type="file" name="imtImagenGaleria" id="imtImagenGaleria" accept="image/*" multiple>
              </label>
            </div>
          </div>
          <div class="col-md-9">
            <div class="row content-galeria-img">

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="button_control btn btn-danger btn_control-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
          <button type="button" class="button_control btn btn-success btn_proceso_galeria"> <i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script src="{{asset('lib/datatables/jszip.min.js')}}"></script>
  <script src="{{asset('lib/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('lib/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('lib/datatables/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('lib/datatables/buttons.html5.min.js')}}"></script>

  <script src="{{asset('lib/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <script src="{{asset('backend/asset/js/publicacion.js')}}?v={{time()}}" charset="utf-8"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_5nony-2rp7PWwEipl9Yx-o510ATWZvk"></script>
  <script type="text/javascript">
  var vMarker
      var map
          map = new google.maps.Map(document.getElementById('map_canvas'), {
              zoom: 14,
              center: new google.maps.LatLng(-6.7699564, -79.8379592),
              mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          vMarker = new google.maps.Marker({
              position: new google.maps.LatLng(-6.7699564, -79.8379592),
              draggable: true
          });
          google.maps.event.addListener(vMarker, 'dragend', function (evt) {
            var coordenada = {
              Latitud:evt.latLng.lat().toFixed(6),
              Longitud:evt.latLng.lng().toFixed(6)
            }
            $('#itmCoordenada').val(JSON.stringify(coordenada));
              map.panTo(evt.latLng);
          });
          map.setCenter(vMarker.position);
          vMarker.setMap(map);
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      var Departamento = @JSON($Departamento);
      var Provincia = @JSON($Provincia);
      var Distrito = @JSON($Distrito);
      var htmlDepart = '';
      for (var item in Departamento) {
        if (Departamento.hasOwnProperty(item)) {
          var element = Departamento[item];
          htmlDepart += `<option ${element.id_departamento == 14?'selected':''} value="${element.id_departamento}">${element.nombre}</option>`
        }
      }
      $('#itmDepartamento').html(htmlDepart);
      CargarProvincia($('#itmDepartamento').val());
      CargarDistrito($('#itmProvincia').val());

      $('#itmDepartamento').change(function(event) {
        CargarProvincia($(this).val());
        CargarDistrito($('#itmProvincia').val());
      });

      $('#itmProvincia').change(function(event) {
        CargarDistrito($(this).val());
      });

      function CargarProvincia(CodDepartamento) {
        var htmlProvin = '';
        var ProvinciaFiltro = Provincia.filter((obj) => obj.id_departamento == CodDepartamento);
        for (var item in ProvinciaFiltro) {
          if (ProvinciaFiltro.hasOwnProperty(item)) {
            var element = ProvinciaFiltro[item];
            htmlProvin += `<option value="${element.id_provincia}">${element.nombre}</option>`
          }
        }
        $('#itmProvincia').html(htmlProvin);
      }

      function CargarDistrito(CodProvincia) {
        var htmlDist = '';
        var DistritoFiltro = Distrito.filter((obj) => obj.id_provincia == CodProvincia);
        for (var item in DistritoFiltro) {
          if (DistritoFiltro.hasOwnProperty(item)) {
            var element = DistritoFiltro[item];
            htmlDist += `<option value="${element.id_distrito}">${element.nombre}</option>`
          }
        }
        $('#itmDistrito').html(htmlDist);
      }
    });
  </script>
@endsection
