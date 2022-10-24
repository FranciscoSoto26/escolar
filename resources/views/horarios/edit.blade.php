@extends('layout')

@section('title', "Editar Horario")

@section('content')
    <h1>Editar Grupo</h1>

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

    <form method="POST" action="{{url("grupos/{$grupo->id}")}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}


        <div class="form-group col-6">
            <label for="name">Profesor:</label>
            <div class="dropdown">
                <select name="profesor">
                    <option>Profesores:</option>
                    @foreach($profesores as $profesor)
                        <option value='{{$profesor->id}}'>{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</option>
                        <li><a href="#">{{$profesor->nombre}} {{$profesor->apaterno}} {{$profesor->amaterno}}</a></li>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Grupo</button>
    </form>


    <p>
        <a href="{{route('grupos')}}">Regresar al listado de Grupos</a>
    </p>

@endsection
