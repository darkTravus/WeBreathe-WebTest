@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('modules.create') }}" class="btn btn-primary">Ajouter un Module</a>
                <a href="#" class="btn btn-warning">Modifier un Module</a>
                <a href="#" class="btn btn-danger">Supprimer un Module</a>
            </div>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $category->logo }}" alt="{{ $category->name }}" class="img-fluid">
                            <h5 class="card-title">{{ $category->name }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
