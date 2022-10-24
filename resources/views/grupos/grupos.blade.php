@extends('layout')

@section('title', "Profesores")

@section('content')

    <div class="form-group">
        <h1>Grupos</h1>
    </div>


    @if(@Auth::user()->hasRole('admin'))
        <table id="materia" class="table table-bordered table-striped table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Grupo</th>
                <th scope="col">Materia</th>
                <th scope="col">Horas</th>
                <th scope="col">Profesor</th>




            </tr>
            </thead>
            <tbody>
            @foreach($grupos as $grupo)
                <tr>
                    <td>{{$grupo->cla}}</td>
                    <td>{{$grupo->id_supergrupo}}</td>
                    <td>{{$grupo->materia}}</td>
                    <td>{{$grupo->horas}}</td>
                    <td>{{$grupo->nombre}} {{$grupo->apaterno}} {{$grupo->amaterno}}</td>






                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    <p>
        <a href="{{url('/home')}}">Regresar</a>
    </p>

@endsection



