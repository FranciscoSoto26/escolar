@extends('layout')

@section('title', "Materias")

@section('content')
    <h1>Materia</h1>

   {{-- <div class="btn-group" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Seleccione una opción
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" style="transform: none;overflow-y: scroll;height: 300px;width:max-content" >
                @foreach($materias as $materia)
                    <li><a href="{{$materia->cla}}">{{$materia->materia}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>--}}


    {{--Haci se hace un comentario--}}
    {{--<p>Nombre del usuario:{{ $pres }}</p>
    <p>Correo electronico: {{$materia}}</p>--}}


        <table id="more" class="table table-striped table-dark" style="width:auto" >
            <thead>
            <tr>
                <th scope="col">Nombre</th>

                <th scope="col">Carrera</th>
                <th scope="col">Tipo</th>
                <th scope="col">Creditos</th>
                <th scope="col">Prerequisitos</th>

            </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{$materia->materia}}</td>

                    <td>{{$materia->carrera}}</td>
                    <td>{{$materia->tipo}}</td>
                    <td>{{$materia->creditos}}</td>
                    @if($materia->precreditos>0)
                    <td>{{$materia->precreditos}}</td>
                    @else

                    @endif

                    @foreach($preres as $prere)
                        <td>{{$prere->materia}}</td>
                    @endforeach


                </tr>
            </tbody>
        </table>

    @if(@Auth::user()->hasRole('admin'))
        @if($horas!=0)
    <table id="grupos" class="table table-striped table-dark" style="width:auto" >
        <thead>
        <tr>
            <th scope="col">Materia</th>
            <th scope="col">Profesor</th>
            <th scope="col">Grupo</th>
            <th scope="col">Cupo</th>
            <th scope="col">Inscritos</th>

        </tr>
        </thead>
        <tbody>
       <div style="display: none"> {{$i=0}}
       </div>
        @foreach($grups as $grup)

        <tr>
            <td>{{$materia->materia}}</td>

                <td>{{$grup->nombre}}
                {{$grup->apaterno}}
                {{$grup->amaterno}}
                </td>

            <td>{{$grup->id_supergrupo}}</td>


            @if (isset($horas[$i][0]->capacidad))<td>{{$horas[$i][0]->capacidad }}</td>@endif
            <td>{{$grup->inscritos_count}}</td>
            <div style="display: none"> {{$i++}}
            </div>
        </tr>
        @endforeach


        </tbody>


    </table>


    @foreach($horas as $hora)
    <table id="horas" class="table table-striped table-dark" style="width:auto" >
        <thead>

        <tr>
            <th scope="col">Espacio</th>
            <th scope="col">Dia</th>
            <th scope="col">Entrada</th>
            <th scope="col">Salida</th>
            <th scope="col">Grupo</th>



        </tr>
        </thead>
        <tbody>
        @foreach($hora as $ho)
            <tr>
                <td>{{$ho->id_espacio}}</td>
                <td>{{$ho->dia}}</td>
                <td>{{$ho->entrada}}</td>
                <td> {{$ho->salida}}</td>
                <td> {{$ho->id_supergrupo}}</td>


            </tr>
        @endforeach

        </tbody>


    </table>
    @endforeach
    @else
            <h4>No hay grupos disponibles</h4>
    @endif
    @else
        Usted no cuenta con permisos
    @endif
    <p>
        <a href="{{route('materias')}}">Regresar</a>
    </p>

@endsection
