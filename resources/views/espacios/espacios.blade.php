@extends('layout')

@section('title', "Espacios")

@section('content')

    <div class="form-group">
        <h1>Espacios</h1>
    </div>


    @if(@Auth::user()->hasRole('admin'))
        <table id="materia" class="table table-bordered table-striped table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Salon</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Cpacidad</th>
                <th scope="col">Modificar</th>





            </tr>
            </thead>
            <tbody>
            @foreach($espacios as $espacio)
                <tr>
                    <td>{{$espacio->id}}</td>
                    <td>{{$espacio->descripcion}}</td>
                    <td>{{$espacio->ubicacion}}</td>
                    <td>{{$espacio->capacidad}}</td>
                    <td><a href="{{route('profesores.edit',$profesor)}}"class="btn btn-link"><i class="fas fa-user-edit"></i></a></td>

                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    <p>
        <a href="{{url('/home')}}">Regresar</a>
    </p>

@endsection



