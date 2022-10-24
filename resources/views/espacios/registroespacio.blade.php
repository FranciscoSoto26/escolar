@extends('layouts.app')

@section('title', "Materias")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <form method="POST" action="{{ url('crearprofesor') }}" >
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Empleado') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                            <div class="col-md-6">
                                <input id="apaterno" type="text" class="form-control @error('apaterno') is-invalid @enderror" name="apaterno" value="{{ old('apaterno') }}" required autocomplete="apaterno" autofocus>

                                @error('apaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amaterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                            <div class="col-md-6">
                                <input id="amaterno" type="text" class="form-control @error('amaterno') is-invalid @enderror" name="amaterno" value="{{ old('amaterno') }}" required autocomplete="amaterno" autofocus>

                                @error('amaterno')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grado_maximo" class="col-md-4 col-form-label text-md-right">{{ __('Maximo Grado') }}</label>

                            <div class="col-md-6">
                                <input id="grado_maximo" type="text" class="form-control @error('grado_maximo') is-invalid @enderror" name="grado_maximo" value="{{ old('grado_maximo') }}" autocomplete="grado_maximo" autofocus>

                                @error('grado_maximo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  autocomplete="telefono" autofocus placeholder="4433955660" pattern="[0-9]{10}" >

                                @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="domicilio" class="col-md-4 col-form-label text-md-right">{{ __('domicilio') }}</label>

                            <div class="col-md-6">
                                <input id="domicilio" type="text" class="form-control @error('nombre') is-invalid @enderror" name="domicilio" value="{{ old('domicilio') }}" autocomplete="domicilio" autofocus>

                                @error('domicilio')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexo" class="col-md-4  col-form-label text-md-right">{{ __('sexo') }}</label>
                            <div class="col-md-6">
                                <input type="radio" name="sexo" value="HOMBRE" checked="checked">
                                Hombre<br/>

                                <input type="radio" name="sexo" value="MUJER">
                                Mujer<br/>

                                @error('sexo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('observaciones') }}</label>

                            <div class="col-md-6">
                                <input id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" value="{{ old('nombre') }}" autocomplete="observaciones" autofocus>

                                @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cubiculo" class="col-md-4 col-form-label text-md-right">{{ __('cubiculo') }}</label>

                            <div class="col-md-6">
                                <input id="cubiculo" type="number" class="form-control @error('cubiculo') is-invalid @enderror" name="cubiculo" value="{{ old('cubiculo') }}" autocomplete="cubiculo" autofocus placeholder="11111" min="0" max="99999" step="10" value="30" >

                                @error('cubiculo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extension_avaya" class="col-md-4 col-form-label text-md-right">{{ __('extension_avaya') }}</label>

                            <div class="col-md-6">
                                <input id="extension_avaya" type="tel" class="form-control @error('extension_avaya') is-invalid @enderror" name="extension_avaya" value="{{ old('extension_avaya') }}"  autocomplete="extension_avaya" autofocus  pattern="[0-9]{10}" >

                                @error('extension_avaya')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('rfc') }}</label>

                            <div class="col-md-6">
                                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}" autocomplete="rfc" autofocus>

                                @error('rfc')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4  col-form-label text-md-right">{{ __('estado') }}</label>
                            <div class="col-md-6">
                                <input type="radio" name="estado" value="ACTIVO" >
                                Activo<br/>

                                <input type="radio" name="estado" value="SABATICO">
                                Sabatico<br/>

                                <input type="radio" name="estado" value="JUBILADO">
                                Jubilado<br/>

                                @error('estado')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onclick="
return confirm('Confrimacion de registro de usuario?')" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ url('/home') }}" class="btn btn-link">Home</a>
                            </div>
                        </div>


                    </form>
                </div>

        </div>
    </div>
</div>
@endsection
