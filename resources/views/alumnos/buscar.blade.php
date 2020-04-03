@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los siguientes errores:</h6>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>-
        </div>

    @endif

    {{--Haci se hace un comentario--}}

    <form method="GET" action="{{route('alumnos.detalles')}}">

        {{csrf_field()}}


        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Matricula</span>
            </div>
            <input type="text" class="form-control" placeholder="Matricula Ejemplo:a1431901k" name="matricula" id="matricula" aria-describedby="basic-addon1">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>




    <p>
        <a href="{{route('home')}}">Regresar</a>
    </p>

@endsection
