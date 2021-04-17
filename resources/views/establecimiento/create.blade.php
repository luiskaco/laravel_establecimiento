@extends('layouts.app')

@section('content')
   <div class="container">
       <h1 class="text-center mt-4">Registrar Establecimiento</h1>

       <div class="mt-5 row justify-content-center">
            <form
                action="{{route('establecimiento.store')}}"
                class="col-md-9 col-xs-12 card card-body"
                enctype="multipart/form-data"
                method="post"
                >
                @csrf
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre y Categoria e imagen principal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre de Establecimiento</label>
                        <input type="text"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Nombre de Establecimiento"
                               name="nombre"
                               value="{{old('nombre')}}"
                               >

                               @error('nombre')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                               @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select
                            name="categoria_id"
                            id="categoria_id"
                            class="form-control @error('categoria_id') is-invalid @enderror">

                            <option value="" selected disabled>-- Selecione --</option>
                            @foreach ($categorias as $categoria)
                                <option
                                    value="{{$categoria->id}}"
                                    {{old('categoria_id') == $categoria->id ? 'selected': null}}>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>

                        @error('categoria_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal">imagen Principal</label>
                        <input type="file"
                               id="imagen_principal"
                               class="form-control @error('imagen_principal') is-invalid @enderror"
                               name="imagen_principal"
                               value="{{old('imagen_principal')}}"
                               >

                               @error('imagen_principal')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                               @enderror
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Ubicación</legend>

                    <div class="form-group">
                        <label for="formbuscador">Coloca la direcc+ón del Establecimiento</label>
                        <input type="text"
                               id="formbuscador"
                               class="form-control "
                               placeholder="Establecimeinto del negocio"

                               >
                       <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o mueve el poin hacia el lugar correcto</p>
                    </div>
                    <div class="form-group">
                        <div id="mapa" style="height: 400px;"></div>

                    </div>

                    <p class="informacion">
                        Confirma que los sigueintes campos sonc Correctos
                    </p>

                    <div class="form-group">
                        <label for="direccion"></label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="form-control @error('direccion') is-invalid @enderror"
                            placeholder="Dirección"
                            value="{{old('direccion')}}"
                            readonly
                            >

                        @error('direccion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="colonia"></label>

                        <input
                            type="text"
                            id="colonia"
                            name="colonia"
                            class="form-control @error('colonia') is-invalid @enderror"
                            placeholder="Colonia"
                            value="{{old('colonia')}}"
                            readonly
                            >

                        @error('colonia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                    <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">

                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input
                                type="tel"
                                class="form-control @error('telefono')  is-invalid  @enderror"
                                id="telefono"
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >

                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>



                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror"
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input
                                type="time"
                                class="form-control @error('apertura')  is-invalid  @enderror"
                                id="apertura"
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input
                                type="time"
                                class="form-control @error('cierre')  is-invalid  @enderror"
                                id="cierre"
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Galeria de imagenes: </legend>
                        <div class="form-group">
                            <label for="imagenes">Imagenes</label>

                            <div id="dropzone" class="dropzone form-control"></div>
                        </div>
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }}">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrar Estacionamiento">
            </form>
       </div>

   </div>
@endsection

@section('styles')

    {{-- lealeft --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <link
    rel="stylesheet"
    href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
  />


    {{--  Dropzone --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" />

@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    {{-- Plugin principal de esri.  --}}
   <script src="https://unpkg.com/esri-leaflet" defer></script>


    <!-- Esri Leaflet Geocoder -->
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

   {{-- Dropzone  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.js" integrity="sha512-4p9OjnfBk18Aavg91853yEZCA7ywJYcZpFt+YB+p+gLNPFIAlt2zMBGzTxREYh+sHFsttK0CTYephWaY7I3Wbw==" crossorigin="anonymous" defer></script>

@endsection
