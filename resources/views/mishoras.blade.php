@extends('layout')

@section('title', "Materias")

@section('content')
    <h1>Mi horario</h1>

        <table id="materias" class="table table-bordered table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">Materia</th>
                <th scope="col">Profesor</th>
                <th scope="col">Creditos</th>
                <th scope="col">Carrera</th>
            </tr>
            </thead>
            <tbody>

            @foreach($mihoras as $mihora)
                <tr>
                    <td>{{$mihora["materia"]}}</td>
                    <td>{{$mihora["nprofesor"]}}</td>
                    <td>{{$mihora["creditos"]}}</td>
                    <td>{{$mihora["carrera"]}}</td>

                    <td>

                            <form action="{{route('baja','grupo='.$mihora["grupo"]) }}" onclick="
return confirm('Confrimar que quieres dar de baja la materia?')"method="POST">

                                {{csrf_field()}}

                                <button type="submit"> Darse de baja  </button>
                            </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    <p>
        <a href="{{route('materias')}}">Regresar</a>
    </p>

@endsection
