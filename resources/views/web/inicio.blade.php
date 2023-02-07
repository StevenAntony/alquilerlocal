@extends('web.layout.appWeb')

@section('Content')
    <style media="screen">
      .estado-alquilado{
        position: absolute;
        padding: 5px;
        background: #ff557c;
        box-shadow: 1px 2px 15px 3px #ff557c;
        color: #fff;
        font-weight: bold;
        font-size: 10px;
        border-radius: 30px;
        top: 10px;
        left: 10px;
      }
      .content-paginacion nav{
        text-align: center;
        padding-top: 30px;
      }
      .content-paginacion nav .inline-flex{
        font-size: 8rem;
        margin: 0px 30px;
        color:#259fbb;
      }
    </style>

    <div class="home">
        <div class="home_slider_container">
            <div class="owl-carousel owl-theme home_slider owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(0px, 0px, 0px); transition: all 1.2s ease 0s; width: 10635px;">

                        <div class="owl-item active" style="width: 1519.2px;">
                            <div class="slide">
                                <div class="background_image" style="background-image:url(https://preview.colorlib.com/theme/myhome/images/index.jpg.webp)">
                                </div>
                                <div class="home_container" style="display: none">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="home_content">
                                                    <div class="home_title">
                                                        <h1>1243 Main Avenue Left Town</h1>
                                                    </div>
                                                    <div class="home_price_tag">$ 482 900</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button></div>
                <div class="owl-dots disabled"></div>
            </div>

            <div class="home_slider_nav"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
        </div>
    </div>

    <div class="search">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="search_container">
                        <div class="search_title">Encuentra</div>
                        <div class="search_form_container">
                            <form action="#" class="search_form" id="search_form">
                                <div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
                                    <div class="search_inputs d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
                                        <select name="itmTipo" class="search_input" id="itmTipo">
                                            <option value="Evento">Evento</option>
                                            <option value="Alquiler">Alquiler</option>
                                        </select>
                                        <input type="text" class="search_input" id="itmCapacidad" placeholder="Capacidad"
                                            required="required">
                                        <input type="text" class="search_input" id="itmDescripcion" placeholder="Descripción"
                                            required="required">
                                    </div>
                                    <button type="button" class="search_button btn-buscar-pub">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featured">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <div class="section_subtitle">LAS MEJORES OFERTAS</div>
                        <div class="section_title">
                            <h1>Propiedades Destacadas</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row featured_row">
                @empty(!$NuevaPropiedad)
                    @foreach ($NuevaPropiedad as $key => $item)
                        <div class="col-lg-4">
                            <div class="listing">
                                <div class="listing_image">
                                    <span class="badge-{{$item->tipo == 'Evento' ? 'warning' : 'info'}} badge"
                                        style="position: absolute;top: 10px;z-index: 1;padding: 5px 10px;right: 10px;">{{$item->tipo}}</span>
                                    <div class="listing_image_container" style="width: 100%!important;height: 200px;">
                                        @php
                                            $img =  $item->imagen == null ?'frontend\asset\img\camera.jpg' :$item->imagen
                                        @endphp
                                        <img src="{{$img }}" alt="">
                                    </div>
                                    <div class="tags d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        @if($item->estado == 'ALQ')
                                            <div class="tag tag_house"><a href="#">Alquilado</a></div>
                                        @endif
                                    </div>
                                    <div class="tag_price listing_price"> {{($item->moneda == 'SOLES')?'S/ ':(($item->moneda == 'DOLAR')?'$ ':'E ')}} {{$item->precio}}</div>
                                </div>
                                <div class="listing_content">
                                    <div style="height: 130px;overflow: hidden;"
                                        class="prop_location listing_location d-flex flex-row align-items-start justify-content-start">
                                        <a style="margin: 0px" href="{{route('web.detalle-propiedad',['codigo'=>$item->id_propiedad])}}">{{$item->descripcion}}</a>
                                    </div>
                                    <div class="listing_info">
                                        <ul class="d-flex flex-row align-items-center justify-content-start flex-wrap">
                                            <li title="Capacidad"
                                                class="property_area d-flex flex-row align-items-center justify-content-start">
                                                <i class="fa fa-user"></i>
                                                <span>{{empty($item->capacidad) ? '--' : $item->capacidad}}</span>
                                            </li>
                                            <li title="Piscina" class="d-flex flex-row align-items-center justify-content-start">
                                                Piscina
                                                <span>{{$item->piscina == 1 ? 'SI' : 'NO'}}</span>
                                            </li>
                                            <li class="d-flex flex-row align-items-center justify-content-start">
                                                Decoración
                                                <span>{{$item->decoracion == 1 ? 'SI' : 'NO'}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
        </div>
    </div>
    {{-- @if ($Buscar == null)

        {{$NuevaPropiedad->links()}}
    @endif --}}
@endsection
@section('script')
    <script>
        const valores = window.location.search;
        const urlParams = new URLSearchParams(valores);

        $('#itmTipo').val(urlParams.get('tipo'))
        $('#itmCapacidad').val(urlParams.get('capacidad'))
        $('#itmDescripcion').val(urlParams.get('descripcion'))
        // $('.content-paginacion nav .inline-flex:first-child').html('«');
        // $('.content-paginacion nav .inline-flex:last-child').html('»');
        $('.btn-buscar-pub').click(function () {
           var tipo = $('#itmTipo').val();
           var capacidad = $('#itmCapacidad').val();
           var descripcion = $('#itmDescripcion').val();
           window.location.href = `?tipo=${tipo}&capacidad=${capacidad}&descripcion=${descripcion}`;
        });
    </script>
@endsection
