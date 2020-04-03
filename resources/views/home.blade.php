@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ Auth::user()->nombre }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p>Nombre:</p>
                                <p><strong>{{ Auth::user()->nombre }}</strong></p>
                                <hr>
                                <p>Email:</p>
                                <p><strong>{{ Auth::user()->email }}</strong></p>
                                <p>Matricula:</p>
                                <p><strong>{{ Auth::user()->id_alumno }}</strong></p>


                            </div>
                            <div class="col-md-4">
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->nombre }}" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
