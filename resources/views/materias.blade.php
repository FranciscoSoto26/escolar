@extends('layout')

@section('title', "Materias")

@section('content')

    <div class="form-group">
        <h1>Materias</h1>
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
                        <li><a href="materias/{{$materia->cla}}">{{$materia->materia}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    @if(@Auth::user()->hasRole('admin'))
        <table id="materia" class="table table-striped table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Materia</th>
                <th scope="col">Creditos</th>
                <th scope="col">Horas</th>
                <th scope="col">Carrera</th>
                <th scope="col">Tipo</th>
                <th scope="col">Detalles</th>

            </tr>
            </thead>
            <tbody>
            @foreach($materias as $materia)
                <tr>
                    <td>{{$materia->cla}}</td>
                    <td>{{$materia->materia}}</td>
                    <td>{{$materia->creditos}}</td>
                    <td>{{$materia->horas}}</td>
                    <td>{{$materia->carrera}}</td>
                    <td>{{$materia->tipo}}</td>
                    <td>
                        <a href="{{route('more',$materia->cla)}}"class="btn btn-link"><i class="far fa-clock"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    <p>
        <a href="{{url('/home')}}">Regresar</a>
    </p>

@endsection



