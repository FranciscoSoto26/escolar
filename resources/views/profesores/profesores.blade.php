@extends('layout')

@section('title', "Profesores")

@section('content')

    <div class="form-group">
        <h1>Profesores</h1>
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
                <th scope="col">email</th>
                <th scope="col">Opciones</th>



            </tr>
            </thead>
            <tbody>
            @foreach($profesores as $profesor)
                <tr>
                    <td>{{$profesor->id}}</td>
                    <td>{{$profesor->nombre}}</td>
                    <td>{{$profesor->apaterno}}</td>
                    <td>{{$profesor->amaterno}}</td>
                    <td>{{$profesor->estado}}</td>
                    <td>{{$profesor->email}}</td>
                    <td>
                        <form action="{{route('profesores.destroy',$profesor) }}" method="POST"  onclick="
return confirm('Confrimar que quieres eliminar al maestro')">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <a href="{{route('profesores.edit',$profesor)}}"class="btn btn-link"><i class="fas fa-user-edit"></i></a>
                            <button type="submit" class="btn btn-link"><i class="fas fa-user-times"></i></button>
                        </form>
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



