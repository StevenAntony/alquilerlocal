@extends('web.layout.appWeb')
@section('Content')
    <style media="screen">
        .title-mensaje {
            text-align: center;
            padding: 10px 0px;
            line-height: 22px;
            width: 100%;
            cursor: pointer;
            font-weight: 600;
        }

        .title-mensaje::after {
            content: "";
            width: 64px;
            background: rgb(255, 85, 0);
            height: 2px;
            display: block;
            margin: 0px auto;
        }
    </style>
    <!-- Start Proerty header  -->
    @php
        $imagen = strpos($Propiedad->imagen, 'base64');
        if ($Propiedad->imagen == null) {
            $Propiedad->imagen = 'frontend\asset\img\camera.jpg';
        }
    @endphp
    <section id="aa-property-header" style="background:none;height:500px">
        <img src="{{ $imagen === false ? asset($Propiedad->imagen) : $Propiedad->imagen }}"
            style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;width: 100%;height: 100%;z-index: -11;"
            alt="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-property-header-inner">
                        <h2>DETALLE DE LA PROPIEDAD</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('web.inicio') }}">INICIO</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Proerty header  -->
    <!-- Start Properties  -->
    <section id="aa-properties">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="aa-properties-content">
                        <!-- Start properties content body -->
                        <div class="aa-properties-details">
                            <div class="aa-properties-details-img hidden" style="display: none">
                                @if ($Galeria[0]->ubicacion != null)
                                    @foreach ($Galeria as $item)
                                        <img src="{{ asset($item->ubicacion) }}" alt="img">
                                    @endforeach
                                @else
                                    <img src="{{ asset('frontend\asset\img\camera.jpg') }}" alt="img">
                                @endif
                            </div>
                            <div class="aa-properties-info">
                                <p class="pt-2 display-4 text-dark">{{ $Propiedad->DescripcionPropiedad }}</p>
                                <span class="aa-price badge badge-danger" style="font-size: 1rem">
                                    {{ $Propiedad->moneda == 'SOLES' ? 'S/ ' : ($Propiedad->moneda == 'DOLAR' ? '$ ' : 'E ') }}
                                    {{ $Propiedad->precio }}
                                </span>
                                <span class="aa-price badge badge-{{$Propiedad->tipo == 'Evento' ? 'warning' : 'info'}}" style="font-size: 1rem">
                                    {{$Propiedad->tipo}}
                                </span>
                                <p>{{ $Propiedad->informacion }}</p>

                                <div class="d-flex flex-wrap">
                                    <div class="col-md-4 col-6">
                                        <p class="m-0 display-6 text-dark text-bold" style="font-weight: bold">Capacidad</p>
                                        <span class="pb-2">{{empty($Propiedad->capacidad) ? '--' : $Propiedad->capacidad}}</span>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <p class="m-0 display-6 text-dark text-bold" style="font-weight: bold">Piscina</p>
                                        <span class="pb-2">{{$Propiedad->piscina}}</span>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <p class="m-0 display-6 text-dark text-bold" style="font-weight: bold">Decoraci??n</p>
                                        <span class="pb-2">{{$Propiedad->decoracion}}</span>
                                    </div>

                                </div>
                                <p class="pt-2 display-6 text-dark text-bold" style="font-weight: bold">Caracter??sticas de
                                    la Propiedad</p>
                                <ul class="d-flex flex-wrap pt-1 pb-3">
                                    @foreach ($Caracteristicas as $item)
                                        <li class="col-md-4 col-6"><i class="fa fa-check-circle"></i>
                                            {{ $item->descripcion }}</li>
                                    @endforeach
                                </ul>
                                @empty(!$Propiedad->video)
                                    <h4>Video de la propiedad</h4>
                                    <iframe width="100%" height="480" src="{{ $Propiedad->video }}" frameborder="0"
                                        allowfullscreen></iframe>
                                @endempty
                                <p class="pt-2 display-6 text-dark text-bold" style="font-weight: bold">Ubicaci??n</p>
                                <div id="map-resumen" style="height: 500px;" class="map">
                                </div>
                                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6851.201919469417!2d{{$Propiedad->longitud}}!3d{{$Propiedad->latitud}}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x888bdb60cc49c571%3A0x40451ca6baf275c7!2s36008+AL-77%2C+Talladega%2C+AL+35160%2C+USA!5e0!3m2!1sbn!2sbd!4v1460452919256" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> --}}
                            </div>
                            <!-- Properties social share -->
                        </div>
                    </div>
                </div>
                <!-- Start properties sidebar -->
                <div class="col-md-4 mt-5">
                    <div class="aa-contact-form"
                        style="display: flex;flex-wrap: wrap;justify-content: center;background:#e7eef0">
                        <h4 class="title-mensaje">Mensaje</h4>
                        <form id="formProceso" class="form_solicitar col-12" action="{{ route('app.solicitudproceso') }}"
                            method="post">
                            @csrf
                            <input type="hidden" name="itmPublicacion" id="itmPublicacion"
                                value="{{ $Propiedad->idPropiedad }}">
                            <div class="col-md-12 pb-1">
                                <div class="input-container-main">
                                    <!-- <label for="input-email" class="label-form-main" style="">Documento</label> -->
                                    <select class="select-form-main form-control" name="imtTurno">
                                        <option value="Dia">D??a</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                    <!-- <input id="input-email" type="text" name="email" inputmode="text" class="input-form-main"  value="" placeholder=""> -->
                                </div>
                            </div>
                            <div class="col-md-12 pb-1">
                                <div class="input-container-main">
                                    <label for="itmVisita" class="label-form-main">Dia Visita</label>
                                    <input id="itmVisita" type="date" name="itmVisita" autocomplete="off"
                                        class="input-form-main form-control" value="" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 pb-1">
                                <div class="input-container-main">
                                    <label for="itmCorreo" class="label-form-main" style="">Correo</label>
                                    <input id="itmCorreo" type="email" name="itmCorreo" autocomplete="off"
                                        class="input-form-main form-control" value="" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 pb-1">
                                <div class="input-container-main">
                                    <label for="itmTelefono" class="label-form-main" style="">Telefono</label>
                                    <input id="itmTelefono" type="text" name="itmTelefono" autocomplete="off"
                                        class="input-form-main form-control" value="" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 px-3 pb-1">
                                <div class="input-container-main">
                                    <textarea style="height: 140px!important;" name="itmInformacion" id="itmInformacion" placeholder="Mensaje"
                                        class="input-form-main form-control" autocomplete="off" rows="8" cols="6"></textarea>
                                    <!-- <label for="itmInformacion" class="label-form-main" style="">Descripci??n</label> -->
                                </div>
                            </div>
                            <div class="col-md-12 pt-2 pb-2">
                                <div class="d-flex" style="display:flex;justify-content:center;">
                                    <div class="w-100 text-right">
                                        <button type="button" id="btnContactar" class="btn btn-info"
                                            name="button">Contactar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Properties  -->
@endsection

@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('lib/gmap/markerclusterer.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_5nony-2rp7PWwEipl9Yx-o510ATWZvk"></script>
    <script src="{{ asset('lib/gmap/gmaps.js') }}"></script>
    <script type="text/javascript">
        function EjecutarProceso() {
            $.ajax({
                type: "post",
                url: $('#formProceso').attr('action'),
                data: $('#formProceso').serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.Status == 'Success') {
                        $('#formProceso')[0].reset();
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
        $('#btnContactar').click(function() {
            EjecutarProceso();
        })
    </script>
    <script>
        var markerClusterer_atendidas = null;
        var estilo = [{
            url: "https://images.vexels.com/media/users/3/199996/isolated/preview/f79ce454b6b358fcc1275f74173da3d6-icono-de-ubicacion-isometrico.png",
            height: 48,
            width: 30,
            anchor: [-18, 0],
            textColor: '#ffffff',
            textSize: 10,
            iconAnchor: [15, 48]
        }];
        var map_atendidas = new GMaps({
            el: '#map-resumen',
            lat: @JSON($Propiedad).longitud,
            lng: @JSON($Propiedad).latitud,
            zoom: 17,
            zoomControl: true,
            zoomControlOpt: {
                style: 'SMALL',
                position: 'TOP_LEFT'
            },
            panControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            overviewMapControl: false,
            markerClusterer: function(map) {
                options = {
                    gridSize: 40,
                    styles: estilo
                }
                return markerClusterer_atendidas = new MarkerClusterer(map, [], options);
            }
        });

        var control = null;

        function mapa_load() {
            // alert('assa');
            if (markerClusterer_atendidas) {
                markerClusterer_atendidas.clearMarkers();
            }
            const svgMarker = {
                path: "M10.453 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                fillColor: 'red',
                fillOpacity: 1,
                strokeWeight: 1,
                rotation: 0,
                scale: 2,
                anchor: new google.maps.Point(15, 30),
            };
            // console.log(@JSON($Propiedad).latitud + ' - ' + @JSON($Propiedad).longitud);
            map_atendidas.addMarker({
                lat: @JSON($Propiedad).longitud,
                lng: @JSON($Propiedad).latitud,
                title: 'Propiedad',
                label: 'Propiedad',
                icon: svgMarker
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            mapa_load();
        });
    </script>
@endsection
