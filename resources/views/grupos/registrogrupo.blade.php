@extends('layouts.app')

@section('title', "Materias")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <form method="POST" action="{{ url('crearespacio') }}" >
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

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
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ubicacion" class="col-md-4 col-form-label text-md-right">{{ __('Ubicacion') }}</label>

                            <div class="col-md-6">
                                <input id="ubicacion" type="text" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion" value="{{ old('ubicacion') }}" required autocomplete="ubicacion" autofocus>

                                @error('ubicacion')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacidad" class="col-md-4 col-form-label text-md-right">{{ __('Capacidad') }}</label>

                            <div class="col-md-6">
                                <input id="capacidad" type="number" class="form-control @error('capacidad') is-invalid @enderror" name="capacidad" value="{{ old('capacidad') }}" required autocomplete="capacidad" autofocus>

                                @error('capacidad')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onclick="
return confirm('Confrimacion de registro de espacio?')" class="btn btn-primary">
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
