@extends('layout')

@section('title', "Semestre ")

@section('content')
    <h1>Semestre</h1>



    {{--Haci se hace un comentario--}}
    {{--<p>Nombre del usuario:{{ $pres }}</p>
    <p>Correo electronico: {{$materia}}</p>--}}
    <form class="form-horizontal" method="POST" action="{{url('/crear_semestre')}}">
        {!! csrf_field() !!}



        <div class="form-group">
            <label for="name" class="col-md-2 control-label">Ciclo</label>

            <div class="col-md-2">
                <input id="ciclo" type="text" class="form-control" name="ciclo" value="{{ old('ciclo') }}" placeholder="2019-2020" required>
            </div>
        </div>


        <div class="btn-group btn-group-lg">
            <button type="submit" class="btn btn-primary">
                Crear Nuevo Ciclo
            </button>
        </div>



    <p>
        <a href="{{route('home')}}">Regresar</a>
    </p>

@endsection
