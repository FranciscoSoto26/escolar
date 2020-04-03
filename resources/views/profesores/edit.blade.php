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

    <form method="POST" action="{{url("profesores/{$profesor->id}")}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}


        <div class="form-group col-6">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="nameHelp" placeholder="Nombre" value="{{old('nombre',$profesor->nombre)}}">
            <label for="name">Apellido Paterno:</label>
            <input type="text" class="form-control" name="apaterno" id="apaterno" aria-describedby="nameHelp" placeholder="Apellido Paterno" value="{{old('apaterno',$profesor->apaterno)}}">
            <label for="name">Apellido Materno:</label>
            <input type="text" class="form-control" name="amaterno" id="amaterno" aria-describedby="nameHelp" placeholder="Apellido Materno" value="{{old('amaterno',$profesor->amaterno)}}">
            <label for="name">Grado Maximo:</label>
            <input type="text" class="form-control" name="grado_maximo" id="grado_maximo" aria-describedby="nameHelp" placeholder="Grado Maximo" value="{{old('grado_maximo',$profesor->grado_maximo)}}">
            <label for="name">Domicilio:</label>
            <input type="text" class="form-control" name="domicilio" id="domicilio" aria-describedby="nameHelp" placeholder="Domicilio" value="{{old('domicilio',$profesor->domicilio)}}">
            <label for="name">Sexo:</label>
            <p>
                <input type="radio" name="sexo" value="HOMBRE"> Hombre
                <input type="radio" name="sexo" value="MUJER"> Mujer
            </p>
            <input type="text" class="form-control" name="sexo" id="sexo" aria-describedby="nameHelp" placeholder="Sexo" value="{{old('sexo',$profesor->sexo)}}">
            <label for="name">Curp:</label>
            <input type="text" class="form-control" name="curp" id="curp" aria-describedby="nameHelp" placeholder="Curp" value="{{old('curp',$profesor->curp)}}">
            <label for="name">Observaciones:</label>
            <input type="text" class="form-control" name="observaciones" id="observaciones" aria-describedby="nameHelp" placeholder="Observaciones" value="{{old('observaciones',$profesor->observaciones)}}">
            <label for="name">Cubiculo:</label>
            <input type="text" class="form-control" name="cubiculo" id="cubiculo" aria-describedby="nameHelp" placeholder="Cubiculo" value="{{old('cubiculo',$profesor->cubiculo)}}">
            <label for="name">Extension Avaya:</label>
            <input type="tel" class="form-control" name="extension_avaya" id="extension_avaya" aria-describedby="telHelp" placeholder="123-456-789" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="{{old('extension_avaya',$profesor->extension_avaya)}}">
            <small id="telHelp" class="form-text text-muted">Fromato : 123-456-789</small>
            <label for="name">RFC:</label>
            <input type="text" class="form-control" name="rfc" id="rfc" aria-describedby="nameHelp" placeholder="RFC" value="{{old('rfc',$profesor->rfc)}}">
            <label for="name">Estado:</label>
            <input type="text" class="form-control" name="estado" id="estado" aria-describedby="nameHelp" placeholder="estado" value="{{old('estado',$profesor->estado)}}">
            <label for="email">Correo electronico:</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Ingrese su email" value="{{old('email',$profesor->email)}}">
            <small id="emailHelp" class="form-text text-muted">Debe de ser un correo no registrado</small>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Profesor</button>
    </form>


    <p>
        <a href="{{route('profesores.profesores')}}">Regresar al listado de Profesores</a>
    </p>

@endsection
