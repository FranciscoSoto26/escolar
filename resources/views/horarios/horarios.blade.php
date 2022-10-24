@extends('layout')

@section('title', "Profesores")

@section('content')

    <div class="form-group">
        <h1>Grupos</h1>
    </div>

    <div class="btn-group btn-group-lg">
        <a class="btn" href="{{route('registrogrupo')}}">Registrar Nuevo Grupo</a>
    </div>

    <div class="row" id="mensaje">
        @if(session('success'))
            <div class="col-md-12 alert alert-success">
                {{session('success')}}
            </div>
        @endif
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
                <th scope="col">Cambiar Profesor</th>
                <th scope="col">Eliminar</th>




            </tr>
            </thead>
            <tbody>
            @foreach($grupos as $grupo)
                <tr>
                    <td>{{$grupo->materia->cla}}</td>
                    <td>{{$grupo->id_supergrupo}}</td>
                    <td>{{$grupo->materia->materia}}</td>
                    <td>{{$grupo->materia->horas}}</td>
                    <td>{{$grupo->profesor->nombre}} {{$grupo->profesor->apaterno}} {{$grupo->profesor->amaterno}}</td>
                   <td><a href="{{route('grupo.edit',$grupo)}}"class="btn btn-link"><i class="fas fa-user-edit"></i></a></td>
                    <td>
                        <form action="{{route('grupo.destroy',$grupo) }}" method="POST"  onclick="
                                return confirm('Confrimar que quieres eliminar el espacio')">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
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

    <script>
        let mensaje=document.getElementById("mensaje");
        mensaje.style.display="block";
        setInterval(function(){
            mensaje.style.display="none";
        },5000);
    </script>

@endsection



