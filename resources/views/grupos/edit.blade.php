@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar Espacio</h1>

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

    <form method="POST" action="{{url("espacios/{$espacio->id}")}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}


        <div class="form-group col-6">
            <label for="name">Descripcion:</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="nameHelp" placeholder="Descripcion" value="{{old('descripcion',$espacio->descripcion)}}">
            <label for="name">Ubicacion:</label>
            <input type="text" class="form-control" name="ubicacion" id="ubicacion" aria-describedby="nameHelp" placeholder="Ubicacion" value="{{old('ubicacion',$espacio->ubicacion)}}">
            <label for="name">Capacidad:</label>
            <input type="number" class="form-control" name="capacidad" id="capacidad" aria-describedby="nameHelp" placeholder="Capacidad" value="{{old('capacidad',$espacio->capacidad)}}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Espacior</button>
    </form>


    <p>
        <a href="{{route('espacios')}}">Regresar al listado de Espacios</a>
    </p>

@endsection
