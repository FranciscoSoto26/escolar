@extends('layouts.app')

@section('title', "Materias")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <form method="POST" action="{{ url('crear') }}" >
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="id_alumno" class="col-md-4 col-form-label text-md-right">{{ __('id_alumno') }}</label>

                            <div class="col-md-6">
                                <input id="id_alumno" type="text" class="form-control @error('id_alumno') is-invalid @enderror" name="id_alumno" value="{{ old('id_alumno') }}" required autocomplete="id_alumnos" autofocus>

                                @error('id_alumno')
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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4  col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-md-6">
                                {{--<input id="Alumno" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ old('tipo') }}" required autocomplete="tipo" autofocus>
--}}
                                <input type="radio" name="tipo" value="Alumno" checked="checked">
                                Alumno<br/>

                                <input type="radio" name="tipo" value="Profesor">
                                Profesor<br/>

                                @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_programa_educativo" class="col-md-4 col-form-label text-md-right">{{ __('id_programa_educativo') }}</label>

                            <div class="col-md-6">
                                <input id="id_programa_educativo" type="number" class="form-control @error('id_programa_educativo') is-invalid @enderror" name="id_programa_educativo" value="{{ old('id_programa_educativo') }}" required autocomplete="id_programa_educativo" autofocus min="1" max="3">


                                <input type="checkbox" name="musica"/> M??sica<br/>
                                <input type="checkbox" name="deportes"/> Deportes<br/>
                                <input type="checkbox" name="cine"/> Cine<br/>
                                <input type="checkbox" name="libros"/> Libros<br/>


                                <select name="dia">
                                    <option>d??a de la semana:</option>
                                    <option value="">lunes</option>
                                    <option value="Martes">martes</option>
                                    <option value="Mi??rcoles">miercoles</option>
                                    <option value="Jueves">jueves</option>
                                    <option value="Viernes">viernes</option>
                                    <option value="S??bado">s??bado</option>
                                    <option value="Domingo">domingo</option>
                                </select>

                                @error('id_programa_educativo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{--
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
--}}
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
