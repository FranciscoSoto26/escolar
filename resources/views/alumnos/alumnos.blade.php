@extends('layout')

@section('title', "Profesores")

@section('content')

    <div class="form-group">
        <h1>Alumnos</h1>
    </div>


    @if(@Auth::user()->hasRole('admin'))
        <table id="materia" class="table table-striped table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">estado</th>
                <th scope="col">promedio</th>



            </tr>
            </thead>
            <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td>{{$alumno->id}}</td>
                    <td>{{$alumno->nombre}}</td>
                    <td>{{$alumno->apaterno}}</td>
                    <td>{{$alumno->amaterno}}</td>
                    <td>{{$alumno->estado}}</td>
                    <td>{{$alumno}}</td>


                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    <p>
        <a href="{{url('/home')}}">Regresar</a>
    </p>

@endsection



