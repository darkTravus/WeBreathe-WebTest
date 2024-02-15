@extends('layouts.app')

@section('style')
<style>
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('modules.create') }}" class="btn btn-primary">Ajouter un Module</a>
                <a href="#" class="btn btn-warning disabled">Modifier un Module</a>
                <a href="#" class="btn btn-danger disabled">Supprimer un Module</a>
            </div>
            <h1 class="d-flex justify-content-center">MODULES</h1>
            <div class="row">
                @foreach($modules as $module)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $module->name }}</h5>
                            <p class="card-text">Entité : {{ $module->entity->name }}</p>
                            <p class="card-text">Statut : 
                                <span class="status-dot" style="background-color: 
                                    @switch($module->actual_status)
                                        @case('Operationally')
                                            green;
                                            @break
                                        @case('Repair')
                                            orange;
                                            @break
                                        @case('Faulty')
                                            red;
                                            @break
                                    @endswitch">
                                </span>
                                {{ $module->actual_status }}
                            </p>
                            <a href="{{ route('modules.graphs', $module->id) }}" class="btn btn-primary">Voir les graphes</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
                        
        </div>
    </div>
</div>
@endsection
