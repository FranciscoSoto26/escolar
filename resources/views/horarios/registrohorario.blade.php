@extends('layouts.app')

@section('title', "Materias")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <form method="POST" action="{{ url('creargrupo') }}" >
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="id_supergrupo" class="col-md-4 col-form-label text-md-right">{{ __('Grupo') }}</label>

                            <div class="col-md-6">
                                <input id="id_supergrupo" type="text" class="form-control @error('id_supergrupo') is-invalid @enderror" name="id_supergrupo" value="{{ old('id_supergrupo') }}" required autocomplete="id_supergrupo" autofocus placeholder="Ejemplo 901 o 901-01">

                                @error('id_supergrupo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_ciclo" class="col-md-4 col-form-label text-md-right">{{ __('Ciclo') }}</label>
                            <select name="id_ciclo">
                                <option>Ciclo:</option>
                                @foreach($ciclos as $ciclo)
                                    <option value='{{$ciclo->id}}'>{{$ciclo->ciclo}}</option>
                                    <li><a href="#">{{$ciclo->ciclo}}</a></li>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="id_materia" class="col-md-4 col-form-label text-md-right">{{ __('Materia') }}</label>
                            <select name="id_materia">
                                <option>Materias:</option>
                                @foreach($materias as $materia)
                                    <option value='{{$materia->id}}'>{{$materia->materia}}</option>
                                    <li><a href="#">{{$materia->$materia}}</a></li>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="id_profesor" class="col-md-4 col-form-label text-md-right">{{ __('Profesor') }}</label>
                            <select name="id_profesor">
                                <option>Profesores:</option>
                                @foreach($profesores as $profesor)
                                    <option value='{{$profesor->id}}'>{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</option>
                                    <li><a href="#">{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</a></li>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="id_sinodal" class="col-md-4 col-form-label text-md-right">{{ __('Sinodal') }}</label>

                             <select name="id_sinodal">
                                <option>Profesores:</option>
                                @foreach($profesores as $profesor)
                                    <option value='{{$profesor->id}}'>{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</option>
                                    <li><a href="#">{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</a></li>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onclick="
return confirm('Confrimacion de registro de grupo?')" class="btn btn-primary">
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
