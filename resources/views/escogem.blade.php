@extends('layout')

@section('title', "Materias")

@section('content')

    <div class="form-group">
        <h1>Seleccion de Materias <small>Selecciona la materia en la que te desas incribir</small></h1>
    </div>

    @if(@Auth::user()->hasRole('admin'))
        <div class="btn-group" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Seleccione una opción
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="transform: none;overflow-y: scroll;height: 300px;width:max-content" >
                    @foreach($materias as $materia)
                        <li><a href="escoge/{{$materia->cla}}">{{$materia->materia}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif



    <p>
        <a href="{{url('/home')}}">Regresar</a>
    </p>

@endsection



