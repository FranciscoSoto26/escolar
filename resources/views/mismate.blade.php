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
                            </tr>
                    @endforeach
            </tbody>
        </table>

    <table id="horario" class="table table-bordered table-dark" style="width:auto; text-align: center" >
        <thead>
        <tr>
            <th scope="col">Hora</th>
            <th scope="col">Lunes</th>
            <th scope="col">Martes</th>
            <th scope="col">Miercoles</th>
            <th scope="col">Jueves</th>
            <th scope="col">Viernes</th>
        </tr>
        </thead>
        <tbody>


            @for ($j = 0; $j < 13; $j++)
                <tr>
                    <td scope="row"> {{$j+7}} {{"-"    }} {{$j+8}}</td>
                    <td> {{$mih[1][$j]}} </td>
                    <td>{{$mih[2][$j]}}</td>
                    <td>{{$mih[3][$j]}}</td>
                    <td>{{$mih[4][$j]}}</td>
                    <td>{{$mih[5][$j]}}</td>
                </tr>

        @endfor





        </tbody>
    </table>


    <p>
        <a href="{{route('materias')}}">Regresar</a>
    </p>

@endsection
