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

        body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        margin-bottom: 20px;
    }

    canvas {
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .filter-title {
        font-weight: bold;
        margin-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-md-1">
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
                    <!-- History summary table -->
                    <div class="filter-box">
                        <div id="table-title" class="filter-title">Récapitulatif de l'historique</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Indicateur</th>
                                    <th>Valeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Moyenne de passager</td>
                                    <td id="averagePassenger"></td>
                                </tr>
                                <tr>
                                    <td>Passagers max</td>
                                    <td id="maxPassenger"></td>
                                </tr>
                                <tr>
                                    <td>Passagers min</td>
                                    <td id="minPassenger"></td>
                                </tr>
                                <tr>
                                    <td>Total de passagers</td>
                                    <td id="totalPassenger"></td>
                                </tr>
                                <tr>
                                    <td>Température moyenne</td>
                                    <td id="averageTemperature"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Graphs -->
                <div class="col-md-12">
                    <h5 class="d-flex justify-content-center m-3">Courbe des Températures</h5>
                    <canvas id="temperatureChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="d-flex justify-content-center m-3">Courbe d'Affluence des Passagers</h5>
                    <canvas id="passengerChart" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <h5 class="d-flex justify-content-center m-3">Courbe des Totaux de Passagers</h5>
                    <canvas id="totalPassengerChart" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="d-flex justify-content-center m-3">Courbe des distances parcourues</h5>
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
