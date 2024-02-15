//module.js

$(document).ready(function() {
    // Function to fetch and update module status
    function fetchModuleStatus(moduleId) {
        $.ajax({
            url: '/get-module-status/' + moduleId,
            method: 'GET',
            success: function(response) {
                // Update module status on the page
                var statusDotColor;
                switch (response.status) {
                    case 'Operationaly':
                        statusDotColor = 'green';
                        break;
                    case 'Repair':
                        statusDotColor = 'orange';
                        break;
                    case 'Faulty':
                        statusDotColor = 'red';
                        break;
                    default:
                        statusDotColor = 'black';
                }
                var $moduleStatus = $('#moduleStatus');
                $moduleStatus.html("Statut : " + response.status + ' <span class="status-dot"></span>');
                $('.status-dot', $moduleStatus).css('background-color', statusDotColor);
                
                $('#moduleEntity').text("Entité : " + response.entity);
                $('#moduleDescription').text("Description : " + response.description);
                $('#moduleUpdate').text("Mis à jour le : " + new Date(response.updated_at).toLocaleString('fr-FR'));
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Call the function to fetch initial data when the page loads
    fetchModuleStatus(moduleId);

    // Update data every minute
    setInterval(function() {
        fetchModuleStatus(moduleId);
    }, 60000);

    // Function to fetch and update module history data based on filters
    function fetchModuleHistory(moduleId, dateFilter, timeFilter) {
        $.ajax({
            url: '/get-module-history/' + moduleId,
            method: 'GET',
            data: {
                date: dateFilter,
                time: timeFilter
            },
            success: function(response) {
                updateChart(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Default values for filters
    var currentDate = new Date().toISOString().slice(0, 10);
    var currentTime = new Date().toISOString().slice(11, 16);
    $('#dateFilter').val(currentDate);
    $('#timeFilter').val(currentTime);

    // Define charts
    var ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
    var temperatureChart = new Chart(ctxTemperature, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Temperature',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxPassenger = document.getElementById('passengerChart').getContext('2d');
    var passengerChart = new Chart(ctxPassenger, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Passengers Boarded',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Passengers Alighted',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxTotalPassenger = document.getElementById('totalPassengerChart').getContext('2d');
    var totalPassengerChart = new Chart(ctxTotalPassenger, {
        type: 'line',
        data: {
            datasets: [{
                    label: 'Total Passengers',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
            },]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxDistance = document.getElementById('distanceChart').getContext('2d');
    var distanceChart = new Chart(ctxDistance, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Distance Covered',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fetch initial history data
    fetchModuleHistory(moduleId, currentDate, currentTime);

    // Update data every 30 seconds
    setInterval(function() {
        fetchModuleHistory(moduleId, currentDate, currentTime);
    }, 30000);

    // Function to update charts with new data
    function updateChart(data) {
        // Update temperature chart
        var temperatures = [];
        var timestamps = [];
        data.forEach(function(entry) {
            temperatures.push(entry.temperature_value);
            var formattedTimestamp = new Date(entry.created_at).toISOString().slice(11, 19);
            timestamps.push(formattedTimestamp);
        });
        temperatureChart.data.labels = timestamps;
        temperatureChart.data.datasets[0].data = temperatures;
        temperatureChart.update();

        // Update boarded and alighted passengers chart
        var boardedPassengers = [];
        var alightedPassengers = [];
        data.forEach(function(entry) {
            boardedPassengers.push(entry.boarding_passenger_count);
            alightedPassengers.push(entry.alighting_passenger_count);
        });
        passengerChart.data.labels = timestamps;
        passengerChart.data.datasets[0].data = boardedPassengers;
        passengerChart.data.datasets[1].data = alightedPassengers;
        passengerChart.update();

        // Update total passengers chart
        var totalPassengers = [];
        data.forEach(function(entry) {
            totalPassengers.push(entry.total_passenger_count);
        });
        totalPassengerChart.data.labels = timestamps;
        totalPassengerChart.data.datasets[0].data = totalPassengers;
        totalPassengerChart.update();

        // Update distance traveled chart
        var distances = [];
        data.forEach(function(entry) {
            distances.push(entry.distance_traveled);
        });
        distanceChart.data.labels = timestamps;
        distanceChart.data.datasets[0].data = distances;
        distanceChart.update();
    }

    // Event handler for date filter change
    $('#dateFilter').on('change', function() {
        currentDate = $(this).val();
        fetchModuleHistory(moduleId, currentDate, currentTime);
    });

    // Event handler for time filter change
    $('#timeFilter').on('change', function() {
        currentTime = $(this).val();
        fetchModuleHistory(moduleId, currentDate, currentTime);
    });

});