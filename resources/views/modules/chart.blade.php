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

    .filter-box {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .filter-title {
        font-weight: bold;
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>{{ $module->name }}</h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="filter-box">
                        <div class="filter-title">Informations</div>
                        <p id="moduleStatus"> </p>
                        <p id="moduleUpdate"></p>
                        <p id="moduleEntity"></p>
                        <p id="moduleDescription"></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="filter-box">
                        <div class="filter-title">Filtres de temps</div>
                        <label for="dateFilter" class="form-label">Date</label>
                        <input type="date" class="form-control" id="dateFilter">
                        <label for="timeFilter" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="timeFilter">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Graphique principal -->
                    <canvas id="temperatureChart" width="400" height="200"></canvas>
                </div>
            </div>
            <!-- Autres graphiques -->
            <!-- Ajoutez ici d'autres graphiques avec leurs balises canvas -->
            <div class="row">
                <div class="col-md-6">
                    <canvas id="passengerChart" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="totalPassengerChart" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <canvas id="distanceChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var moduleId = {{ $module->id }};
</script>
<script src="{{ asset('js/module.js') }}"></script>
@endsection
