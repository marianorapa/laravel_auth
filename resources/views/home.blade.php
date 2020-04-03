@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @foreach ($roles as $rol)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{$rol->name}}</h5>
                            <p class="card-text text-capitalize">{{$rol->descr}}</p>
                            <a href="{{route($rol->name)}}" class="btn btn-primary">Ir al menu</a>
                            {{-- <a href="{{route('role.handler')}}" class="btn btn-primary">Ir al menu</a> --}}
                        </div>
                    </div>
                @endforeach            
        </div>
    </div>
</div>
@endsection
